@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
        .notification-image {
            padding: 10px;
            width: 150px;
            height: 150px;
        }
    </style>
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
            padding-top:20px;
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
<div class="container top-margin">
    <div class="row" style="min-height: 702px !important;">
        <div class="col-md-10 col-md-offset-1">
            <div class="">
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
                @if(count($suggestions) > 0)
                <div class="row">
                    <div id="allContact" style="border: 2px solid grey;">
                        @foreach($suggestions as $suggestion)
                        <div class="row memberinfo">
                            <p><strong>Name: </strong>{{$suggestion->f_name}} {{$suggestion->l_name}}
                                <div style="float: right; margin-left: 5px;"><a class="btn btn-primary" id="{{$suggestion->id}}" onclick="confirmDelete(this);">Delete</a>
                                    <form id="deleteSuggestion_{{$suggestion->id}}" action="{{url('delete-suggestion')}}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="suggestion_id" value="{{$suggestion->id}}">
                                    </form>
                                </div>
                            </p>
                            <p><strong>Phone: </strong>{{$suggestion->mobile}}</p>
                            <p><strong>Suggestion: </strong>{{$suggestion->description}}</p>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
                @else
                    No suggestions
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    function confirmDelete(ele){
        var message = 'Are You sure, you want to delete this Suggestion?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteSuggestion_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection