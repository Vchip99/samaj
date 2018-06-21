@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        #allMember{
            padding: 10px 10px;
        }
    </style>
@endsection
@section('content')
<div class="container top-margin">
    <div class="row" style="min-height: 722px !important;">
        <div class="">
            @if(Session::has('message'))
                <div class="alert alert-success" id="message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    @if(count($jobs) > 0)
                    <div class="row">
                        <div id="allMember">
                        @foreach($jobs as $job)
                        <div class="container row">
                            @if(1 == Auth::user()->is_super_admin)
                            <div style="float: right; margin-left: 5px;"><a class="btn btn-primary" id="{{$job->id}}" onclick="confirmDelete(this);">Delete</a>
                                <form id="deleteJob_{{$job->id}}" action="{{url('delete-job')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="job_id" value="{{$job->id}}">
                                </form>
                            </div>
                            <a class="btn btn-default" style="float: right;" href="{{url('job')}}/{{$job->id}}/edit" >Edit</a>
                            @endif
                            <div class="">
                                <label for="title">Title:</label> {{$job->title}}
                            </div>
                        </div>
                        <div class=" container row">
                            <div class="">
                                <label for="title">Description:</label> {{$job->description}}
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                    @else
                        No Jobs
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">

    function confirmDelete(ele){
        var message = 'Are You sure, you want to delete this job?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteJob_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection
