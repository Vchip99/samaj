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
                <div class="panel-body">
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
                                <select class="form-control" name="business_category" required onChange="toggleSubCategory(this);">
                                    <option value="">Select Business Category</option>
                                    @if(count($businessCategories) > 0)
                                        @foreach($businessCategories as $businessCategory)
                                            <option value="{{$businessCategory->id}}" data-have_sub_category="{{$businessCategory->have_sub_category}}" @if(!empty($business->id) && $business->business_category_id == $businessCategory->id) selected @endif>{{$businessCategory->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('business_category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('business_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if(!empty($business->id) && $business->business_sub_category_id > 0)
                            <div class="form-group" id="subCategoryDiv">
                        @else
                            <div class="form-group hide" id="subCategoryDiv">
                        @endif
                            <label for="" class="col-md-3 control-label">Business Sub Category</label>
                            <div class="col-md-6">
                                <select class="form-control" name="business_sub_category" id="subCategoryList">
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
                            <div class="form-group">
                                <label for="google_location" class="col-md-3 control-label">Google Location</label>
                                <div class="col-md-6">
                                    <input id="google_location" type="text" class="form-control" name="google_location" value="{{ (!empty($business->id))?$business->google_location:old('google_location') }}" placeholder="Google Location">
                                </div>
                            </div>
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
                                <button type="submit" class="btn btn-primary">@if(!empty($business->id))Update @else Save @endif</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
</script>
@endsection
