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
            margin-top: 100px;
        }
        .panel-heading{
            box-sizing: border-box;
            padding-top: 15px;
            padding-left: 25px;
            font-size: 18px;
        }
        .row{
            border:1px solid #D3E0E9;
        }
        .button{
            float:right;
        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    <div style="margin:10px;">
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
            <div class="row panel-heading" style="color: blue;">Create Admin</div>
            <div class="row">
                <form class="form-horizontal" method="POST" action="{{ url('create-admin') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name <sup>*</sup></label>
                        <div class="col-md-3">
                            <input id="f_name" type="text" class="form-control" name="f_name" value="{{ (!empty($member->id))?$member->f_name:old('f_name') }}"  placeholder="first name" required>
                            @if ($errors->has('f_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('f_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <input id="l_name" type="text" class="form-control" name="l_name" value="{{ (!empty($member->id))?$member->l_name:old('l_name') }}"  placeholder="last name" required>
                            @if ($errors->has('l_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('l_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label for="mobile" class="col-md-3 control-label">Mobile <sup>*</sup></label>
                        <div class="col-md-6">
                            <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ (!empty($member->id))?$member->mobile:old('mobile') }}"  placeholder="10 digit mobile number" pattern="[0-9]{10}" required>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="is_member" class="col-md-3 control-label">Select Type<sup>*</sup></label>
                        <div class="col-md-2">
                            <input type="radio" name="is_member" value="1" checked="true"> Member
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="is_member" value="0"> Non-Member(Parinay)
                        </div>
                    </div>
                    <div class="form-group" >
                        <div class="col-md-9 " >
                            <div class="button">
                                <button type="submit" class="btn btn-primary">Create Admin</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div style="min-height: 400px !important"></div>
    </div>
</div>
@include('layouts.footer')
@endsection
