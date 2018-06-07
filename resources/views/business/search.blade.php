@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .search-label{
          margin-left: 10%;
          margin-top: 17%;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 55px;">
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
                        <input type="text" name="business" class="form-control"  placeholder="search business" onfocus onkeyup="searchBusiness(this.value);" >
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($businesses) > 0)
                    <div class="row">
                        <div class="panel-heading">All Business</div>
                        <div id="allBusiness">
                        @foreach($businesses as $business)
                        <div class="col-md-6">
                            <div class="col-md-3">
                                @if(!empty($business->logo))
                                    <a href="{{url('business')}}/{{$business->id}}" ><img src="{{ asset($business->logo)}}" class="user-logo"></a>
                                @else
                                    <a href="{{url('business')}}/{{$business->id}}" ><img src="{{ asset('images/business_logo.jpeg')}}" class="user-logo"></a>
                                @endif
                            </div>
                          <label class="col-md-3 control-label search-label"> <a href="{{url('business')}}/{{$business->id}}" >{{$business->name}}</a></label>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @else
                        No Business List
                    @endif
                </div>
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
                        firstDiv.className = 'col-md-6';
                        firstDivInnerHTML = '<div class="col-md-3">';
                        var urlStr = "{{url('business')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.logo;
                        var defaultImgStr = "{{ asset('images/business_logo.jpeg')}}";
                        if(obj.logo){
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+imgStr+'" class="user-logo"></a></div>';
                        } else {
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+defaultImgStr+'" class="user-logo"></a></div>';
                        }
                        firstDivInnerHTML += '<label class="col-md-3 control-label search-label"> <a href="'+urlStr+'" >'+obj.name+'</a></label>';
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
