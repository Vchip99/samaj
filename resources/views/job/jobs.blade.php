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
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($jobs) > 0)
                    <div class="row">
                        <div id="allMember">
                        @foreach($jobs as $job)
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title">Title:</label> {{$job->title}}
                            </div>
                            <div class="col-md-9">
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
@endsection
