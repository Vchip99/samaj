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
                <div class="panel-heading "style="height: 55px;">
                    <div class="col-md-3">
                        <select class="form-control" name="gotra" id="gotra">
                              <option value="">Select Gotra</option>
                              <option value="All">All</option>
                              <option value="Achitrans"> Achitrans   </option>
                              <option value="Amrans"> Amrans  </option>
                              <option value="Attalans"> Attalans    </option>
                              <option value="Balans"> Balans  </option>
                              <option value="Balansh"> Balansh </option>
                              <option value="Bhansali"> Bhansali    </option>
                              <option value="Bhattayans"> Bhattayans  </option>
                              <option value="Bhatyas" > Bhatyas </option>
                              <option value="Bugdalimb"> Bugdalimb   </option>
                              <option value="Chandrans"> Chandrans   </option>
                              <option value="Chandras"> Chandras    </option>
                              <option value="Chudans"> Chudans </option>
                              <option value="Dhanans"> Dhanans </option>
                              <option value="Dhumrans"> Dhumrans    </option>
                              <option value="Fafdans"> Fafdans </option>
                              <option value="Gajans"> Gajans  </option>
                              <option value="Gataumasya"> Gataumasya  </option>
                              <option value="Gaurans"> Gaurans </option>
                              <option value="Gawans"> Gawans  </option>
                              <option value="Gowans"> Gowans  </option>
                              <option value="Haridrans"> Haridrans   </option>
                              <option value="Jaislani"> Jaislani    </option>
                              <option value="Jhumrans"> Jhumrans    </option>
                              <option value="Kagans"> Kagans  </option>
                              <option value="Kagayans"> Kagayans    </option>
                              <option value="Kamlas"> Kamlas  </option>
                              <option value="Kapilans"> Kapilans    </option>
                              <option value="Kapilansh"> Kapilansh   </option>
                              <option value="Karwans"> Karwans </option>
                              <option value="Kaschyap"> Kaschyap    </option>
                              <option value="Kaushik"> Kaushik </option>
                              <option value="Khalans"> Khalans </option>
                              <option value="Khalansi"> Khalansi    </option>
                              <option value="Liyans"> Liyans  </option>
                              <option value="Loras"> Loras   </option>
                              <option value="Manans"> Manans  </option>
                              <option value="Manmans"> Manmans </option>
                              <option value="Mugans"> Mugans  </option>
                              <option value="Musayas"> Musayas </option>
                              <option value="Nanans"> Nanans  </option>
                              <option value="Nanased"> Nanased </option>
                              <option value="Nandans"> Nandans </option>
                              <option value="Panchans"> Panchans    </option>
                              <option value="Paras"> Paras   </option>
                              <option value="Peeplan"> Peeplan </option>
                              <option value="Rajhans"> Rajhans </option>
                              <option value="Saadans"> Saadans </option>
                              <option value="Saboo"> Saboo   </option>
                              <option value="Sandans"> Sandans </option>
                              <option value="Sandhans"> Sandhans    </option>
                              <option value="Sasans"> Sasans  </option>
                              <option value="Seelans"> Seelans </option>
                              <option value="Sesans"> Sesans  </option>
                              <option value="Silansh"> Silansh </option>
                              <option value="Sirses"> Sirses  </option>
                              <option value="Sodans"> Sodans  </option>
                              <option value="Thobdans"> Thobdans    </option>
                              <option value="Vachans"> Vachans </option>
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
                        <div class="col-md-6">
                            <div class="col-md-3">
                                @if(!empty($member->photo))
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset($member->photo)}}" class="user-photo"></a>
                                @else
                                    <a href="{{url('member')}}/{{$member->id}}" ><img src="{{ asset('images/user.png')}}" class="user-photo"></a>
                                @endif
                            </div>
                          <label class="col-md-3 control-label member-label"> <a href="{{url('member')}}/{{$member->id}}" >{{$member->f_name}} {{$member->l_name}}</a></label>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function searchMember(member){
        var currentToken = $('meta[name="csrf-token"]').attr('content');
        var gotra = document.getElementById('gotra').value;
        if(member.length > 2){
            $.ajax({
                method:'POST',
                url: "{{url('search-member')}}",
                data:{_token:currentToken,member:member,gotra:gotra}
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
                        firstDivInnerHTML += '<label class="col-md-3 control-label member-label"> <a href="'+urlStr+'" >'+obj.f_name+' '+obj.l_name+'</a></label>';
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
