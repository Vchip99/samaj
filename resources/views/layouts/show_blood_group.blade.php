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
                <div class="panel-heading "style="height: 55px;">
                    <div class="col-md-3">
                        <select class="form-control" name="blood_group" onChange="searchBloodMember(this.value);">
                            <option value="">Select Blood Group</option>
                            <option value="A+" selected>A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+" >AB+</option>
                            <option value="AB-" >AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($members) > 0)
                    <div class="row">
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
                            @if(!empty($member->f_name) || !empty($member->l_name))
                                <label class="col-md-3 control-label member-label"> <a href="{{url('member')}}/{{$member->id}}" >{{$member->f_name}} {{$member->l_name}}</a></label>
                            @else
                                <label class="col-md-3 control-label member-label"> <a href="{{url('member')}}/{{$member->id}}" >{{$member->mobile}}</a></label>
                            @endif
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
    function searchBloodMember(bloodGroup){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(bloodGroup){
            $.ajax({
                method:'POST',
                url: "{{url('search-blood')}}",
                data:{_token:currentToken,blood_group:bloodGroup}
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
                        if(obj.f_name || obj.l_name){
                            firstDivInnerHTML += '<label class="col-md-3 control-label member-label"> <a href="'+urlStr+'" >'+obj.f_name+' '+obj.l_name+'</a></label>';
                        } else {
                            firstDivInnerHTML += '<label class="col-md-3 control-label member-label"> <a href="'+urlStr+'" >'+obj.mobile+'</a></label>';
                        }

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
