@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Change Admin</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
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
                    <form class="form-horizontal" method="POST" action="{{ url('change-admin') }}">
                        {{ csrf_field() }}
                    <div class="row">
                        <label for="occupation" class="col-md-12 control-label">Relation with Admin</label>
                    </div>
                    @if(count($members) > 0)
                        @foreach($members as $member)
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="occupation" class="col-md-2 control-label">{{$member->f_name}}</label>
                                <div class="col-md-3">
                                    <select class="form-control" name="{{$member->id}}" required="">
                                        <option value="">Select Relation</option>
                                        <option value="Admin" @if('Admin' == $member->admin_relation)selected="true" @endif>Admin</option>
                                        <option value="Father" @if('Father' == $member->admin_relation)selected="true" @endif>Father</option>
                                        <option value="Mother" @if('Mother' == $member->admin_relation)selected="true" @endif>Mother</option>
                                        <option value="Brother" @if('Brother' == $member->admin_relation)selected="true" @endif>Brother</option>
                                        <option value="Sister" @if('Sister' == $member->admin_relation)selected="true" @endif>Sister</option>
                                        <option value="Wife" @if('Wife' == $member->admin_relation)selected="true" @endif>Wife</option>
                                        <option value="Son" @if('Son' == $member->admin_relation)selected="true" @endif>Son</option>
                                        <option value="Daughter" @if('Daughter' == $member->admin_relation)selected="true" @endif>Daughter</option>
                                        <option value="GrandFather" @if('GrandFather' == $member->admin_relation)selected="true" @endif>GrandFather</option>
                                        <option value="GrandMother" @if('GrandMother' == $member->admin_relation)selected="true" @endif>GrandMother</option>
                                        <option value="GrandSon" @if('GrandSon' == $member->admin_relation)selected="true" @endif>GrandSon</option>
                                        <option value="GrandDaughter" @if('GrandDaughter' == $member->admin_relation)selected="true" @endif>GrandDaughter</option>
                                        <option value="Uncle" @if('Uncle' == $member->admin_relation)selected="true" @endif>Uncle</option>
                                        <option value="Aunt" @if('Aunt' == $member->admin_relation)selected="true" @endif>Aunt</option>
                                        <option value="Cousin" @if('Cousin' == $member->admin_relation)selected="true" @endif>Cousin</option>
                                        <option value="Nephew" @if('Nephew' == $member->admin_relation)selected="true" @endif>Nephew</option>
                                        <option value="Niece" @if('Niece' == $member->admin_relation)selected="true" @endif>Niece</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <div>
                        <button type="submit" class="btn btn-primary">Change Admin</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
