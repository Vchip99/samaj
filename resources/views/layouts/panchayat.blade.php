@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
    </style>
@endsection
@section('content')
<div class="container top-margin">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-body">
                <div align="center"  style="border-bottom: 1px solid black; text-transform:uppercase;"><label>{{$groupName}}</label></div>
                @if(!empty($panchayatSubGroup[$groupId]) &&count($panchayatSubGroup[$groupId]) > 0)
                    @foreach($panchayatSubGroup[$groupId] as $subGroupId => $panchayatSubGroup)
                        <div class="row" style="border-bottom: 1px solid black">
                            <div align="center"><label>{{$panchayatSubGroup}}</label></div>
                            @if(count($groupPositions) > 0)
                                @foreach($groupPositions[$groupId][$subGroupId] as $positionId => $groupPosition)
                                    @if(!empty($memberPositions[$positionId]) && count($memberPositions[$positionId]) > 0)
                                        @foreach($memberPositions[$positionId] as $member)
                                            <div class="col-md-4 col-sm-6 col-xs-6 col-1 text-center" >
                                                <div class="member1 text-center">
                                                    <a href="{{url('member')}}/{{$member['id']}}" >
                                                        @if(!empty($member['photo']))
                                                            <img id="image2" src="{{ asset($member['photo'])}}" alt="profile pic" class="img-circle image" >
                                                        @else
                                                            <img id="image2" src="{{ asset('images/user.png')}}" alt="profile pic" class="img-circle image" >
                                                        @endif
                                                        <h4><strong id="m2">{{$member['name']}}</strong></h4>
                                                        <h5><strong id="p2">{{$groupPosition}}</strong></h5>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                @else
                    No member associated.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
