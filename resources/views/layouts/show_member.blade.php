@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .memberinfotop{
            margin-top: 80px;
        }
        .memberinfo{
            margin:10px;
        }
        .image{
            height:150px;
            width:150px;
        }
        .topcontent{
            padding-top:20px;
        }
        .content{
            padding-top: 20px;


        }

        .button{
            float:right;

        }
        .button1{
            float:left;
        }
        @media only screen and (max-width: 418px){
            body{
                font-size: 13px;
            }
        }
        @media only screen and (max-width: 386px){
            body{
                font-size: 12px;
            }
        }
        @media only screen and (max-width: 375px){
            body{
                font-size: 11px;
            }
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        @if(1 == Auth::user()->is_super_admin)
        <div class="col-md-8 memberinfotop col-md-offset-2">
            <button class="btn btn-primary" style="float: right;" onClick="deleteMember({{$member->is_admin}},{{$member->id}});">Delete</button>
            <form id="deleteMember_{{$member->id}}" method="POST" action="{{ url('delete-member') }}">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
                <input type="hidden" name="member_id" value="{{$member->id}}">
            </form>
        </div>
            <div class="col-md-8  col-md-offset-2">
        @else
            <div class="col-md-8 memberinfotop col-md-offset-2">
        @endif
            <div style="border:1px solid black;">
                <div class="row memberinfo" >
                    <div class="col-md-4 text-center">
                        @if(!empty($member->photo))
                            <img src="{{ asset($member->photo)}}" alt="member1 image" class="image img-circle" >
                        @else
                            <img src="{{ asset('images/user.png')}}" alt="member1 image" class="image img-circle" >
                        @endif
                    </div>
                    <div class="col-md-7 text-center topcontent">
                        <h4><strong>{{$member->f_name}} {{$member->l_name}}</strong></h4>
                        <h5><strong>{{$member->designation}}</strong></h5>
                        <h5><strong>{{$member->profession}}</strong></h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black;">
                <div class="row memberinfo"  >
                    <div class="col-md-6">
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Relation with admin:</strong></div><div style="width: 60%;  float: right;">{{($member->admin_relation)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Email:</strong></div><div style="width: 60%;  float: right;">{{($member->email)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Mobile:</strong></div><div style="width: 60%;  float: right;">{{($member->mobile)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Landline no.:</strong></div><div style="width: 60%;  float: right;">{{($member->land_line_no)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>DOB:</strong></div><div style="width: 60%;  float: right;">{{($member->dob)?:'-'}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Anniversary Date:</strong></div><div style="width: 60%;  float: right;">{{($member->anniversary)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Marital Status:</strong></div><div style="width: 60%;  float: right;">{{(1 == $member->married_status)?'Married':'Un-Married'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Spouse Name:</strong></div><div style="width: 60%;  float: right;">{{($member->spouse)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Blood Group:</strong></div><div style="width: 60%;  float: right;">{{($member->blood_group)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Education:</strong></div><div style="width: 60%;  float: right;">{{($member->education)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Address:</strong></div><div style="width: 60%;  float: right;">{{($member->address)?:'-'}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black;">
                <div class="row memberinfo" style="min-height: 130px !important;">
                    <div class="col-md-6">
                        <h4><strong>Family</strong></h4>
                        @if(count($familyMembers) > 0)
                            @foreach($familyMembers as $familyMember)
                                <p>
                                    <a href="{{url('member')}}/{{$familyMember->id}}" >{{$familyMember->f_name}} {{$familyMember->l_name}}</a>
                                </p>
                            @endforeach
                        @else
                            -
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4><strong>Business</strong></h4>
                        @if(count($familyBusinesses) > 0)
                            @foreach($familyBusinesses as $familyBusiness)
                                <p><a href="{{ url('business')}}/{{$familyBusiness->id}}">{{$familyBusiness->name}}</a></p>
                            @endforeach
                        @else
                            <p>No Business </p>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="row memberinfo">
                    @if(!empty($familyBusiness->bio_data))
                    <div class="button1">
                        <a href="{{asset($familyBusiness->bio_data)}}" download="" class="btn btn-success" id="myBtn"><span class="glyphicon glyphicon-download-alt">
                        </span> Bio Data</a>
                    </div>
                    @endif
                    @if(!empty($familyBusiness->kundali))
                    <div class="button1">
                        <a href="{{asset($familyBusiness->bio_data)}}" download="" class="btn btn-success" id="myBtn"><span class="glyphicon glyphicon-download-alt">
                        </span> Kundali</a>
                    </div>
                    @endif
                    <div class="button">
                        <a href="{{ url($previousUrl)}}"><button type="button"  class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span>back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    function deleteMember(isAdmin,memberId){
        if(1 == isAdmin ){
            var message = 'This is a Admin. If you delete this member, then its family members also deleted.';
        } else {
            var message = 'Are you sure you want to delete this member?';
        }
        if(confirm(message)){
            formId = 'deleteMember_'+memberId;
            document.getElementById(formId).submit();
        }
        return false;
    }
</script>
@endsection
