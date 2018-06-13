@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1" >
            <div class="home">
                @if(Session::has('message'))
                    <div class="alert alert-success" id="message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="row dashboard" >
                <h4><strong>Family Head</strong></h4>
                </div>
                <div class="row profpic text-center" >
                    <a href="{{url('member')}}/{{$loginUser->id}}/edit">
                    @if(!empty($loginUser->photo))
                        <img src="{{ asset($loginUser->photo)}}" class="img-circle image" >
                    @else
                        <img src="{{ asset('images/user.png')}}" class="img-circle image" >
                    @endif
                    <h3 style="text-align:center;color:black"><strong>{{$loginUser->f_name}} {{$loginUser->l_name}}</strong></h3>
                    <p style="text-align:center;color:black"><strong>{{$loginUser->profession}}</strong></p>
                    </a>
                </div>
                <div class="row family_top">
                    <h4><strong>Family Members</strong></h4>
                </div>
                <div class="row" style="border-bottom: 1px solid black;">
                    @if(count($otherMembers) > 0)
                        @foreach($otherMembers as $otherMember)
                            <div class="col-md-4 col-sm-6 col-xs-6 col-1 text-center" >
                                <div class="member1 text-center">
                                    <a href="{{url('member')}}/{{$otherMember->id}}/edit" >
                                        @if(!empty($otherMember->photo))
                                                <img id="image2" src="{{ asset($otherMember->photo)}}" alt="profile pic" class="img-circle image" >
                                        @else
                                            <img id="image2" src="{{ asset('images/user.png')}}" alt="profile pic" class="img-circle image" >
                                        @endif
                                        <h4><strong id="m2">
                                            @if(!empty($otherMember->f_name) || !empty($otherMember->l_name))
                                                {{$otherMember->f_name}} {{$otherMember->l_name}}
                                            @else
                                                &nbsp;
                                            @endif
                                        </strong></h4>
                                        <h5><strong id="m2">{{($otherMember->profession)?:'&nbsp;'}}</strong></h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No Family Members
                        <div style="min-height: 78px;"></div>
                    @endif
                </div>
                <div class="row family_top">
                    <h4><strong>Business</strong></h4>
                </div>
                <div class="row" style="border:2px solid #D3E0E9;">
                     @if(count($businesses) > 0)
                        @foreach($businesses as $business)
                            <div class="col-md-6" style="border-right:2px solid #D3E0E9">
                                <div class="row" style="border-bottom: 2px solid #D3E0E9;">
                                    <div class="col-xs-6 col-2 " >
                                        <div style="margin:10px auto;" class="text-center">
                                            <a href="{{ url('business')}}/{{$business->id}}">
                                                @if(!empty($business->logo))
                                                    <img src="{{ asset($business->logo)}}" alt="business image" style="border:2px solid #D3E0E9" class="image">
                                                @else
                                                    <img src="{{ asset('images/business_logo.jpeg')}}" alt="business image" style="border:2px solid #D3E0E9" class="image">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 text-center col-2"  style="padding-top: 20px;">
                                        <a href="{{ url('business')}}/{{$business->id}}">
                                            <h4><strong>{{$business->name}}</strong></h4>
                                            <h4>{{$business->business_category}}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No Business
                        <div style="min-height: 7px;"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
