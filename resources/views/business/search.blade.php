@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        /*.search-label{
          margin-left: 10%;
          margin-top: 17%;
        }*/
        #r1{
          box-sizing: border-box;
          border: 1px solid #ddd;
          margin-top: 80px;
          border-top-right-radius: 4px;
          border-top-left-radius: 4px;

        }

        img{
          width: 230px;
          height:160px;
        }

        a{
          text-decoration: none;
          color:black;
        }
        @media only screen and (max-width: 580px){
          .col-1{width:100%;}
        }
        .border-style{
            border:2px solid #D3E0E9;
        }
        .border-style1{
            border-right:2px solid #D3E0E9;
        }
        .cust-margin{
            margin:10px auto;
        }
        .cust-padding{
            padding-top: 20px;
        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row" id="r1">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-3">
                            <select class="form-control" name="business_category" id="business_category">
                                <option value="">Select Business Category</option>
                                <option value="All">All</option>
                                @if(count($businessCategories) > 0)
                                    @foreach($businessCategories as $businessCategory)
                                        <option value="{{$businessCategory->id}}">{{$businessCategory->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="topcontent">
                                <input type="text" name="business" class="form-control"  placeholder="search business" onfocus onkeyup="searchBusiness(this.value);" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row border-style" id="allBusiness">
                @if(count($businesses) > 0)
                    @foreach($businesses as $business)
                        <div class="col-md-6 border-style1">
                            <div class="row" >
                                <div class="col-xs-6 col-2 " >
                                    <div class="text-center cust-margin">
                                        <a href="{{ url('business')}}/{{$business->id}}">
                                            @if(!empty($business->logo))
                                                <img src="{{ asset($business->logo)}}" class="border-style" alt="business image">
                                            @else
                                                <img src="{{ asset('images/business_logo.jpeg')}}" class="border-style" alt="business image">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-center col-2 cust-padding">
                                    <a href="{{ url('business')}}/{{$business->id}}">
                                        <h4><strong>{{$business->name}}</strong></h4>
                                        <h4>{{$business->businessCategory->name}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    No Business
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function searchBusiness(business){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var businessCategory = document.getElementById('business_category').value;
        if(business.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-business')}}",
                data:{_token:currentToken,business:business,business_category:businessCategory}
            }).done(function( businesses ) {
              console.log(businesses);
                var allBusiness = document.getElementById('allBusiness');
                allBusiness.innerHTML = '';
                if(businesses.length > 0){
                    $.each(businesses, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'col-md-6 border-style1';
                        firstDivInnerHTML = '<div class="row" ><div class="col-xs-6 col-2 " ><div class="text-center cust-margin">';
                        var urlStr = "{{url('business')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.logo;
                        var defaultImgStr = "{{ asset('images/business_logo.jpeg')}}";
                        firstDivInnerHTML += '<a href="'+urlStr+'" >';
                        if(obj.logo){
                            firstDivInnerHTML += '<img src="'+imgStr+'" class="border-style" alt="business image">';
                        } else {
                            firstDivInnerHTML += '<img src="'+defaultImgStr+'" class="border-style" alt="business image">';
                        }
                        firstDivInnerHTML += '</a></div></div>';
                        firstDivInnerHTML += '<div class="col-xs-6 text-center col-2 cust-padding"><a href="'+urlStr+'" ><h4><strong>'+obj.name+'</strong></h4><h4>'+obj.category_name+'</h4></a></div></div></div>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allBusiness.appendChild(firstDiv);
                    })
                } else {
                    allBusiness.innerHTML = 'No Result';
                }
            });
        } else if( 0 == business.length) {
            window.location.reload();
        }
    }
</script>
@endsection
