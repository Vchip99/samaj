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
    </style>
@endsection
@section('content')
<div class="container top-margin">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                @if(Session::has('message'))
                    <div class="alert alert-success" id="message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('check-otp') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                            <label for="otp" class="col-md-3 control-label">OTP <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control" name="otp" value="" required placeholder="enter otp" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
