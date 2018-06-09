@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        sup {
            color: red;
            position: relative;
            line-height: 0;
            vertical-align: baseline;
            font-size: 15px;
        }
        .container{
          margin-top: 80px;
        }
        #r1{
          box-sizing: border-box;
          padding: 10px 15px;
          color: blue;
          border: 1px solid #d3e0e9;
          background-color: #fff;
          border-top-left-radius: 4px;
          border-top-right-radius: 4px;
        }
        #r2{
          border: 1px solid #d3e0e9;
        }
        .button{
            float:right;
        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    <div style="margin:10px;">
        <div class="row" id="r1">
            @if(empty($job->id))
                <h4>Add Job</h4>
            @else
                <h4>Update Job</h4>
            @endif
        </div>
        <div class="row" id="r2">
            @if(count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success" id="message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            @if(empty($job->id))
                <form class="form-horizontal" method="POST" action="{{ url('create-job') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            @else
                <form class="form-horizontal" method="POST" action="{{ url('update-job') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <input type="hidden" name="job_id" value="{{$job->id}}">
            @endif
                <div class="form-group">
                    <label for="title" class="col-md-3 control-label">Title <sup>*</sup></label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ (!empty($job->id))?$job->title:old('title') }}"  placeholder="Title" required>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">Description <sup>*</sup></label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description" rows="5" required>{{ (!empty($job->id))?$job->description:old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group" >
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">@if(!empty($job->id))Update Job @else Add Job @endif</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
