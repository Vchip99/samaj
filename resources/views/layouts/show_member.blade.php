@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .memberinfotop{
            margin-top: 100px;
        }
        .memberinfo{
            margin:10px;
        }
        .image{
            height:150px;
            width:150px;
        }
        .topcontent{
            padding-top:20px;
        }
        .content{
            padding-top: 20px;


        }

        .button{
            float:right;

        }
        .button1{
            float:left;
        }
        @media only screen and (max-width: 418px){
            body{
                font-size: 13px;
            }
        }
        @media only screen and (max-width: 386px){
            body{
                font-size: 12px;
            }
        }
        @media only screen and (max-width: 375px){
            body{
                font-size: 11px;
            }
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 memberinfotop col-md-offset-2">
            <div style="border:1px solid black;">
                <div class="row memberinfo" >
                    <div class="col-md-3 text-center">
                        @if(!empty($member->photo))
                            <img src="{{ asset($member->photo)}}" alt="member1 image" class="image img-circle" >
                        @else
                            <img src="{{ asset('images/user.png')}}" alt="member1 image" class="image img-circle" >
                        @endif
                    </div>
                    <div class="col-md-5 text-center topcontent">
                        <h4><strong>{{$member->f_name}} {{$member->l_name}}</strong></h4>
                        <h4><strong>{{$member->designation}}</strong></h4>
                        <h4><strong>{{$member->profession}}</strong></h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black;">
                <div class="row memberinfo"  >
                    <div class="col-md-6">
                        <div class="row content">
                            <div class="col-xs-5">
                                <p><strong>Gotra:</strong></p>
                                <p><strong>Email:</strong></p>
                                <p><strong>Mobile:</strong></p>
                                <p><strong>Landline no.:</strong></p>
                                <p><strong>DOB:</strong></p>

                            </div>
                            <div class="col-xs-7">
                                <p>{{($member->gotra)?:'-'}}</p>
                                <p>{{($member->email)?:'-'}}</p>
                                <p>{{($member->mobile)?:'-'}}</p>
                                <p>{{($member->land_line_no)?:'-'}}</p>
                                <p>{{($member->dob)?:'-'}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row content">
                            <div class="col-xs-5" >
                                <p><strong>Anniversary Date:</strong></p>
                                <p><strong>Marital Status:</strong></p>
                                <p><strong>Spouse Name:</strong></p>
                                <p><strong>Blood Group:</strong></p>
                                <p><strong>Education:</strong></p>
                                <div style="height:60px;width:100%;">
                                <p><strong>Address:</strong></p>
                                </div>
                            </div>
                            <div class="col-xs-7" style="padding-left: 10px;"">
                                <p>{{($member->anniversary)?:'-'}}</p>
                                <p>{{(1 == $member->married_status)?'Married':'Un-Married'}}</p>
                                <p>{{($member->spouse)?:'-'}}</p>
                                <p>{{($member->blood_group)?:'-'}}</p>
                                <p>{{($member->education)?:'-'}}</p>
                                <div style="height:60px;width:100%;">
                                <p>{{($member->address)?:'-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black;">
                <div class="row memberinfo" >
                    <div class="col-md-6">
                        <h4><strong>Family</strong></h4>
                        @if(count($familyMembers) > 0)
                            @foreach($familyMembers as $familyMember)
                                <p>
                                    <strong>
                                        @if('Admin' == $familyMember->admin_relation)
                                            Family Head &nbsp;&nbsp;-
                                        @else
                                            {{$familyMember->admin_relation}} &nbsp;&nbsp;-
                                        @endif
                                    </strong>
                                    <a href="{{url('member')}}/{{$familyMember->id}}" >{{$familyMember->f_name}} {{$familyMember->l_name}}</a>
                                </p>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4><strong>Business</strong></h4>
                        @if(count($familyBusinesses) > 0)
                            @foreach($familyBusinesses as $familyBusiness)
                                <p><strong><a href="{{ url('business')}}/{{$familyBusiness->id}}">{{$familyBusiness->name}}</a></strong></p>
                            @endforeach
                        @else
                            <p>No Business </p>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="row memberinfo">
                    @if(!empty($familyBusiness->bio_data))
                    <div class="button1">
                        <a href="{{asset($familyBusiness->bio_data)}}" download="" class="btn btn-success" id="myBtn"><span class="glyphicon glyphicon-download-alt">
                        </span> Bio Data</a>
                    </div>
                    @endif
                    @if(!empty($familyBusiness->kundali))
                    <div class="button1">
                        <a href="{{asset($familyBusiness->bio_data)}}" download="" class="btn btn-success" id="myBtn"><span class="glyphicon glyphicon-download-alt">
                        </span> Kundali</a>
                    </div>
                    @endif
                    <div class="button">
                        <a href="{{ url($previousUrl)}}"><button type="button"  class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
