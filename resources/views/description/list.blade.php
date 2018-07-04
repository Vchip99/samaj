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
                        <!-- <div id="addCategoryDiv">
                            <a id="addCategory" href="{{url('create-description')}}" type="button" class="btn btn-primary" style="float: right;" title="Add Business">Add Group Description</a>&nbsp;&nbsp;
                        </div> -->
                    </div>
                    <div class="row">
                        <table class="table table-bordered" border="1">
                            <thead class="">
                              <tr>
                                <th>#</th>
                                <th>Group Name</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody id="tbody">
                            @if(count($descriptions) > 0)
                                @foreach($descriptions as $index => $description)
                                  <tr>
                                    <th>{{$index + 1}}</th>
                                    <td>{{$description->group->name}}</td>
                                    <td>
                                        <a href="{{url('description')}}/{{$description->id}}/edit" ><img src="{{asset('images/edit1.png')}}" width='30' height='30'/>
                                        </a>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr><td colspan="4">No Group Description</td></tr>
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
        var message = 'Are You sure, you want to delete this business?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteBusiness_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection
