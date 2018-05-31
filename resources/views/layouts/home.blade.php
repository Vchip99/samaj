@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
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
                    <div class="row">
                        <div class="" align="center">
                            @if(!empty($loginUser->photo))
                                <a href="{{url('member')}}/{{$loginUser->id}}/edit"><img src="{{ asset($loginUser->photo)}}" class="user-photo"></a>
                            @else
                                <a href="{{url('member')}}/{{$loginUser->id}}/edit"><img src="{{ asset('images/user.png')}}" class="user-photo"></a>
                            @endif
                        </div>
                        <p align="center"> {{$loginUser->f_name}}</p>
                    </div>
                    @if(count($otherMembers) > 0)
                    <hr>
                    <div class="row">
                        <div class="panel-heading">Family Members</div>
                        @foreach($otherMembers as $otherMember)
                        <div class="col-md-2">
                            @if(!empty($otherMember->photo))
                                <a href="{{url('member')}}/{{$otherMember->id}}/edit" ><img src="{{ asset($otherMember->photo)}}" class="user-photo"></a>
                            @else
                                <a href="{{url('member')}}/{{$otherMember->id}}/edit" ><img src="{{ asset('images/user.png')}}" class="user-photo"></a>
                            @endif
                            <p align="center"> {{$otherMember->f_name}}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
