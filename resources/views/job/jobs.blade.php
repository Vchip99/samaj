@extends('layouts.app')
@section('header-css')
    <style type="text/css">
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
                    @if(count($jobs) > 0)
                    <div class="row">
                        <div id="allMember">
                        @foreach($jobs as $job)
                        <div class="container row">
                            <div class="">
                                <label for="title">Title:</label> {{$job->title}}
                            </div>
                        </div>
                        <div class=" container row">
                            <div class="">
                                <label for="title">Description:</label> {{$job->description}}
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                    @else
                        No Jobs
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
