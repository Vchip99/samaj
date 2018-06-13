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
            <h4>Add Notification</h4>
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
            @if(empty($notification->id))
                <form class="form-horizontal" method="POST" action="{{ url('create-notification') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            @else
                <form class="form-horizontal" method="POST" action="{{ url('update-notification') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
                <input type="hidden" name="notification_id" value="{{$notification->id}}">
            @endif
                <div class="form-group">
                    <label for="message" class="col-md-3 control-label">Message<sup>*</sup></label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="message" required rows="10">{{ (!empty($notification->id))?$notification->message:old('message') }}</textarea>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="image" class="col-md-3 control-label">Image</label>
                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control" name="image">
                    </div>
                </div>
                @if(!empty($notification->id) && !empty($notification->image))
                    <div class="form-group ">
                        <label for="image" class="col-md-3 control-label">Existing Image</label>
                        <div class="col-md-6">
                        {{ basename($notification->image)}}
                        </div>
                    </div>
                @endif
                <div class="form-group" >
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">@if(!empty($notification->id))Update @else Save @endif</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="min-height: 271px !important"></div>
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
</script>
@endsection
