@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading " style="height: 55px;">
                    <div class="col-md-3">
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Select</option>
                            <option value="All">All</option>
                            <option value="F">Bride</option>
                            <option value="M">Groom</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this.value);">
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($members) > 0)
                    <div class="row">
                        <div class="panel-heading">Marriage Members</div>
                        <div id="allMember">
                        @foreach($members as $member)
                        <div class="col-md-6">
                            <div class="col-md-3">
                                @if(!empty($member->photo))
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset($member->photo)}}" class="user-photo"></a>
                                @else
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset('images/user.png')}}" class="user-photo"></a>
                                @endif
                            </div>
                          <label class="col-md-3 control-label member-label"> <a href="{{url('member')}}/{{$member->id}}" >{{$member->f_name}} {{$member->l_name}}</a></label>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @else
                        No Member
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function searchMember(member){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var gender = document.getElementById('gender').value;
        if(member.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-marriage-member')}}",
                data:{_token:currentToken,member:member,gender:gender}
            }).done(function( members ) {
                var allMember = document.getElementById('allMember');
                allMember.innerHTML = '';
                if(members.length > 0){
                    $.each(members, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'col-md-6';
                        firstDivInnerHTML = '<div class="col-md-3">';
                        var urlStr = "{{url('member')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.photo;
                        var defaultImgStr = "{{ asset('images/user.png')}}";
                        if(obj.photo){
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+imgStr+'" class="user-photo"></a></div>';
                        } else {
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+defaultImgStr+'" class="user-photo"></a></div>';
                        }
                        if(obj.f_name){
                          var firstName = obj.f_name;
                        } else {
                          var firstName = '';
                        }
                        if(obj.l_name){
                          var lastName = obj.l_name;
                        } else {
                          var lastName = '';
                        }
                        firstDivInnerHTML += '<label class="col-md-3 control-label member-label"> <a href="'+urlStr+'" >'+firstName+' '+lastName+'</a></label>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allMember.appendChild(firstDiv);
                    })
                } else {
                    allMember.innerHTML = 'No Result';
                }
            });
        } else if( 0 == member.length) {
            window.location.reload();
        }
    }
</script>
@endsection
