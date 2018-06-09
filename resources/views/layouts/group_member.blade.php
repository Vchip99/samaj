@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
        .container{
          margin-top: 80px;
        }
        .scrollable-panel{
          max-height: 469px;
          overflow: auto;
        }
        .form-group{

        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    @if(Session::has('message'))
        <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('message') }}
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
    <div style="margin:10px;">
        <form class="form-horizontal" method="POST" action="{{ url('associate-group') }}" enctype="multipart/form-data" id="associateMemberForm">
        {{ csrf_field() }}
            <div class="row" style="border: 1px solid #d3e0e9;">
                <div class="form-group">
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <select class="form-control" name="group" id="group" onChange="selectSubgroup(this);">
                                <option value="">Select Group</option>
                                @if(count($groups) > 0)
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <select class="form-control" name="subgroup" id="subgroup" onChange="selectPosition(this);">
                                <option value="">Select Sub Group</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <select class="form-control" name="position" id="position" onChange="checkMember(this);">
                                <option value="">Select Position</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <input type="text" name="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this.value);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-default">
                    @if(count($members) > 0)
                    <div class="panel-body scrollable-panel" id="allMember">
                        @foreach($members as $member)
                            <div class="">
                                <input type="checkbox" name="members[]" id="member_{{$member->id}}" value="{{$member->id}}">{{$member->f_name}} {{$member->l_name}}
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function checkMember(ele){
        var group = document.getElementById('group').value;
        var subgroup = document.getElementById('subgroup').value;
        var position = parseInt($(ele).val());
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        $('input[type="checkbox"]').prop('checked', '');
        if(group > 0 && subgroup > 0 && position > 0){
            $.ajax({
                method:'POST',
                url: "{{url('get-group-member-by-id')}}",
                data:{_token:currentToken,group:group,subgroup:subgroup,position:position}
            }).done(function( members ) {
                if(members.length > 0){
                    $.each(members, function(idx, id) {
                      $('#member_'+id).prop('checked', 'checked');
                  });
                }
            });
        }
    }

    function associateGroup(){
        var group = document.getElementById('group').value;
        var subgroup = document.getElementById('subgroup').value;
        var position = document.getElementById('position').value;
        if(group > 0 && subgroup > 0 && position > 0){
            document.getElementById('associateMemberForm').submit();
        } else if(!group){
            alert('select group');
        } else if(!subgroup){
            alert('select sub group');
        } else if(!position){
            alert('select position');
        }
        return false;
    }

    function selectPosition(ele){
        var subgroup = parseInt($(ele).val());
        var group = document.getElementById('group').value;
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(group > 0 && subgroup > 0){
            $.ajax({
                method:'POST',
                url: "{{url('get-position-by-group-id-by-sub-group-id')}}",
                data:{_token:currentToken,group_id:group,sub_group_id:subgroup}
            }).done(function( positions ) {
                select = document.getElementById('position');
                select.innerHTML = '';
                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Select Position';
                select.appendChild(opt);
                if( 0 < positions.length){
                  $.each(positions, function(idx, obj) {
                      var opt = document.createElement('option');
                      opt.value = obj.id;
                      opt.innerHTML = obj.name;
                      select.appendChild(opt);
                  });
                }
            });
        } else {
            select = document.getElementById('position');
            select.innerHTML = '';
            var opt = document.createElement('option');
            opt.value = '';
            opt.innerHTML = 'Select Position';
            select.appendChild(opt);
        }
    }

    function selectSubgroup(ele){
        var group = parseInt($(ele).val());
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(group > 0){
            $.ajax({
                method:'POST',
                url: "{{url('get-sub-groups-by-group-id')}}",
                data:{_token:currentToken,group_id:group}
            }).done(function( subgroups ) {
                select = document.getElementById('subgroup');
                select.innerHTML = '';
                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Select Sub Group';
                select.appendChild(opt);
                if( 0 < subgroups.length){
                  $.each(subgroups, function(idx, obj) {
                      var opt = document.createElement('option');
                      opt.value = obj.id;
                      opt.innerHTML = obj.name;
                      select.appendChild(opt);
                  });
                }
            });
        } else {
            select = document.getElementById('subgroup');
                select.innerHTML = '';
                var opt = document.createElement('option');
                opt.value = '';
                opt.innerHTML = 'Select Sub Group';
                select.appendChild(opt);
        }
        select = document.getElementById('position');
        select.innerHTML = '';
        var opt = document.createElement('option');
        opt.value = '';
        opt.innerHTML = 'Select Position';
        select.appendChild(opt);
    }

    function searchMember(member){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(member.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-member')}}",
                data:{_token:currentToken,member:member}
            }).done(function( members ) {
                var allMember = document.getElementById('allMember');
                allMember.innerHTML = '';
                if(members.length > 0){
                    $.each(members, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = '';
                        firstDiv.innerHTML = '<input type="checkbox" name="members[]" id="member_'+obj.id+'" value="'+obj.id+'">'+obj.f_name+''+obj.l_name;
                        allMember.appendChild(firstDiv);
                    })
                } else {
                    allMember.innerHTML = 'No Result';
                }
            });
        } else if( 0 == member.length) {
            window.location.reload();
        }
    }
</script>
@endsection
