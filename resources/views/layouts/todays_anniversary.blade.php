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
                <div class="row" style="color:black;padding-left: 20px">
                    <h4><strong>Todays Anniversary</strong></h4>
                </div>
                <div class="row" id="allMember">
                    @if(count($members) > 0)
                        @foreach($members as $member)
                        <div class="col-md-4 col-sm-6 col-xs-6 col-1 text-center" >
                            <div class="member1 text-center">
                                <a href="{{url('member')}}/{{$member->id}}" >
                                    @if(!empty($member->photo) && is_file($member->photo))
                                        <img src="{{ asset($member->photo)}}" alt="{{$member->f_name}} {{$member->l_name}}" class="image img-circle" >
                                    @else
                                        <img src="{{ asset('images/user.png')}}" alt="{{$member->f_name}} {{$member->l_name}}" class="image img-circle" >
                                    @endif
                                    <h5><strong>
                                        @if(!empty($member->f_name) || !empty($member->l_name))
                                            {{$member->f_name}} {{$member->l_name}}
                                        @else
                                            &nbsp;
                                        @endif
                                    </strong></h5>
                                    @if(!empty($member->profession))
                                        @if('Other' == $member->profession)
                                            @if(!empty($member->other_profession))
                                                @if(strlen($member->other_profession) > 15)
                                                    {{substr($member->other_profession,0,15)}}...
                                                @else
                                                    {{$member->other_profession}}
                                                @endif
                                            @else
                                                Profession
                                            @endif
                                        @else
                                            {{$member->profession}}
                                        @endif
                                    @else
                                        Profession
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    @else
                        Today, there is no anniversary of any member.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
