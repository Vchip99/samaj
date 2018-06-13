@extends('layouts.app')

@section('content')
<div class="container top-margin">
    <div class="row" style="min-height: 700px !important;">
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
                            <a href="{{url('create-contact')}}" type="button" class="btn btn-primary" style="float: right;" title="Create Contact">Create Contact</a>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered" border="1">
                            <thead class="">
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody >
                            @if(count($contacts) > 0)
                                @foreach($contacts as $index => $contact)
                                  <tr>
                                    <th>{{$index + 1}}</th>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->phone}}</td>
                                    <td>
                                        <a href="{{url('contact')}}/{{$contact->id}}/edit" ><img src="{{asset('images/edit1.png')}}" width='30' height='30'/>
                                        </a>
                                    </td>
                                    <td>
                                    <a id="{{$contact->id}}" onclick="confirmDelete(this);"><img src="{{asset('images/delete2.png')}}" width='30' height='30' title="Delete" />
                                          </a>
                                          <form id="deleteContact_{{$contact->id}}" action="{{url('delete-contact')}}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                              <input type="hidden" name="contact_id" value="{{$contact->id}}">
                                          </form>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr><td colspan="5">No Contact</td></tr>
                              @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">

    function confirmDelete(ele){
        var message = 'Are You sure, you want to delete this contact?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteContact_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection
