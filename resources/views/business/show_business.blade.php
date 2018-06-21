@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .memberinfotop{
            margin-top: 100px;
        }
        .memberinfo{
            margin:10px;
        }
        .image{
            height:150px;
            width:150px;
        }
        .topcontent{
            /*padding-top:20px;*/
            padding:20px 20px;
        }
        .content{
            padding-top: 20px;
            padding-left: 5px;
        }
        .button{
            float:right;
        }
        #map{
            width:180px;
            height:180px;
            background:yellow;
            margin:auto;
        }
        @media only screen and (max-width: 360px){
            body{
                font-size: 12px;
            }
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row" style="min-height: 760px !important;">
        @if(1 == Auth::user()->is_super_admin)
        <div class="col-md-8 memberinfotop col-md-offset-2">
            <button class="btn btn-primary" style="float: right; margin-left: 5px;" onClick="confirmDelete({{$business->id}});">Delete</button>
            <form id="deleteBusiness_{{$business->id}}" action="{{url('delete-business')}}" method="POST" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <input type="hidden" name="business_id" value="{{$business->id}}">
          </form>
          <a class="btn btn-default" style="float: right;" href="{{url('business')}}/{{$business->id}}/edit" >Edit</a>
        </div>
            <div class="col-md-8  col-md-offset-2">
        @else
            <div class="col-md-8 memberinfotop col-md-offset-2">
        @endif
            <div style="border:1px solid black">
                <div class="row memberinfo" >
                    <div class="col-md-5 text-center">
                        @if(!empty($business->logo))
                            <img src="{{ asset($business->logo)}}" alt="business image" style="border:2px solid #D3E0E9" class="image">
                        @else
                            <img src="{{ asset('images/business_logo.jpeg')}}" alt="business image" style="border:2px solid #D3E0E9" class="image">
                        @endif
                    </div>
                    <div class="col-md-7 text-center topcontent" align="right;">
                        <p><h4><strong>{{$business->name}}</strong></h4></p>
                        @if('Other' == $business->business_category)
                            <h5>{{$business->other_business}}</h5>
                        @else
                            <h5>{{$business->business_category}}</h5>
                        @endif
                        <p>{{$business->website}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <br>
            </div>
            <div style="border:1px solid black">
                <div class="row memberinfo" >
                    <div class="col-md-6">
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Phone:</strong></div><div style="width: 60%;  float: right;">{{($business->phone)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Email:</strong></div><div style="width: 60%;  float: right;">{{($business->email)?:'-'}}</div>
                        </div>
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Address:</strong></div><div style="width: 60%;  float: right;">{{($business->address)?:'-'}}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row content">
                            <div style="width: 40%; float: left;"><strong>Description:</strong></div><div style="width: 60%;  float: right;">{{($business->description)?:'-'}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row memberinfo" >
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
    function confirmDelete(id){
        var message = 'Are You sure, you want to delete this business?';
        if(confirm(message)){
            formId = 'deleteBusiness_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }
</script>
@endsection
