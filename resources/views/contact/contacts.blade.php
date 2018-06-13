@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
        .notification-image {
            padding: 10px;
            width: 150px;
            height: 150px;
        }
    </style>
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
<div class="container top-margin">
    <div class="row" style="min-height: 700px !important;">
        <div class="col-md-10 col-md-offset-1">
            <div class="">
                @if(count($contacts) > 0)
                <div class="row">
                    <div id="allMember" style="border: 2px solid grey;">
                        @foreach($contacts as $contact)
                        <div class="row memberinfo">
                            <p><strong>Name: </strong>{{($contact->name)?:'-'}}</p>
                            <p><strong>Phone: </strong>{{($contact->phone)?:'-'}}</p>
                            <p><strong>Description: </strong>{{($contact->description)?:'-'}}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                @else
                    No notification
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
