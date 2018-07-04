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
            <h4>@if(empty($description->id)) Add @else Update @endif Group Description</h4>
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
            @if(empty($description->id))
                <form class="form-horizontal" method="POST" action="{{ url('create-description') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            @else
                <form class="form-horizontal" method="POST" action="{{ url('update-description') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <input type="hidden" name="description_id" value="{{$description->id}}">
            @endif
                <div class="form-group ">
                    <label for="" class="col-md-3 control-label">Group <sup>*</sup></label>
                    <div class="col-md-3">
                        <select class="form-control" name="group_id" required>
                            <option value="">Select Group</option>
                            @if(count($groups) > 0)
                                @foreach($groups as $group)
                                     @if(!empty($description->id) && $group->id == $description->group_id)
                                        <option value="{{$group->id}}" selected>{{$group->name}}</option>
                                    @else
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description" rows="5">{{ (!empty($description->id))?$description->description:old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group" >
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">@if(!empty($description->id))Update Description @else Add Description @endif</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="min-height: 195px !important"></div>
</div>
@include('layouts.footer')
@endsection
