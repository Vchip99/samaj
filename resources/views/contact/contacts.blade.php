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
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(count($contacts) > 0)
                <div class="row">
                    <div id="allMember">
                        @foreach($contacts as $contact)
                        <div class="row memberinfo">
                            <div class="col-md-4">
                                <div class="content">
                                    <div class="col-xs-2">
                                        <p><strong>Name:</strong></p>
                                        <p><strong>Phone:</strong></p>
                                    </div>
                                    <div class="col-xs-5">
                                        <p>{{($contact->name)?:'-'}}</p>
                                        <p>{{($contact->phone)?:'-'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row content">
                                    <h4><strong>Description:</strong></h4>
                                    <div>{{($contact->description)?:'-'}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
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
@endsection
