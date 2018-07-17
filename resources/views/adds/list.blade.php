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
                            <a id="addCategory" href="{{url('create-ad')}}" type="button" class="btn btn-primary" style="float: right;" title="Create Ad">Create Ad</a>&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered" border="1">
                            <thead class="">
                              <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody id="tbody">
                            @if(count($adds) > 0)
                                @foreach($adds as $index => $add)
                                  <tr>
                                    <th>{{$index + 1}}</th>
                                    <td>{{ basename($add->photo)}}</td>
                                    <td>{{$add->start_date}}</td>
                                    <td>{{$add->end_date}}</td>
                                    <td>
                                        <a href="{{url('ad')}}/{{$add->id}}/edit" ><img src="{{asset('images/edit1.png')}}" width='30' height='30'/>
                                        </a>
                                    </td>
                                    <td>
                                    <a id="{{$add->id}}" onclick="confirmDelete(this);"><img src="{{asset('images/delete2.png')}}" width='30' height='30' title="Delete" />
                                          </a>
                                          <form id="deleteAdd_{{$add->id}}" action="{{url('delete-ad')}}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                              <input type="hidden" name="add_id" value="{{$add->id}}">
                                          </form>
                                    </td>
                                  </tr>
                                @endforeach
                              @else
                                <tr><td colspan="6">No Ads</td></tr>
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
        var message = 'Are You sure, you want to delete this ad?';
        if(confirm(message)){
            var id = $(ele).attr('id');
            formId = 'deleteAdd_'+id;
            document.getElementById(formId).submit();
        }
        return false;
    }

</script>
@endsection
