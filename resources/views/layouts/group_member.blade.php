@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        .member-label{
          margin-left: 5%;
          margin-top: 10%;
          padding: 0px;
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
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
                <form class="form-horizontal" method="POST" action="{{ url('associate-group') }}" enctype="multipart/form-data" id="associateMemberForm">
                {{ csrf_field() }}
                <div class="panel-heading " style="height: 55px;">
                    <div class="col-md-3">
                        <select class="form-control" name="group" id="group" onChange="selectSubgroup(this);">
                            <option value="">Select Group</option>
                            @if(count($groups) > 0)
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="subgroup" id="subgroup" onChange="selectPosition(this);">
                            <option value="">Select Sub Group</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="position" id="position">
                            <option value="">Select Position</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="member" class="form-control"  placeholder="search member" onkeyup="searchMember(this.value);">
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($members) > 0)
                    <div class="row">
                        <div class="panel-heading">All Members</div>
                        <div id="allMember">

                            @foreach($members as $member)
                                <div class="">
                                    <label><input type="checkbox" name="members[]" value="{{$member->id}}">{{$member->f_name}} {{$member->l_name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <button style="float: right;" onclick="associateGroup();">Submit</button>
                    </div>
                    @else
                        No Member
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function associateGroup(){
        // alert('hi');
        var group = document.getElementById('group').value;
        console.log(group);
        var subgroup = document.getElementById('subgroup').value;
        console.log(subgroup);
        var position = document.getElementById('position').value;
        console.log(position);
        if(group > 0 && subgroup > 0 && position > 0){
            document.getElementById('associateMemberForm').submit();
        } else if(!group){
            alert('select group');
        } else if(!subgroup){
            alert('select sub group');
        } else if(!position){
            alert('select position');
        }
        return;
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
        var profession = document.getElementById('profession').value;
        if(member.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-member')}}",
                data:{_token:currentToken,member:member,profession:profession}
            }).done(function( members ) {
                var allMember = document.getElementById('allMember');
                allMember.innerHTML = '';
                if(members.length > 0){
                    $.each(members, function(idx,obj){
                        var firstDiv = document.createElement('div');
                        firstDiv.className = 'col-md-6';
                        firstDivInnerHTML = '<div class="col-md-3">';
                        var urlStr = "{{url('member')}}/"+obj.id;
                        var imgStr = "{{ asset('')}}"+obj.photo;
                        var defaultImgStr = "{{ asset('images/user.png')}}";
                        if(obj.photo){
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+imgStr+'" class="user-photo"></a></div>';
                        } else {
                            firstDivInnerHTML += '<a href="'+urlStr+'" ><img src="'+defaultImgStr+'" class="user-photo"></a></div>';
                        }
                        if(obj.f_name){
                          var firstName = obj.f_name;
                        } else {
                          var firstName = '';
                        }
                        if(obj.l_name){
                          var lastName = obj.l_name;
                        } else {
                          var lastName = '';
                        }
                        firstDivInnerHTML += '<label class="col-md-3 control-label member-label"> <a href="'+urlStr+'" >'+firstName+' '+lastName+'</a></label>';
                        firstDiv.innerHTML = firstDivInnerHTML;
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
