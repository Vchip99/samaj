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
        .container{
          margin-top: 80px;
        }
        #r1{
          box-sizing: border-box;
          padding: 10px 15px;
          color: blue;
          border: 1px solid #d3e0e9;
          background-color: #fff;
          border-top-left-radius: 4px;
          border-top-right-radius: 4px;
        }
        #r2{
          border: 1px solid #d3e0e9;
        }
        .button{
            float:right;
        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    <div style="margin:10px;">
        <div class="row" id="r1">
            <h4>Add Business</h4>
        </div>
        <div class="row" id="r2">
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
            @if(empty($business->id))
                <form class="form-horizontal" method="POST" action="{{ url('create-business') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            @else
                <form class="form-horizontal" method="POST" action="{{ url('update-business') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <input type="hidden" name="business_id" value="{{$business->id}}">
            @endif
                <div class="form-group ">
                    <label for="" class="col-md-3 control-label">Business Category <sup>*</sup></label>
                    <div class="col-md-6">
                        <select class="form-control" name="business_category" required onChange="toggleOtherBusiness(this);">
                            <option value="">Select Business Category</option>
                            <optgroup label="Accountant">
                                <option value="Accountant" @if(!empty($business->id) && "Accountant" == $business->business_category ) selected @endif>Accountant</option>
                            </optgroup>
                            <optgroup label="Advocate">
                                <option value="Advocate" @if(!empty($business->id) && "Advocate" == $business->business_category ) selected @endif>Advocate</option>
                            </optgroup>
                            <optgroup label="Architect">
                                <option value="Architect" @if(!empty($business->id) && "Architect" == $business->business_category ) selected @endif>Architect</option>
                            </optgroup>
                            <optgroup label="Bichayat/Decoration">
                                <option value="Bichayat/Decoration" @if(!empty($business->id) && "Bichayat/Decoration" == $business->business_category ) selected @endif>Bichayat/Decoration</option>
                            </optgroup>
                            <optgroup label="Broker">
                                <option value="Cotton(Broker)" @if(!empty($business->id) && "Cotton(Broker)" == $business->business_category ) selected @endif>Cotton(Broker)</option>
                                <option value="Finance(Broker)" @if(!empty($business->id) && "Finance(Broker)" == $business->business_category ) selected @endif>Finance(Broker)</option>
                                <option value="Grain(Broker)" @if(!empty($business->id) && "Grain(Broker)" == $business->business_category ) selected @endif>Grain(Broker)</option>
                                <option value="LIC Agent" @if(!empty($business->id) && "LIC Agent" == $business->business_category ) selected @endif>LIC Agent</option>
                                <option value="Property(Broker)" @if(!empty($business->id) && "Property(Broker)" == $business->business_category ) selected @endif>Property(Broker)</option>
                                <option value="Share(Broker)" @if(!empty($business->id) && "Share(Broker)" == $business->business_category ) selected @endif>Share(Broker)</option>
                            </optgroup>
                            <optgroup label="Builder & Land developer">
                                <option value="Builder & Land developer" @if(!empty($business->id) && "Builder & Land developer" == $business->business_category ) selected @endif>Builder & Land developer</option>
                            </optgroup>
                            <optgroup label="CA">
                                <option value="CA" @if(!empty($business->id) && "CA" == $business->business_category ) selected @endif>CA</option>
                            </optgroup>
                            <optgroup label="Catering">
                                <option value="Catering" @if(!empty($business->id) && "Catering" == $business->business_category ) selected @endif>Catering</option>
                            </optgroup>
                            <optgroup label="Cloth Store">
                                <option value="Cloth Store" @if(!empty($business->id) && "Cloth Store" == $business->business_category ) selected @endif>Cloth Store</option>
                            </optgroup>
                            <optgroup label="Coaching Classes">
                                <option value="Coaching Classes" @if(!empty($business->id) && "Coaching Classes" == $business->business_category ) selected @endif>Coaching Classes</option>
                            </optgroup>
                            <optgroup label="Designer Graphics and Other">
                                <option value="Designer Graphics and Other" @if(!empty($business->id) && "Designer Graphics and Other" == $business->business_category ) selected @endif>Designer Graphics and Other</option>
                            </optgroup>
                            <optgroup label="Dealer">
                                <option value="Bike/Car(Dealer)" @if(!empty($business->id) && "Bike/Car(Dealer)" == $business->business_category ) selected @endif>Bike/Car(Dealer)</option>
                                <option value="Laptop(Dealer)" @if(!empty($business->id) && "Laptop(Dealer)" == $business->business_category ) selected @endif>Laptop(Dealer)</option>
                                <option value="Mobile(Dealer)" @if(!empty($business->id) && "Mobile(Dealer)" == $business->business_category ) selected @endif>Mobile(Dealer)</option>
                                <option value="TV/Refrigerator(Dealer)" @if(!empty($business->id) && "TV/Refrigerator(Dealer)" == $business->business_category ) selected @endif>TV/Refrigerator(Dealer)</option>
                            </optgroup>
                            <optgroup label="Doctor">
                                <option value="Doctor" @if(!empty($business->id) && "Doctor" == $business->business_category ) selected @endif>Doctor</option>
                            </optgroup>
                            <optgroup label="Electrical">
                                <option value="Electrical" @if(!empty($business->id) && "Electrical" == $business->business_category ) selected @endif>Electrical</option>
                            </optgroup>
                            <optgroup label="Event Management">
                                <option value="Event Management" @if(!empty($business->id) && "Event Management" == $business->business_category ) selected @endif>Event Management</option>
                            </optgroup>
                            <optgroup label="General Store">
                                <option value="General Store" @if(!empty($business->id) && "General Store" == $business->business_category ) selected @endif>General Store</option>
                            </optgroup>
                            <optgroup label="Grain Merchant">
                                <option value="Grain Merchant" @if(!empty($business->id) && "Grain Merchant" == $business->business_category ) selected @endif>Grain Merchant</option>
                            </optgroup>
                            <optgroup label="Hardware">
                                <option value="Hardware" @if(!empty($business->id) && "Hardware" == $business->business_category ) selected @endif>Hardware</option>
                            </optgroup>
                            <optgroup label="Industry">
                                <option value="Industry" @if(!empty($business->id) && "Industry" == $business->business_category ) selected @endif>Industry</option>
                            </optgroup>
                            <optgroup label="Kirana">
                                <option value="Kirana" @if(!empty($business->id) && "Kirana" == $business->business_category ) selected @endif>Kirana</option>
                            </optgroup>
                            <optgroup label="Medical">
                                <option value="Medical" @if(!empty($business->id) && "Medical" == $business->business_category ) selected @endif>Medical</option>
                            </optgroup>
                            <optgroup label="Politician">
                                <option value="Politician" @if(!empty($business->id) && "Politician" == $business->business_category ) selected @endif>Politician</option>
                            </optgroup>
                            <optgroup label="Printing & Designing">
                                <option value="Printing & Designing" @if(!empty($business->id) && "Printing & Designing" == $business->business_category ) selected @endif>Printing & Designing</option>
                            </optgroup>
                            <optgroup label="Related to Software Services">
                                <option value="Related to Software Services" @if(!empty($business->id) && "Related to Software Services" == $business->business_category ) selected @endif>Related to Software Services</option>
                            </optgroup>
                            <optgroup label="Restaurant">
                                <option value="Restaurant" @if(!empty($business->id) && "Restaurant" == $business->business_category ) selected @endif>Restaurant</option>
                            </optgroup>
                            <optgroup label="Sonaar (Work in Gold & Silver)">
                                <option value="Sonaar (Work in Gold & Silver)" @if(!empty($business->id) && "Sonaar (Work in Gold & Silver)" == $business->business_category ) selected @endif>Sonaar (Work in Gold & Silver)</option>
                            </optgroup>
                            <optgroup label="Sweet Mart">
                                <option value="Sweet Mart" @if(!empty($business->id) && "Sweet Mart" == $business->business_category ) selected @endif>Sweet Mart</option>
                            </optgroup>
                            <optgroup label="Trainer">
                                <option value="Trainer" @if(!empty($business->id) && "Trainer" == $business->business_category ) selected @endif>Trainer</option>
                            </optgroup>
                            <optgroup label="Transport">
                                <option value="Transport" @if(!empty($business->id) && "Transport" == $business->business_category ) selected @endif>Transport</option>
                            </optgroup>
                            <optgroup label="Travel Agent">
                                <option value="Travel Agent" @if(!empty($business->id) && "Travel Agent" == $business->business_category ) selected @endif>Travel Agent</option>
                            </optgroup>
                            <optgroup label="Water Can">
                                <option value="Water Can" @if(!empty($business->id) && "Water Can" == $business->business_category ) selected @endif>Water Can</option>
                            </optgroup>
                            <optgroup label="Wholesale Dealer">
                                <option value="Wholesale Dealer" @if(!empty($business->id) && "Wholesale Dealer" == $business->business_category ) selected @endif>Wholesale Dealer</option>
                            </optgroup>
                            <optgroup label="Other">
                                <option value="Other" @if(!empty($business->id) && "Other" == $business->business_category ) selected @endif>Other</option>
                            </optgroup>
                        </select>
                        @if ($errors->has('business_category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business_category') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if(!empty($business->id) && 'Other' == $business->business_category)
                    <div class="form-group"  id="otherBusiness">
                        <label for="name" class="col-md-3 control-label">Other Business <sup>*</sup></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="other_business" value="{{ (!empty($business->id))?$business->other_business:old('other_business') }}"  placeholder="business name" >
                            @if ($errors->has('other_business'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('other_business') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="form-group hide"  id="otherBusiness">
                        <label for="name" class="col-md-3 control-label">Other Business <sup>*</sup></label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="other_business" value="{{ (!empty($business->id))?$business->other_business:old('other_business') }}"  placeholder="business name" >
                            @if ($errors->has('other_business'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('other_business') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Name <sup>*</sup></label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ (!empty($business->id))?$business->name:old('name') }}"  placeholder="business name" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-md-3 control-label">Phone</label>
                    <div class="col-md-6">
                        <input id="phone" type="phone" class="form-control" name="phone" value="{{ (!empty($business->id))?$business->phone:old('phone') }}" placeholder="10 digit mobile number" pattern="[0-9]{10}" >
                    </div>
                </div>
                <div class="form-group ">
                    <label for="photo" class="col-md-3 control-label">Logo</label>
                    <div class="col-md-6">
                        <input id="logo" type="file" class="form-control" name="logo">
                    </div>
                </div>
                @if(!empty($business->id) && !empty($business->logo))
                    <div class="form-group ">
                        <label for="logo" class="col-md-3 control-label">Existing Logo</label>
                        <div class="col-md-6">
                        {{ basename($business->logo)}}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="address" class="col-md-3 control-label">Address</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="address">{{ (!empty($business->id))?$business->address:old('address') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-3 control-label">Description</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="description">{{ (!empty($business->id))?$business->description:old('description') }}</textarea>
                    </div>
                </div>
                @if(!empty($business->id))
                    <div id="moreDiv" class="">
                @else
                    <div id="moreDiv" class="hide">
                @endif
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">E-mail</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ (!empty($business->id))?$business->email:old('email') }}" placeholder="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-md-3 control-label">Web-site</label>
                        <div class="col-md-6">
                            <input id="website" type="text" class="form-control" name="website" value="{{ (!empty($business->id))?$business->website:old('website') }}" placeholder="webiste url">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="google_location" class="col-md-3 control-label">Google Location</label>
                        <div class="col-md-6">
                            <input id="google_location" type="text" class="form-control" name="google_location" value="{{ (!empty($business->id))?$business->google_location:old('google_location') }}" placeholder="Google Location">
                        </div>
                    </div> -->
                </div>
                @if(empty($business->id))
                <div class="col-md-9">
                    <a style="float: right;cursor: pointer;" onClick="toggleShowMore(this);"> Show More ...</a>
                </div>
                @endif
                <!-- <div class="form-group">
                    <label for="business" class="col-md-3 control-label">Facebook Profile Url</label>
                    <div class="col-md-6">
                        <input id="business" type="text" class="form-control" name="business" value="{{ (!empty($business->id))?$business->facebook:old('facebook') }}" placeholder="facebook profile url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="linkedin" class="col-md-3 control-label">Linkedin Profile Url</label>
                    <div class="col-md-6">
                        <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ (!empty($business->id))?$business->linkedin:old('linkedin') }}" placeholder="linkedin profile url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="google" class="col-md-3 control-label">Google Plus Profile Url</label>
                    <div class="col-md-6">
                        <input id="google" type="text" class="form-control" name="google" value="{{ (!empty($business->id))?$business->google:old('google') }}" placeholder="google plus profile url" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="youtube" class="col-md-3 control-label">Youtube Profile Url</label>
                    <div class="col-md-6">
                        <input id="youtube" type="text" class="form-control" name="youtube" value="{{ (!empty($business->id))?$business->youtube:old('youtube') }}" placeholder="linkedin profile url">
                    </div>
                </div> -->
                <div class="form-group" >
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">@if(!empty($business->id))Update Business @else Add Business @endif</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="min-height: 195px !important"></div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    function toggleSubCategory(ele){
        var categoryId = $(ele).val();
        var isSubCategory =  $(ele).find(':selected').data('have_sub_category');
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(1 == isSubCategory && categoryId > 0){
            document.getElementById('subCategoryDiv').classList.remove('hide');
            $.ajax({
                  method: "POST",
                  url: "{{url('get-sub-category-by-category-id')}}",
                  data: {_token:currentToken,category_id:categoryId}
            })
            .done(function( msg ) {
                select = document.getElementById('subCategoryList');
                select.innerHTML = '';
                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Select Business Sub Category';
                select.appendChild(opt);
                if( 0 < msg.length){
                  $.each(msg, function(idx, obj) {
                      var opt = document.createElement('option');
                      opt.value = obj.id;
                      opt.innerHTML = obj.name;
                      select.appendChild(opt);
                  });
                }
            });
        } else {
            document.getElementById('subCategoryDiv').classList.add('hide');
        }
    }

    function toggleShowMore(ele){
        if($('#moreDiv').hasClass('hide')){
            $('#moreDiv').removeClass('hide');
            $(ele).text('Hide More ...');
        } else {
            $('#moreDiv').addClass('hide');
            $(ele).text('Show More ...');
        }
    }

    function toggleOtherBusiness(ele){
        if('Other' == $(ele).val()){
            document.getElementById('otherBusiness').classList.remove('hide');
        } else {
            document.getElementById('otherBusiness').classList.add('hide');
        }
    }
</script>
@endsection
