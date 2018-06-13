@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .notification-image {
            padding: 10px;
            width: 150px;
            height: 150px;
        }
        #allMember{
            padding: 10px 10px;
        }
    </style>
@endsection
@section('content')
<div class="container top-margin">
    <div class="row" style="min-height: 700px !important;">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($notifications) > 0)
                    <div class="row">
                        <div id="allMember">
                        @foreach($notifications as $notification)
                        <div class="row">
                            @if(!empty($notification->image))
                                <div class="col-md-3">
                                    <img src="{{ asset($notification->image)}}" class="notification-image">
                                </div>
                                <div class="col-md-9">
                                    {{$notification->message}}
                                </div>
                            @else
                                <div class="col-md-12">
                                    {{$notification->message}}
                                </div>
                            @endif
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
</div>
@include('layouts.footer')
@endsection
