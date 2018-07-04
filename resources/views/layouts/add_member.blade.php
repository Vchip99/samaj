@extends('layouts.app')
@section('header-css')
    <style type="text/css">
        sup {
            color: red;
            position: relative;
            line-height: 0;
            vertical-align: baseline;
            font-size: 15px;
        }
        .container{
            margin-top: 100px;
        }
        .panel-heading{
            box-sizing: border-box;
            padding-top: 15px;
            padding-left: 25px;
            font-size: 18px;
        }
        .row{
            border:1px solid #D3E0E9;
        }
        .button{
            float:right;
        }
    </style>
@endsection
@section('content')
<div class="container" style="overflow-x: hidden;">
    <div style="margin:10px;">
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
        @if(empty($member->id))
            <div class="row panel-heading" style="color: blue;">Add Member</div>
        @else
            <div class="row panel-heading" style="height: 55px;">Member
                <button class="btn btn-default" style="float: right;margin-left: 5px;" onClick="deleteMember({{$member->is_admin}},{{$member->is_member}},{{$member->id}});">Delete</button>
                <form id="deleteMember_{{$member->id}}" method="POST" action="{{ url('delete-member') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}
                    <input type="hidden" name="member_id" value="{{$member->id}}">
                </form>
                <button class="btn btn-primary" style="float: right;margin-left: 5px;margin-top: -25px;" onClick="toggleReadonly(this);">Edit </button>
            </div>
        @endif
        <div class="row">
            @if(empty($member->id))
                <form class="form-horizontal" method="POST" action="{{ url('add-member') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
            @else
                <form class="form-horizontal" method="POST" action="{{ url('update-member') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT')}}
            @endif
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">Name <sup>*</sup></label>
                    <div class="col-md-3">
                        <input id="f_name" type="text" class="form-control" name="f_name" value="{{ (!empty($member->id))?$member->f_name:old('f_name') }}"  placeholder="first name" @if(!empty($member->id)) readonly @endif required>
                        @if ($errors->has('f_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('f_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <input id="m_name" type="text" class="form-control" name="m_name" value="{{ (!empty($member->id))?$member->m_name:old('m_name') }}"  placeholder="middle name" @if(!empty($member->id)) readonly @endif>
                        @if ($errors->has('m_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('m_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <input id="l_name" type="text" class="form-control" name="l_name" value="{{ (!empty($member->id))?$member->l_name:old('l_name') }}"  placeholder="last name" @if(!empty($member->id)) readonly @endif required>
                        @if ($errors->has('l_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('l_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-3 control-label">E-mail</label>
                    <div class="col-md-6">
                        @if(!empty($member->id))
                            @if($loginUser->id != $member->id && 1 == $member->is_contact_private)
                                **********
                            @else
                                @if(!empty($member->email))
                                    {{ $member->email }}
                                    <input type="hidden" class="form-control" name="email" value="{{ $member->email }}" placeholder="email" readonly>
                                @else
                                    <input type="text" class="form-control" name="email" value="{{ $member->email }}" placeholder="email" readonly>
                                @endif
                            @endif
                        @else
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <label for="mobile" class="col-md-3 control-label">Mobile </label>
                    <div class="col-md-6">
                        @if(!empty($member->id))
                            @if($loginUser->id != $member->id && 1 == $member->is_contact_private)
                                **********
                            @else
                                @if(!empty($member->email))
                                    {{ $member->mobile }}
                                    <input type="hidden" class="form-control" name="mobile" value="{{ $member->mobile }}" placeholder="10 digit mobile number" pattern="[0-9]{10}" readonly>
                                @else
                                    <input type="text" class="form-control" name="mobile" value="{{ $member->mobile }}" placeholder="10 digit mobile number" pattern="[0-9]{10}" readonly>
                                @endif
                            @endif
                        @else
                            <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ (!empty($member->id))?$member->mobile:old('mobile') }}"  placeholder="10 digit mobile number" pattern="[0-9]{10}" @if(!empty($member->id)) readonly @endif>
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        @endif
                    </div>
                </div>
                @if(1 == $loginUser->is_member)
                <div class="form-group{{ $errors->has('is_contact_private') ? ' has-error' : '' }}">
                    <label for="is_contact_private" class="col-md-3 control-label">Show Email & Mobile On Profile </label>
                    @if(!empty($member->id))
                        <div class="col-md-2">
                            <input type="radio" name="is_contact_private" value="0" @if(0 == $member->is_contact_private)checked="true" @endif disabled> Yes
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="is_contact_private" value="1" @if(1 == $member->is_contact_private)checked="true" @endif disabled> No
                        </div>
                    @else
                        <div class="col-md-2">
                            <input type="radio" name="is_contact_private" value="0" checked="true"> Yes
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="is_contact_private" value="1"> No
                        </div>
                    @endif
                </div>
                @endif
                <div class="form-group">
                    <label for="land_line_no" class="col-md-3 control-label">Land Line No</label>
                    <div class="col-md-6">
                        @if($loginUser->id != $member->id && 1 == $member->is_contact_private)
                            **********
                        @else
                            <input id="land_line_no" type="text" class="form-control" name="land_line_no" value="{{ (!empty($member->id))?$member->land_line_no:old('land_line_no') }}" placeholder="land line number" @if(!empty($member->id)) readonly @endif>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="fax" class="col-md-3 control-label">Fax No</label>
                    <div class="col-md-6">
                        @if($loginUser->id != $member->id && 1 == $member->is_contact_private)
                            **********
                        @else
                            <input id="fax" type="text" class="form-control" name="fax" value="{{ (!empty($member->id))?$member->fax:old('fax') }}" placeholder="land line number" @if(!empty($member->id)) readonly @endif>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob" class="col-md-3 control-label">Date of Birth</label>
                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control" name="dob" value="{{ (!empty($member->id))?$member->dob:old('dob') }}" @if(!empty($member->id)) disabled @endif>
                    </div>
                </div>
                @if(1 == $loginUser->is_member)
                <div class="form-group">
                    <label for="anniversary" class="col-md-3 control-label">Anniversary Date</label>
                    <div class="col-md-6">
                        <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{ (!empty($member->id))?$member->anniversary:old('anniversary') }}" @if(!empty($member->id)) disabled @endif>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="gender" class="col-md-3 control-label">Gender</label>
                    @if(!empty($member->id))
                        <div class="col-md-2">
                            <input type="radio" name="gender" value="M" @if('M' == $member->gender)checked="true" @endif disabled> Male
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="gender" value="F" @if('F' == $member->gender)checked="true" @endif disabled> Female
                        </div>
                    @else
                        <div class="col-md-2">
                            <input type="radio" name="gender" value="M" checked="true"> Male
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="gender" value="F"> Female
                        </div>
                    @endif

                </div>
                <div class="form-group ">
                    <label for="photo" class="col-md-3 control-label">Photo</label>
                    <div class="col-md-6">
                        <input id="photo" type="file" class="form-control" name="photo" @if(!empty($member->id)) disabled @endif>
                    </div>
                </div>
                @if(!empty($member->id) && !empty($member->photo))
                    <div class="form-group ">
                        <label for="photo" class="col-md-3 control-label">Existing Photo</label>
                        <div class="col-md-6">
                        {{ basename($member->photo)}}
                        </div>
                    </div>
                @endif
                @if(1 == $loginUser->is_member)
                    <div class="form-group">
                        <label for="married_status" class="col-md-3 control-label">Married Status</label>
                        @if(!empty($member->id))
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="1" @if(1 == $member->married_status)checked="true" @endif onclick="toggleSpouse(this);" disabled> Married
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="0" @if(0 == $member->married_status)checked="true" @endif onclick="toggleSpouse(this);" disabled> Un-Married
                            </div>
                        @else
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="1" checked="true" onclick="toggleSpouse(this);"> Married
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="0" onclick="toggleSpouse(this);"> Un-Married
                            </div>
                        @endif
                    </div>
                    @if(!empty($member->id ))
                        @if(1 == $member->married_status)
                            <div id="spouseDiv" class="form-group">
                                <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                                <div class="col-md-6">
                                    <input id="spouse" type="text" class="form-control" name="spouse" value="{{$member->spouse}}" placeholder="Spouse Name" @if(!empty($member->id)) readonly @endif>
                                </div>
                            </div>
                        @else
                            <div id="spouseDiv" class="form-group hide">
                                <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                                <div class="col-md-6">
                                    <input id="spouse" type="text" class="form-control" name="spouse" value="{{$member->spouse}}" placeholder="Spouse Name" @if(!empty($member->id)) readonly @endif>
                                </div>
                            </div>
                        @endif
                    @else
                        <div id="spouseDiv" class="form-group">
                            <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                            <div class="col-md-6">
                                <input id="spouse" type="text" class="form-control" name="spouse" placeholder="Spouse Name">
                            </div>
                        </div>
                    @endif

                    @if(!empty($member->id))
                        @if(0 == $member->married_status)
                            <div id="UnMarriedDiv" class="form-group">
                                <label for="is_marriage_candidate" class="col-md-3 control-label">Wish to display information in parinay</label>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="1" @if(1 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disabled> Yes
                                </div>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="0" @if(0 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disable> No
                                </div>
                            </div>
                        @else
                            <div id="UnMarriedDiv" class="form-group hide">
                                <label for="is_marriage_candidate" class="col-md-3 control-label">Wish to display information in parinay</label>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="1" @if(1 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disabled> Yes
                                </div>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="0" @if(0 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disable> No
                                </div>
                            </div>
                        @endif
                    @else
                        <div id="UnMarriedDiv" class="form-group hide">
                            <label for="is_marriage_candidate" class="col-md-3 control-label">Wish to display information in parinay</label>
                            <div class="col-md-2">
                                <input type="radio" name="is_marriage_candidate" value="1" onclick="toggleMarriedCandidate(this);"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="is_marriage_candidate" value="0" checked="true"onclick="toggleMarriedCandidate(this);"> No
                            </div>
                        </div>
                    @endif
                @endif
                @if(!empty($member->id) && 0 == $member->married_status)
                    @if(1 == $loginUser->is_member)
                        <div id="bioDataDiv" class="form-group hide">
                    @else
                        <div id="bioDataDiv" class="form-group">
                    @endif
                        <label for="bio_data" class="col-md-3 control-label">Bio-Data</label>
                        <div class="col-md-6">
                            <input id="bio_data" type="file" class="form-control" name="bio_data" disabled>
                        </div>
                    </div>
                    @if($member->bio_data)
                        <div id="bioDataDiv" class="form-group  ">
                            <label for="bio_data" class="col-md-3 control-label">Existing Bio-Data</label>
                            <div class="col-md-6">
                                {{basename($member->bio_data)}}
                            </div>
                        </div>
                    @endif
                    @if(1 == $loginUser->is_member)
                        <div id="kundaliDiv" class="form-group  hide">
                    @else
                        <div id="kundaliDiv" class="form-group">
                    @endif
                        <label for="kundali" class="col-md-3 control-label">Kundali</label>
                        <div class="col-md-6">
                            <input id="kundali" type="file" class="form-control" name="kundali" disabled>
                        </div>
                    </div>
                    @if($member->kundali)
                        <div id="kundaliDiv" class="form-group  ">
                            <label for="kundali" class="col-md-3 control-label">Existing Kundali</label>
                            <div class="col-md-6">
                                {{basename($member->kundali)}}
                            </div>
                        </div>
                    @endif
                    <div id="jobLocation" class="form-group  ">
                        <label for="job_location" class="col-md-3 control-label">Job Location</label>
                        <div class="col-md-6">
                            <input type="text" name="job_location" class="form-control" value="{{$member->job_location}}" placeholder="Job Location" readonly>
                        </div>
                    </div>
                @else
                    <div id="bioDataDiv" class="form-group hide ">
                        <label for="bio_data" class="col-md-3 control-label">Bio-Data</label>
                        <div class="col-md-6">
                            <input id="bio_data" type="file" class="form-control" name="bio_data">
                        </div>
                    </div>
                    <div id="kundaliDiv" class="form-group hide ">
                        <label for="kundali" class="col-md-3 control-label">Kundali</label>
                        <div class="col-md-6">
                            <input id="kundali" type="file" class="form-control" name="kundali">
                        </div>
                    </div>
                    <div id="jobLocation" class="form-group  hide">
                        <label for="job_location" class="col-md-3 control-label">Job Location</label>
                        <div class="col-md-6">
                            <input type="text" name="job_location" class="form-control" value="" placeholder="Job Location">
                        </div>
                    </div>
                @endif
                <!-- <div class="form-group ">
                    <label for="gotra" class="col-md-3 control-label">Gotra </label>
                    <div class="col-md-6">
                        <select class="form-control" name="gotra"  @if(!empty($member->id)) disabled @endif>
                            <option value="">Select Gotra</option>
                            <option value="Achitrans" @if('Achitrans' == $member->gotra)selected="true" @endif> Achitrans   </option>
                            <option value="Amrans" @if('Amrans' == $member->gotra)selected="true" @endif> Amrans  </option>
                            <option value="Attalans" @if('Attalans' == $member->gotra)selected="true" @endif> Attalans    </option>
                            <option value="Balans" @if('Balans' == $member->gotra)selected="true" @endif> Balans  </option>
                            <option value="Balansh" @if('Balansh' == $member->gotra)selected="true" @endif> Balansh </option>
                            <option value="Bhansali" @if('Bhansali' == $member->gotra)selected="true" @endif> Bhansali    </option>
                            <option value="Bhattayans" @if('Bhattayans' == $member->gotra)selected="true" @endif> Bhattayans  </option>
                            <option value="Bhatyas" @if('Bhatyas' == $member->gotra)selected="true" @endif> Bhatyas </option>
                            <option value="Bugdalimb" @if('Bugdalimb' == $member->gotra)selected="true" @endif> Bugdalimb   </option>
                            <option value="Chandrans" @if('Chandrans' == $member->gotra)selected="true" @endif> Chandrans   </option>
                            <option value="Chandras" @if('Chandras' == $member->gotra)selected="true" @endif> Chandras    </option>
                            <option value="Chudans" @if('Chudans' == $member->gotra)selected="true" @endif> Chudans </option>
                            <option value="Dhanans" @if('Dhanans' == $member->gotra)selected="true" @endif> Dhanans </option>
                            <option value="Dhumrans" @if('Dhumrans' == $member->gotra)selected="true" @endif> Dhumrans    </option>
                            <option value="Fafdans" @if('Fafdans' == $member->gotra)selected="true" @endif> Fafdans </option>
                            <option value="Gajans" @if('Gajans' == $member->gotra)selected="true" @endif> Gajans  </option>
                            <option value="Gataumasya" @if('Gataumasya' == $member->gotra)selected="true" @endif> Gataumasya  </option>
                            <option value="Gaurans" @if('Gaurans' == $member->gotra)selected="true" @endif> Gaurans </option>
                            <option value="Gawans" @if('Gawans' == $member->gotra)selected="true" @endif> Gawans  </option>
                            <option value="Gowans" @if('Gowans' == $member->gotra)selected="true" @endif> Gowans  </option>
                            <option value="Haridrans" @if('Haridrans' == $member->gotra)selected="true" @endif> Haridrans   </option>
                            <option value="Jaislani" @if('Jaislani' == $member->gotra)selected="true" @endif> Jaislani    </option>
                            <option value="Jhumrans" @if('Jhumrans' == $member->gotra)selected="true" @endif> Jhumrans    </option>
                            <option value="Kagans" @if('Kagans' == $member->gotra)selected="true" @endif> Kagans  </option>
                            <option value="Kagayans" @if('Kagayans' == $member->gotra)selected="true" @endif> Kagayans    </option>
                            <option value="Kamlas" @if('Kamlas' == $member->gotra)selected="true" @endif> Kamlas  </option>
                            <option value="Kapilans" @if('Kapilans' == $member->gotra)selected="true" @endif> Kapilans    </option>
                            <option value="Kapilansh" @if('Kapilansh' == $member->gotra)selected="true" @endif> Kapilansh   </option>
                            <option value="Karwans" @if('Karwans' == $member->gotra)selected="true" @endif> Karwans </option>
                            <option value="Kaschyap" @if('Kaschyap' == $member->gotra)selected="true" @endif> Kaschyap    </option>
                            <option value="Kaushik" @if('Kaushik' == $member->gotra)selected="true" @endif> Kaushik </option>
                            <option value="Khalans" @if('Khalans' == $member->gotra)selected="true" @endif> Khalans </option>
                            <option value="Khalansi" @if('Khalansi' == $member->gotra)selected="true" @endif> Khalansi    </option>
                            <option value="Liyans" @if('Liyans' == $member->gotra)selected="true" @endif> Liyans  </option>
                            <option value="Loras" @if('Loras' == $member->gotra)selected="true" @endif> Loras   </option>
                            <option value="Manans" @if('Manans' == $member->gotra)selected="true" @endif> Manans  </option>
                            <option value="Manmans" @if('Manmans' == $member->gotra)selected="true" @endif> Manmans </option>
                            <option value="Mugans" @if('Mugans' == $member->gotra)selected="true" @endif> Mugans  </option>
                            <option value="Musayas" @if('Musayas' == $member->gotra)selected="true" @endif> Musayas </option>
                            <option value="Nanans" @if('Nanans' == $member->gotra)selected="true" @endif> Nanans  </option>
                            <option value="Nanased" @if('Nanased' == $member->gotra)selected="true" @endif> Nanased </option>
                            <option value="Nandans" @if('Nandans' == $member->gotra)selected="true" @endif> Nandans </option>
                            <option value="Panchans" @if('Panchans' == $member->gotra)selected="true" @endif> Panchans    </option>
                            <option value="Paras" @if('Paras' == $member->gotra)selected="true" @endif> Paras   </option>
                            <option value="Peeplan" @if('Peeplan' == $member->gotra)selected="true" @endif> Peeplan </option>
                            <option value="Rajhans" @if('Rajhans' == $member->gotra)selected="true" @endif> Rajhans </option>
                            <option value="Saadans" @if('Saadans' == $member->gotra)selected="true" @endif> Saadans </option>
                            <option value="Saboo" @if('Saboo' == $member->gotra)selected="true" @endif> Saboo   </option>
                            <option value="Sandans" @if('Sandans' == $member->gotra)selected="true" @endif> Sandans </option>
                            <option value="Sandhans" @if('Sandhans' == $member->gotra)selected="true" @endif> Sandhans    </option>
                            <option value="Sasans" @if('Sasans' == $member->gotra)selected="true" @endif> Sasans  </option>
                            <option value="Seelans" @if('Seelans' == $member->gotra)selected="true" @endif> Seelans </option>
                            <option value="Sesans" @if('Sesans' == $member->gotra)selected="true" @endif> Sesans  </option>
                            <option value="Silansh" @if('Silansh' == $member->gotra)selected="true" @endif> Silansh </option>
                            <option value="Sirses" @if('Sirses' == $member->gotra)selected="true" @endif> Sirses  </option>
                            <option value="Sodans" @if('Sodans' == $member->gotra)selected="true" @endif> Sodans  </option>
                            <option value="Thobdans" @if('Thobdans' == $member->gotra)selected="true" @endif> Thobdans    </option>
                            <option value="Vachans" @if('Vachans' == $member->gotra)selected="true" @endif> Vachans </option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group ">
                    <label for="blood_group" class="col-md-3 control-label">Blood Group</label>
                    <div class="col-md-6">
                        <select class="form-control" name="blood_group" @if(!empty($member->id)) disabled @endif>
                            <option value="">Select Blood Group</option>
                            <option value="A+" @if('A+' == $member->blood_group)selected="true" @endif>A+</option>
                            <option value="A-" @if('A-' == $member->blood_group)selected="true" @endif>A-</option>
                            <option value="B+" @if('B+' == $member->blood_group)selected="true" @endif>B+</option>
                            <option value="B-" @if('B-' == $member->blood_group)selected="true" @endif>B-</option>
                            <option value="AB+" @if('AB+' == $member->blood_group)selected="true" @endif>AB+</option>
                            <option value="AB-" @if('AB-' == $member->blood_group)selected="true" @endif>AB-</option>
                            <option value="O+" @if('O+' == $member->blood_group)selected="true" @endif>O+</option>
                            <option value="O-" @if('O-' == $member->blood_group)selected="true" @endif>O-</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="education" class="col-md-3 control-label">Education</label>
                    <div class="col-md-6">
                        <select class="form-control" name="education[]" multiple @if(!empty($member->id)) disabled @endif >
                            <option value="">Select Education</option>
                            @php
                                $educations = explode('|', $member->education);
                            @endphp
                            <optgroup label="Engineering">
                                <option value="B.Arch" @if(in_array('B.Arch', $educations))selected="true" @endif>B.Arch</option>
                                <option value="B.E" @if(in_array('B.E', $educations))selected="true" @endif>B.E</option>
                                <option value="B.S(Engg)" @if(in_array('B.S(Engg)', $educations))selected="true" @endif>B.S(Engg)</option>
                                <option value="B.Tech" @if(in_array('B.Tech', $educations))selected="true" @endif>B.Tech</option>
                                <option value="M.S(Engg)" @if(in_array('M.S(Engg)', $educations))selected="true" @endif>M.S(Engg)</option>
                                <option value="M.E/M.Tech" @if(in_array('M.E/M.Tech', $educations))selected="true" @endif>M.E/M.Tech</option>
                            </optgroup>
                            <optgroup label="Finance / Commerce">
                                <option value="B.Com" @if(in_array('B.Com', $educations))selected="true" @endif>B.Com</option>
                                <option value="CA" @if(in_array('CA', $educations))selected="true" @endif>CA</option>
                                <option value="CFA" @if(in_array('CFA', $educations))selected="true" @endif>CFA</option>
                                <option value="CPA" @if(in_array('CPA', $educations))selected="true" @endif>CPA</option>
                                <option value="CS" @if(in_array('CS', $educations))selected="true" @endif>CS</option>
                                <option value="ICWAI" @if(in_array('ICWAI', $educations))selected="true" @endif>ICWAI</option>
                                <option value="M.Com" @if(in_array('M.Com', $educations))selected="true" @endif>M.Com</option>
                            </optgroup>
                            <optgroup label="Computers">
                                <option value="BCA" @if(in_array('BCA', $educations))selected="true" @endif>BCA</option>
                                <option value="MCS" @if(in_array('MCS', $educations))selected="true" @endif>MCS</option>
                                <option value="MCA/PGDCA" @if(in_array('MCA/PGDCA', $educations))selected="true" @endif>MCA/PGDCA</option>
                            </optgroup>
                            <optgroup label="Law">
                                <option value="BL" @if(in_array('BL', $educations))selected="true" @endif>BL</option>
                                <option value="LLB" @if(in_array('LLB', $educations))selected="true" @endif>LLB</option>
                                <option value="ML/LLM" @if(in_array('ML/LLM', $educations))selected="true" @endif>ML/LLM</option>
                            </optgroup>
                            <optgroup label="Management">
                                <option value="BBA" @if(in_array('BBA', $educations))selected="true" @endif>BBA</option>
                                <option value="MBA/PGDM" @if(in_array('MBA/PGDM', $educations))selected="true" @endif>MBA/PGDM</option>
                                <option value="PGDBM" @if(in_array('PGDBM', $educations))selected="true" @endif>PGDBM</option>
                            </optgroup>
                            <optgroup label="Medicine">
                                <option value="BAMS" @if(in_array('BAMS', $educations))selected="true" @endif>BAMS</option>
                                <option value="BDS" @if(in_array('BDS', $educations))selected="true" @endif>BDS</option>
                                <option value="BHMS" @if(in_array('BHMS', $educations))selected="true" @endif>BHMS</option>
                                <option value="MBBS" @if(in_array('MBBS', $educations))selected="true" @endif>MBBS</option>
                                <option value="MD/MS" @if(in_array('MD/MS', $educations))selected="true" @endif>MD/MS</option>
                                <option value="MDS" @if(in_array('MDS', $educations))selected="true" @endif>MDS</option>
                            </optgroup>
                            <optgroup label="Pharamcy">
                                <option value="B.Pharm" @if(in_array('B.Pharm', $educations))selected="true" @endif>B.Pharm</option>
                                <option value="M.Pharm" @if(in_array('M.Pharm', $educations))selected="true" @endif>M.Pharm</option>
                            </optgroup>
                            <optgroup label="Arts / Science">
                                <option value="Bachelor" @if(in_array('Bachelor', $educations))selected="true" @endif>Bachelor</option>
                                <option value="B.A" @if(in_array('B.A', $educations))selected="true" @endif>B.A</option>
                                <option value="B.Ed" @if(in_array('B.Ed', $educations))selected="true" @endif>B.Ed</option>
                                <option value="B.S" @if(in_array('B.S', $educations))selected="true" @endif>B.S</option>
                                <option value="B.Sc" @if(in_array('B.Sc', $educations))selected="true" @endif>B.Sc</option>
                                <option value="Integrated PG" @if(in_array('Integrated PG', $educations))selected="true" @endif>Integrated PG</option>
                                <option value="M.A" @if(in_array('M.A', $educations))selected="true" @endif>M.A</option>
                                <option value="Masters" @if(in_array('Masters', $educations))selected="true" @endif>Masters</option>
                                <option value="M.Ed" @if(in_array('M.Ed', $educations))selected="true" @endif>M.Ed</option>
                                <option value="M.Sc" @if(in_array('M.Sc', $educations))selected="true" @endif>M.Sc</option>
                                <option value="Post graduation" @if(in_array('Post graduation', $educations))selected="true" @endif>Post graduation</option>
                            </optgroup>
                            <optgroup label="Doctorates">
                                <option value="Doctorate" @if(in_array('Doctorate', $educations))selected="true" @endif>Doctorate</option>
                                <option value="M.Phil" @if(in_array('M.Phil', $educations))selected="true" @endif>M.Phil</option>
                                <option value="Ph.D" @if(in_array('Ph.D', $educations))selected="true" @endif>Ph.D</option>
                            </optgroup>
                            <optgroup label="Non Graduates">
                                <option value="Trade School" @if(in_array('Trade School', $educations))selected="true" @endif>Trade School</option>
                                <option value="Undergraduate" @if(in_array('Undergraduate', $educations))selected="true" @endif>Undergraduate</option>
                                <option value="Polytechnic" @if(in_array('Polytechnic', $educations))selected="true" @endif>Polytechnic</option>
                                <option value="High School/HSC" @if(in_array('High School/HSC', $educations))selected="true" @endif>High School/HSC</option>
                                <option value="Diploma" @if(in_array('Diploma', $educations))selected="true" @endif>Diploma</option>
                                <option value="Intermediate" @if(in_array('Intermediate', $educations))selected="true" @endif>Intermediate</option>
                            </optgroup>
                            <optgroup label="Other">
                                <option value="Other" @if(in_array('Other', $educations))selected="true" @endif>Other</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="profession" class="col-md-3 control-label">Profession</label>
                    <div class="col-md-6">
                        <select class="form-control" name="profession" onChange="toggleOtherProfession(this);" @if(!empty($member->id)) disabled @endif>
                            <option  value=""> Select Profession</option>
                            <option value="Accountant" @if('Accountant' == $member->profession)selected="true" @endif>Accountant</option>
                            <option value="Advocate" @if('Advocate' == $member->profession)selected="true" @endif>Advocate</option>
                            <option value="Architect" @if('Architect' == $member->profession)selected="true" @endif>Architect</option>
                            <option value="Businessman" @if('Businessman' == $member->profession)selected="true" @endif>Businessman</option>
                            <option value="CA" @if('CA' == $member->profession)selected="true" @endif>CA</option>
                            <option value="Designer graphic and other" @if('Designer graphic and other' == $member->profession)selected="true" @endif>Designer graphic and other</option>
                            <option value="Doctor" @if('Doctor' == $member->profession)selected="true" @endif>Doctor</option>
                            <option value="Engineers" @if('Engineers' == $member->profession)selected="true" @endif>Engineers</option>
                            <option value="Farmer" @if('Farmer' == $member->profession)selected="true" @endif>Farmer</option>
                            <option value="Government Job" @if('Government Job' == $member->profession)selected="true" @endif>Government Job</option>
                            <option value="Other" @if('Other' == $member->profession)selected="true" @endif>Other</option>
                            <option value="Private Job" @if('Private Job' == $member->profession)selected="true" @endif>Private Job</option>
                            <option value="Retired" @if('Retired' == $member->profession)selected="true" @endif>Retired</option>
                            <option value="Self employed" @if('Self employed' == $member->profession)selected="true" @endif>Self employed</option>
                            <option value="Students" @if('Students' == $member->profession)selected="true" @endif>Students</option>
                            <option value="Surveyors" @if('Surveyors' == $member->profession)selected="true" @endif>Surveyors</option>
                            <option value="Teacher" @if('Teacher' == $member->profession)selected="true" @endif>Teacher</option>
                            <option value="Technicians" @if('Technicians' == $member->profession)selected="true" @endif>Technicians</option>
                        </select>
                    </div>
                </div>
                @if(!empty($member->id) && 'Other' == $member->profession)
                    <div class="form-group " id="otherProfession">
                        <label for="other_profession" class="col-md-3 control-label">Other Profession</label>
                        <div class="col-md-6">
                            <input id="other_profession" type="text" class="form-control" name="other_profession" value="{{ (!empty($member->id))?$member->other_profession:old('other_profession') }}" placeholder="Other Profession" @if(!empty($member->id)) readonly @endif>
                        </div>
                    </div>
                @else
                    <div class="form-group hide" id="otherProfession">
                        <label for="other_profession" class="col-md-3 control-label">Other Profession</label>
                        <div class="col-md-6">
                            <input id="other_profession" type="text" class="form-control" name="other_profession" value="{{ (!empty($member->id))?$member->other_profession:old('other_profession') }}" placeholder="Other Profession">
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="designation" class="col-md-3 control-label">Designation</label>
                    <div class="col-md-6">
                        <input id="designation" type="text" class="form-control" name="designation" value="{{ (!empty($member->id))?$member->designation:old('designation') }}" placeholder="designation"  @if(!empty($member->id)) readonly @endif>
                    </div>
                </div>
                <div class="form-group">
                    <label for="website" class="col-md-3 control-label">Web-site(Personal)</label>
                    <div class="col-md-6">
                        <input id="website" type="text" class="form-control" name="website" value="{{ (!empty($member->id))?$member->website:old('website') }}" placeholder="personal webiste url"  @if(!empty($member->id)) readonly @endif>
                    </div>
                </div>
                @if(empty($member->id))
                <div class="form-group">
                    <label for="is_same_address" class="col-md-3 control-label">Address: Same as Family Head</label>
                        <div class="col-md-2">
                            <input type="radio" name="is_same_address" value="1" checked="true" onclick="toggleAddress(this);"> Yes
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="is_same_address" value="0" onclick="toggleAddress(this);"> No
                        </div>
                </div>
                @endif
                @if(!empty($member->id))
                    <div id="addressDiv" class="">
                @else
                    <div id="addressDiv" class="hide">
                @endif
                    <div class="form-group">
                        <label for="address" class="col-md-3 control-label">Address</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="address"  @if(!empty($member->id)) readonly @endif>{{ (!empty($member->id))?$member->address:old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="state" class="col-md-3 control-label">State</label>
                        <div class="col-md-6">Maharashtra</div>
                    </div>
                    <div class="form-group ">
                        <label for="city" class="col-md-3 control-label">City</label>
                        @if(1 == $loginUser->is_member)
                            <div class="col-md-6">Amravati</div>
                        @else
                            <div class="col-md-6">
                                <input type="text" name="city" class="form-control" value="{{ (!empty($member->id))?$member->city:old('city') }}" placeholder="city" readonly>
                            </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="pin" class="col-md-3 control-label">Pin</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="pin" value="{{ (!empty($member->id))?$member->pin:old('pin') }}" placeholder="pin"  @if(!empty($member->id)) readonly @endif/>
                        </div>
                    </div>
                </div>
                @if(1 == $loginUser->is_member)
                <div class="form-group ">
                    <label for="admin_relation" class="col-md-3 control-label">Relation with Family Head</label>
                    <div class="col-md-6">
                        @if(($member->id == $loginUser->id && 1 == $loginUser->is_admin) ||( 1 == $loginUser->is_super_admin && 1 == $member->is_admin))
                            Family Head
                        @else
                            <select class="form-control" name="admin_relation" @if(!empty($member->id)) disabled @endif>
                                <option value="">Select Relation</option>
                                <option value="Father" @if('Father' == $member->admin_relation)selected="true" @endif>Father</option>
                                <option value="Mother" @if('Mother' == $member->admin_relation)selected="true" @endif>Mother</option>
                                <option value="Brother" @if('Brother' == $member->admin_relation)selected="true" @endif>Brother</option>
                                <option value="Sister" @if('Sister' == $member->admin_relation)selected="true" @endif>Sister</option>
                                <option value="Wife" @if('Wife' == $member->admin_relation)selected="true" @endif>Wife</option>
                                <option value="Son" @if('Son' == $member->admin_relation)selected="true" @endif>Son</option>
                                <option value="Daughter" @if('Daughter' == $member->admin_relation)selected="true" @endif>Daughter</option>
                                <option value="Daughter in Law" @if('Daughter in Law' == $member->admin_relation)selected="true" @endif>Daughter in Law</option>
                                <option value="Grand Daughter in Law" @if('Grand Daughter in Law' == $member->admin_relation)selected="true" @endif>Grand Daughter in Law</option>
                                <option value="Sister in Law" @if('Sister in Law' == $member->admin_relation)selected="true" @endif>Sister in Law</option>
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
                        @endif
                    </div>
                </div>
                @endif
                <!-- <div class="form-group">
                    <label for="facebook_profile" class="col-md-3 control-label">Facebook Profile Url</label>
                    <div class="col-md-6">
                        <input id="facebook_profile" type="text" class="form-control" name="facebook_profile" value="{{ (!empty($member->id))?$member->facebook_profile:old('facebook_profile') }}" placeholder="facebook profile url" @if(!empty($member->id)) readonly @endif>
                    </div>
                </div>
                <div class="form-group">
                    <label for="google_profile" class="col-md-3 control-label">Google Plus Profile Url</label>
                    <div class="col-md-6">
                        <input id="google_profile" type="text" class="form-control" name="google_profile" value="{{ (!empty($member->id))?$member->google_profile:old('google_profile') }}" placeholder="google plus profile url" @if(!empty($member->id)) readonly @endif>
                    </div>
                </div>
                <div class="form-group">
                    <label for="linkedin_profile" class="col-md-3 control-label">Linkedin Profile Url</label>
                    <div class="col-md-6">
                        <input id="linkedin_profile" type="text" class="form-control" name="linkedin_profile" value="{{ (!empty($member->id))?$member->linkedin_profile:old('linkedin_profile') }}" placeholder="linkedin profile url" @if(!empty($member->id)) readonly @endif>
                    </div>
                </div> -->
                @if(!empty($member->id))
                <div class="form-group hide" id="submitBtnDiv">
                    <div class="col-md-6 col-md-offset-4">
                        <input type="hidden" name="member_id" value="{{$member->id}}">
                        <button type="submit" class="btn btn-primary">Update Member</button>
                        <a class="btn btn-primary" onClick="cancelUpdate();">Cancel Update</a>
                    </div>
                </div>
                @else
                    <div class="form-group" >
                        <div class="col-md-9 " >
                            <div class="button">
                                <button type="submit" class="btn btn-primary">Add Member</button>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    function toggleSpouse(ele){
        if(0 == $(ele).val()){
            document.getElementById('spouseDiv').classList.add('hide');
            document.getElementById('UnMarriedDiv').classList.remove('hide');
            document.getElementById('bioDataDiv').classList.add('hide');
            document.getElementById('kundaliDiv').classList.add('hide');
            document.getElementById('jobLocation').classList.add('hide');
        } else {
            document.getElementById('spouseDiv').classList.remove('hide');
            document.getElementById('UnMarriedDiv').classList.add('hide');
            document.getElementById('bioDataDiv').classList.add('hide');
            document.getElementById('kundaliDiv').classList.add('hide');
            document.getElementById('jobLocation').classList.add('hide');
        }
    }

    function toggleMarriedCandidate(ele){
        if(1 == $(ele).val()){
            document.getElementById('bioDataDiv').classList.remove('hide');
            document.getElementById('kundaliDiv').classList.remove('hide');
            document.getElementById('jobLocation').classList.remove('hide');
        } else {
            document.getElementById('bioDataDiv').classList.add('hide');
            document.getElementById('kundaliDiv').classList.add('hide');
            document.getElementById('jobLocation').classList.add('hide');
        }
    }

    function toggleAddress(ele){
        if(0 == $(ele).val()){
            document.getElementById('addressDiv').classList.remove('hide');
        } else {
            document.getElementById('addressDiv').classList.add('hide');
        }
    }

    function toggleOtherProfession(ele){
        if('Other' == $(ele).val()){
            document.getElementById('otherProfession').classList.remove('hide');
        } else {
            document.getElementById('otherProfession').classList.add('hide');
        }
    }

    function toggleReadonly(ele){
        $(ele).addClass('hide');
        $('#submitBtnDiv').removeClass('hide');
        $('input[type="text"]').attr('readonly', false);
        $('input[type="email"]').attr('readonly', false);
        $('input[type="phone"]').attr('readonly', false);
        $('textarea').attr('readonly', false);
        $('input[type="radio"]').attr('disabled', false);
        $('select').attr('disabled', false);
        $('input[type="date"]').attr('disabled', false);
        $('input[type="file"]').attr('disabled', false);
    }

    function cancelUpdate(){
        window.location.reload();
    }

    function deleteMember(isAdmin,isMember,memberId){
        if(1 == isAdmin && 1 == isMember){
            var message = 'You are Admin. If you delete your self, you and your family members will be deleted?';
        } else {
            var message = 'Are you sure you want to delete?';
        }
        if(confirm(message)){
            formId = 'deleteMember_'+memberId;
            document.getElementById(formId).submit();
        }
        return false;
    }


</script>
@endsection
