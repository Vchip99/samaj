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
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
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
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 55px;">
                    <a href="{{ url('search-business')}}" class="btn btn-primary" style="float: right;margin-left: 5px;margin-top: -2px;">Back </a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" >
                        <div class="form-group ">
                            <label for="" class="col-md-3 control-label">Business Category <sup>*</sup></label>
                            <div class="col-md-6">
                                <select class="form-control" name="business_category" required onChange="toggleSubCategory(this);" disabled>
                                    <option value="">Select Business Category</option>
                                    @if(count($businessCategories) > 0)
                                        @foreach($businessCategories as $businessCategory)
                                            <option value="{{$businessCategory->id}}" data-have_sub_category="{{$businessCategory->have_sub_category}}" @if(!empty($business->id) && $business->business_category_id == $businessCategory->id) selected @endif>{{$businessCategory->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if(!empty($business->id) && $business->business_sub_category_id > 0)
                            <div class="form-group" id="subCategoryDiv">
                        @else
                            <div class="form-group hide" id="subCategoryDiv">
                        @endif
                            <label for="" class="col-md-3 control-label">Business Sub Category</label>
                            <div class="col-md-6">
                                <select class="form-control" name="business_sub_category" id="subCategoryList" disabled>
                                    <option value="">Select Business Sub Category</option>
                                    @if(count($subCategories) > 0)
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{$subCategory->id}}" @if($business->business_sub_category_id == $subCategory->id) selected @endif>{{$subCategory->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ (!empty($business->id))?$business->name:old('name') }}"  placeholder="business name" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-3 control-label">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ (!empty($business->id))?$business->phone:old('phone') }}" placeholder="10 digit mobile number" pattern="[0-9]{10}" readonly>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="photo" class="col-md-3 control-label">Logo</label>
                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control" name="logo" disabled>
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
                                <textarea class="form-control" name="address" readonly>{{ (!empty($business->id))?$business->address:old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" readonly>{{ (!empty($business->id))?$business->description:old('description') }}</textarea>
                            </div>
                        </div>
                        <div id="moreDiv" class="">
                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">E-mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ (!empty($business->id))?$business->email:old('email') }}" placeholder="email" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website" class="col-md-3 control-label">Web-site</label>
                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control" name="website" value="{{ (!empty($business->id))?$business->website:old('website') }}" placeholder="webiste url" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="google_location" class="col-md-3 control-label">Google Location</label>
                                <div class="col-md-6">
                                    <input id="google_location" type="text" class="form-control" name="google_location" value="{{ (!empty($business->id))?$business->google_location:old('google_location') }}" placeholder="Google Location" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="business" class="col-md-3 control-label">Facebook Profile Url</label>
                            <div class="col-md-6">
                                <input id="business" type="text" class="form-control" name="business" value="{{ (!empty($business->id))?$business->facebook:old('facebook') }}" placeholder="facebook profile url" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="linkedin" class="col-md-3 control-label">Linkedin Profile Url</label>
                            <div class="col-md-6">
                                <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ (!empty($business->id))?$business->linkedin:old('linkedin') }}" placeholder="linkedin profile url" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="google" class="col-md-3 control-label">Google Plus Profile Url</label>
                            <div class="col-md-6">
                                <input id="google" type="text" class="form-control" name="google" value="{{ (!empty($business->id))?$business->google:old('google') }}" placeholder="google plus profile url" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="youtube" class="col-md-3 control-label">Youtube Profile Url</label>
                            <div class="col-md-6">
                                <input id="youtube" type="text" class="form-control" name="youtube" value="{{ (!empty($business->id))?$business->youtube:old('youtube') }}" placeholder="linkedin profile url" readonly>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
