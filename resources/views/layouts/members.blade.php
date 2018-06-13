@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .members{
            margin-top: 100px;
        }
        .topcontent{
            margin-top:10px;
            margin-bottom: 10px;
            border:1px solid black;

        }
        .image{
            height:180px;
            width:180px;
        }
        a{
            color:black;
            text-decoration: none;
        }
        .member1{
            width: 78%;
            display:block;
            margin:auto;
        }
        @media only screen and (max-width: 610px){
            .col-1{width: 100%;}
            .col-2{width: 100%;}
            .col-3{width: 100%;}
            .col-4{width: 100%;}
            .member1{width:230px;}
        }
        @keyframes animate{
            from{height:0%;}
            to{height:100%;}
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row" style="min-height: 760px !important;">
        <div class="col-md-10 col-md-offset-1">
            <div class="members">
                <div class="row">
                    <div class="col-md-3">
                        <div class="topcontent form-group">
                            <select class="form-control" name="profession" id="profession" onChange="searchProfessionMember(this.value);">
                                <option value="">Select Profession</option>
                                <option value="All">All</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Advocate">Advocate</option>
                                <option value="Architect">Architect</option>
                                <option value="Businessman">Businessman</option>
                                <option value="CA">CA</option>
                                <option value="Designer graphic and other">Designer graphic and other</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Engineers">Engineers</option>
                                <option value="Farmer">Farmer</option>
                                <option value="Government Job">Government Job</option>
                                <option value="Other">Other</option>
                                <option value="Private Job">Private Job</option>
                                <option value="Self employee">Self employee</option>
                                <option value="Students">Students</option>
                                <option value="Surveyors">Surveyors</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Technicians">Technicians</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="topcontent">
                            <input type="text" name="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this.value);">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <hr>
                </div>
                <div class="row" style="color:black;padding-left: 20px">
                    <h4><strong>All Members</strong></h4>
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
                                    <h5><strong>
                                        @if(!empty($member->f_name) || !empty($member->l_name))
                                            {{$member->f_name}} {{$member->l_name}}
                                        @else
                                            &nbsp;
                                        @endif
                                    </strong></h5>
                                    {{($member->profession)?:'&nbsp;'}}
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
    function searchProfessionMember(profession){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(profession){
            $.ajax({
                method:'POST',
                url: "{{url('search-member-by-profession')}}",
                data:{_token:currentToken,profession:profession}
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
                        if(obj.profession){
                          var profession = obj.profession;
                        } else {
                          var profession = '&nbsp;';
                        }
                        firstDivInnerHTML += '<h5><strong>'+firstName+' '+lastName+'</strong></h5>'+profession+'';
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
    function searchMember(member){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var profession = document.getElementById('profession').value;
        if(member.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-member')}}",
                data:{_token:currentToken,member:member,profession:profession}
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
                        if(obj.profession){
                          var profession = obj.profession;
                        } else {
                          var profession = '';
                        }
                        firstDivInnerHTML += '<h3><strong>'+firstName+' '+lastName+'</strong></h3><h4><strong>'+profession+'</strong></h4>';
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
