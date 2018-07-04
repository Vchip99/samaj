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
                                @if(count($subgroups) > 0)
                                    @foreach($subgroups as $subgroup)
                                        <option value="{{$subgroup->id}}">{{$subgroup->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <select class="form-control" name="position" id="position" onChange="checkMember(this);">
                                <option value="0">Select Position</option>
                                @if(count($positions) > 0)
                                    @foreach($positions as $position)
                                        <option value="{{$position->id}}">{{$position->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="margin-bottom: 10px">
                            <input type="text" name="member" id="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this.value);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-default" style="min-height: 542px !important;">
                    @if(count($members) > 0)
                    <div class="panel-body scrollable-panel" id="allMember" style="min-height: 540px !important;">
                        @foreach($members as $member)
                            <div class="member" id="div_member_{{$member->id}}" >
                                <input type="checkbox" name="members[]" id="member_{{$member->id}}" value="{{$member->id}}">{{$member->f_name}} {{$member->m_name}} {{$member->l_name}}
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
@include('layouts.footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#member').focus();
    });
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
        document.getElementById("position").value = 0;
        $('input[type="checkbox"]').prop('checked', '');
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
        document.getElementById("position").value = 0;
        $('input[type="checkbox"]').prop('checked', '');
    }

    function searchMember(member){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        if(member.length > 0){
            $.ajax({
                method:'POST',
                url: "{{url('search-member')}}",
                data:{_token:currentToken,member:member}
            }).done(function( members ) {
                $('div.member').addClass('hide');
                if(members.length > 0){
                    $.each(members, function(idx,obj){
                        $('#div_member_'+obj.id).removeClass('hide');
                    })
                }
            });
        } else if( 0 == member.length) {
            $('div.member').removeClass('hide');
        }
    }
</script>
@endsection
