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
    <div class="row" style="min-height: 760px !important;">
        <div class="col-md-10 col-md-offset-1">
            <div class="row" id="r1">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-3">
                            <!-- <select class="form-control" name="business_category" id="business_category">
                                <option value="">Select Business Category</option>
                                <option value="All">All</option>
                            </select> -->
                            <select class="form-control" name="business_category" id="business_category" onChange="getBusinessByCategory(this.value);">
                                <option value="">Select Business Category</option>
                                <option value="All">All</option>
                                <optgroup label="Accountant">
                                    <option value="Accountant" >Accountant</option>
                                </optgroup>
                                <optgroup label="Advocate">
                                    <option value="Advocate" >Advocate</option>
                                </optgroup>
                                <optgroup label="Architect">
                                    <option value="Architect" >Architect</option>
                                </optgroup>
                                <optgroup label="Bichayat/Decoration">
                                    <option value="Bichayat/Decoration" >Bichayat/Decoration</option>
                                </optgroup>
                                <optgroup label="Broker">
                                    <option value="Cotton(Broker)" >Cotton(Broker)</option>
                                    <option value="Finance(Broker)" >Finance(Broker)</option>
                                    <option value="Grain(Broker)" >Grain(Broker)</option>
                                    <option value="LIC Agent" >LIC Agent</option>
                                    <option value="Property(Broker)" >Property(Broker)</option>
                                    <option value="Share(Broker)" >Share(Broker)</option>
                                </optgroup>
                                <optgroup label="Builder & Land developer">
                                    <option value="Builder & Land developer" >Builder & Land developer</option>
                                </optgroup>
                                <optgroup label="CA">
                                    <option value="CA" >CA</option>
                                </optgroup>
                                <optgroup label="Catering">
                                    <option value="Catering" >Catering</option>
                                </optgroup>
                                <optgroup label="Cloth Store">
                                    <option value="Cloth Store" >Cloth Store</option>
                                </optgroup>
                                <optgroup label="Coaching Classes">
                                    <option value="Coaching Classes" >Coaching Classes</option>
                                </optgroup>
                                <optgroup label="Designer Graphics and Other">
                                    <option value="Designer Graphics and Other" >Designer Graphics and Other</option>
                                </optgroup>
                                <optgroup label="Dealer">
                                    <option value="Bike/Car(Dealer)" >Bike/Car(Dealer)</option>
                                    <option value="Laptop(Dealer)" >Laptop(Dealer)</option>
                                    <option value="Mobile(Dealer)" >Mobile(Dealer)</option>
                                    <option value="TV/Refrigerator(Dealer)" >TV/Refrigerator(Dealer)</option>
                                </optgroup>
                                <optgroup label="Doctor">
                                    <option value="Doctor" >Doctor</option>
                                </optgroup>
                                <optgroup label="Electrical">
                                    <option value="Electrical" >Electrical</option>
                                </optgroup>
                                <optgroup label="Event Management">
                                    <option value="Event Management" >Event Management</option>
                                </optgroup>
                                <optgroup label="General Store">
                                    <option value="General Store" >General Store</option>
                                </optgroup>
                                <optgroup label="Grain Merchant">
                                    <option value="Grain Merchant" >Grain Merchant</option>
                                </optgroup>
                                <optgroup label="Hardware">
                                    <option value="Hardware" >Hardware</option>
                                </optgroup>
                                <optgroup label="Industry">
                                    <option value="Industry" >Industry</option>
                                </optgroup>
                                <optgroup label="Kirana">
                                    <option value="Kirana" >Kirana</option>
                                </optgroup>
                                <optgroup label="Medical">
                                    <option value="Medical" >Medical</option>
                                </optgroup>
                                <optgroup label="Politician">
                                    <option value="Politician" >Politician</option>
                                </optgroup>
                                <optgroup label="Printing & Designing">
                                    <option value="Printing & Designing" >Printing & Designing</option>
                                </optgroup>
                                <optgroup label="Related to Software Services">
                                    <option value="Related to Software Services" >Related to Software Services</option>
                                </optgroup>
                                <optgroup label="Restaurant">
                                    <option value="Restaurant" >Restaurant</option>
                                </optgroup>
                                <optgroup label="Sonaar (Work in Gold & Silver)">
                                    <option value="Sonaar (Work in Gold & Silver)" >Sonaar (Work in Gold & Silver)</option>
                                </optgroup>
                                <optgroup label="Sweet Mart">
                                    <option value="Sweet Mart" >Sweet Mart</option>
                                </optgroup>
                                <optgroup label="Trainer">
                                    <option value="Trainer" >Trainer</option>
                                </optgroup>
                                <optgroup label="Transport">
                                    <option value="Transport" >Transport</option>
                                </optgroup>
                                <optgroup label="Travel Agent">
                                    <option value="Travel Agent" >Travel Agent</option>
                                </optgroup>
                                <optgroup label="Water Can">
                                    <option value="Water Can" >Water Can</option>
                                </optgroup>
                                <optgroup label="Wholesale Dealer">
                                    <option value="Wholesale Dealer" >Wholesale Dealer</option>
                                </optgroup>
                                <optgroup label="Other">
                                    <option value="Other">Other</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="topcontent">
                                <input type="text" name="business" id="business" class="form-control"  placeholder="search business" onfocus onkeyup="searchBusiness(this.value);" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row border-style" id="allBusiness">
                @if(count($businesses) > 0)
                    @foreach($businesses as $business)
                        <div class="col-md-6 border-style1">
                            <div class="row" style="border-bottom: 2px solid #D3E0E9;">
                                <div class="col-xs-6 col-2 " >
                                    <div class="text-center cust-margin">
                                        <a href="{{ url('business')}}/{{$business->id}}">
                                            @if(!empty($business->logo))
                                                <img src="{{ asset($business->logo)}}" class="border-style image" alt="business image">
                                            @else
                                                <img src="{{ asset('images/business_logo.jpeg')}}" class="border-style image" alt="business image">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-center col-2 cust-padding">
                                    <a href="{{ url('business')}}/{{$business->id}}">
                                        <h5><strong>{{$business->name}}</strong></h5>
                                        @if('Other' == $business->business_category)
                                            {{$business->other_business}}
                                        @else
                                            {{$business->business_category}}
                                        @endif
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
@include('layouts.footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#business').focus();
    });
    function getBusinessByCategory(category){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(category){
            $.ajax({
                method:'POST',
                url: "{{url('get-business-by-category')}}",
                data:{_token:currentToken,category:category}
            }).done(function( businesses ) {
                var allBusiness = document.getElementById('allBusiness');
                allBusiness.innerHTML = '';
                if(businesses.length > 0){
                    $.each(businesses, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'col-md-6 border-style1';
                        firstDivInnerHTML = '<div class="row" style="border-bottom: 2px solid #D3E0E9;"><div class="col-xs-6 col-2 " ><div class="text-center cust-margin">';
                        var urlStr = "{{url('business')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.logo;
                        var defaultImgStr = "{{ asset('images/business_logo.jpeg')}}";
                        firstDivInnerHTML += '<a href="'+urlStr+'" >';
                        if(obj.logo){
                            firstDivInnerHTML += '<img src="'+imgStr+'" class="border-style image" alt="business image">';
                        } else {
                            firstDivInnerHTML += '<img src="'+defaultImgStr+'" class="border-style image" alt="business image">';
                        }
                        firstDivInnerHTML += '</a></div></div>';
                        firstDivInnerHTML += '<div class="col-xs-6 text-center col-2 cust-padding"><a href="'+urlStr+'" ><h5><strong>'+obj.name+'</strong></h5>';
                        if('Other' == obj.business_category){
                            firstDivInnerHTML += obj.other_business;
                        } else {
                            firstDivInnerHTML += obj.business_category;
                        }
                        firstDivInnerHTML += '</a></div></div></div>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allBusiness.appendChild(firstDiv);
                    })
                } else {
                    allBusiness.innerHTML = 'No Result';
                }
                $('#business').focus();
            });
        } else if( 0 == business.length) {
            window.location.reload();
        }
    }
    function searchBusiness(business){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var businessCategory = document.getElementById('business_category').value;
        if(business.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-business')}}",
                data:{_token:currentToken,business:business,business_category:businessCategory}
            }).done(function( businesses ) {
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
                        firstDivInnerHTML += '<div class="col-xs-6 text-center col-2 cust-padding"><a href="'+urlStr+'" ><h5><strong>'+obj.name+'</strong></h5>';
                        if('Other' == obj.business_category){
                            firstDivInnerHTML += obj.other_business;
                        } else {
                            firstDivInnerHTML += obj.business_category;
                        }
                        firstDivInnerHTML += '</a></div></div></div>';
                        firstDiv.innerHTML = firstDivInnerHTML;
                        allBusiness.appendChild(firstDiv);
                    })
                } else {
                    allBusiness.innerHTML = 'No Result';
                }
                $('#business').focus();
            });
        } else if( 0 == business.length) {
            window.location.reload();
        }
    }
</script>
@endsection
