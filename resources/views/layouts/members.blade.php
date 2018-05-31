@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
            margin-left: 5%;
            margin-top: 10%;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading "> Dashboard
                    <!-- <input type="text" name="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this);"> -->
                </div>
                <!-- <div>
                    <input type="text" name="member" class="form-control"  placeholder="search member">
                </div> -->
                <div class="panel-body">
                    @if(count($members) > 0)
                    <div class="row">
                        <div class="panel-heading">All Members</div>
                        @foreach($members as $member)
                        <div class="col-md-6">
                            <div class="col-md-3">
                                @if(!empty($member->photo))
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset($member->photo)}}" class="user-photo"></a>
                                @else
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset('images/user.png')}}" class="user-photo"></a>
                                @endif
                                <!-- <p align="center"> {{$member->f_name}}</p> -->
                            </div>
                            <!-- <div class="col-md-2" > -->
                                <label class="col-md-2 control-label member-label"> <a href="{{url('member')}}/{{$member->id}}" >{{$member->f_name}}</a></label>
                            <!-- </div> -->
                            <!-- <div class="col-md-1" > -->
                                <label class="col-md-1 control-label member-label"> {{(1==$member->is_admin)?'Admin':'Member'}}</label>
                            <!-- </div> -->
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
