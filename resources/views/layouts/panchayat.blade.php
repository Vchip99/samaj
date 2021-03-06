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
                <div class="panel-body" style="min-height: 680px !important;">
                <div align="center"  style="text-transform:uppercase;"><label>{{$groupName}}</label></div>
                @if(is_object($description))
                    <div align="center"  style="border-top: 1px solid black;"><label>
                        {!! $description->description !!}
                    </label></div>
                @endif
                @if(!empty($panchayatSubGroup[$groupId]) && count($panchayatSubGroup[$groupId]) > 0)
                    @foreach($panchayatSubGroup[$groupId] as $subGroupId => $panchayatSubGroupName)
                        @if(isset($memberPositions[$subGroupId]) && count($memberPositions[$subGroupId]) > 0)
                        <div class="row" style="border-top: 1px solid black;">
                            <div align="center"><label>{{$panchayatSubGroupName}}</label></div>
                            @if(count($groupPositions) > 0)
                                @foreach($groupPositions as $positionId => $groupPosition)
                                    @if(isset($memberPositions[$subGroupId][$positionId]) && count($memberPositions[$subGroupId][$positionId]) > 0)
                                        @php ksort($memberPositions[$subGroupId]) @endphp
                                        @foreach($memberPositions[$subGroupId][$positionId] as $member)
                                            <div class="col-md-4 col-sm-6 col-xs-6 col-1 text-center" >
                                                <div class="member1 text-center">
                                                    <a href="{{url('member')}}/{{$member['id']}}" >
                                                        @if(!empty($member['photo']) && is_file($member['photo']))
                                                            <img id="image2" src="{{ asset($member['photo'])}}" alt="{{$member['name']}}" class="img-circle image" >
                                                        @else
                                                            <img id="image2" src="{{ asset('images/user.png')}}" alt="{{$member['name']}}" class="img-circle image" >
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
                        @endif
                    @endforeach
                @else
                    No member associated.
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection
