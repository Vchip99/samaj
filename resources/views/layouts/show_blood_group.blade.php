@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .bloodGroup{
            height:80%;
            margin-top: 70px;
        }
        .top{
            margin-top: 40px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row" style="min-height: 782px !important;">
        <div class="col-md-10 ">
            <div class="container bloodGroup">
                <div class="row">
                    <div class="col-md-4 top">
                        <div class="form-group">
                            <label class="control-label">Blood Group</label>
                            <select class="form-control" name="blood_group" onChange="searchBloodMember(this.value);">
                                <option value="">Select Blood Group</option>
                                <option value="A+" selected>A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
                <div class="row" id="allMember">
                    @if(count($members) > 0)
                        @foreach($members as $member)
                        <div class="col-md-4 col-sm-6 col-xs-6 col-1 text-center" >
                            <div class="member1 text-center">
                                <a href="{{url('member')}}/{{$member->id}}" >
                                    @if(!empty($member->photo))
                                        <img src="{{ asset($member->photo)}}" alt="member1 image" class="image img-circle" >
                                    @else
                                        <img src="{{ asset('images/user.png')}}" alt="member1 image" class="image img-circle" >
                                    @endif
                                    @if(!empty($member->f_name) || !empty($member->l_name))
                                        <h5><strong>{{$member->f_name}} {{$member->l_name}}</strong></h5>
                                    @else
                                        <h5><strong>{{$member->mobile}}</strong></h5>
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        No Member
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
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
                        firstDiv.className = 'col-md-4 col-sm-6 col-xs-6 col-1 text-center';
                        firstDivInnerHTML = '<div class="member1 text-center">';
                        var urlStr = "{{url('member')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.photo;
                        var defaultImgStr = "{{ asset('images/user.png')}}";
                        firstDivInnerHTML += '<a href="'+urlStr+'" >';
                        if(obj.photo){
                            firstDivInnerHTML += '<img src="'+imgStr+'" alt="member1 image" class="image img-circle" >';
                        } else {
                            firstDivInnerHTML += '<img src="'+defaultImgStr+'" alt="member1 image" class="image img-circle" >';
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
                        if(obj.mobile){
                          var mobile = obj.mobile;
                        } else {
                          var mobile = '';
                        }
                        if(firstName || lastName){
                            firstDivInnerHTML += '<h5><strong>'+firstName+' '+lastName+'</strong></h5>';
                        } else {
                            firstDivInnerHTML += '<h5><strong>'+mobile+'</strong></h5>';
                        }
                        firstDivInnerHTML += '</a></div></div>';
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
