@extends('layouts.app')

@section('content')
<div class="container top-margin">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group row">
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
                        <div id="addCategoryDiv">
                            <a href="{{url('create-notification')}}" type="button" class="btn btn-primary" style="float: right;" title="Create Notification">Create Notification</a>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered" border="1">
                            <thead class="">
                              <tr>
                                <th>#</th>
                                <th>Message</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody >
                            @if(count($notifications) > 0)
                                @foreach($notifications as $index => $notification)
                                  <tr>
                                    <th>{{$index + 1}}</th>
                                    <td>{{substr($notification->message, 0,300)}}...</td>
                                    <td>
                                        <a href="{{url('notification')}}/{{$notification->id}}/edit" ><img src="{{asset('images/edit1.png')}}" width='30' height='30'/>
                                        </a>
                                    </td>
                                    <td>
                                    <a id="{{$notification->id}}" onclick="confirmDelete(this);"><img src="{{asset('images/delete2.png')}}" width='30' height='30' title="Delete" />
                                          </a>
                                          <form id="deleteNotification_{{$notification->id}}" action="{{url('delete-notification')}}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                              <input type="hidden" name="notification_id" value="{{$notification->id}}">
                                          </form>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr><td colspan="4">No Notification</td></tr>
                              @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function confirmDelete(ele){
        var message = 'Are You sure, you want to delete this notification?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteNotification_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection
