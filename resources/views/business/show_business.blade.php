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
            padding-left: 5px;
        }
        .button{
            float:right;
        }
        #map{
            width:180px;
            height:180px;
            background:yellow;
            margin:auto;
        }
        @media only screen and (max-width: 360px){
            body{
                font-size: 12px;
            }
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 memberinfotop col-sm-offset-2">
            <div style="border:1px solid black">
                <div class="row memberinfo" >
                    <div class="col-md-3 text-center">
                        @if(!empty($business->logo))
                            <img src="{{ asset($business->logo)}}" alt="business image" style="border:2px solid #D3E0E9">
                        @else
                            <img src="{{ asset('images/business_logo.jpeg')}}" alt="business image" style="border:2px solid #D3E0E9">
                        @endif
                    </div>
                    <div class="col-md-5 text-center topcontent">
                        <h4><strong>{{$business->name}}</strong></h4>
                        <h4><strong>{{$business->businessCategory->name}}</strong></h4>
                        @if(!empty($business->business_sub_category_id))
                            <h4><strong>{{$business->businessSubcategory->name}}</strong></h4>
                        @endif
                        <p><strong>{{$business->website}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black">
                <div class="row memberinfo" >
                    <div class="col-md-6">
                        <div class="row content">
                            <div class="col-xs-5">
                                <p><strong>Phone:</strong></p>
                                <p><strong>Email:</strong></p>
                                <div style="height:60px;width:100%;">
                                    <p><strong>Address:</strong></p>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <p>{{($business->phone)?:'-'}}</p>
                                <p>{{($business->email)?:'-'}}</p>
                                <div style="height:60px;width:100%;">
                                    <p>{{($business->address)?:'-'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row content text-center">
                            <h4><strong>Description:</strong></h4>
                            <div>{{($business->description)?:'-'}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row memberinfo" >
                    <div class="button">
                        <a href="{{ url($previousUrl)}}"><button type="button"  class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
