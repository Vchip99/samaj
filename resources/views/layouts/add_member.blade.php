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
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
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
            <div class="panel panel-default">
                @if(empty($member->id))
                    <div class="panel-heading">Add Member</div>
                @else
                    <div class="panel-heading" style="height: 55px;">Member
                        @if(1 == $loginUser->is_admin)
                            <button class="btn btn-default" style="float: right;margin-left: 5px;" onClick="deleteMember({{$member->is_admin}},{{$member->id}});">Delete</button>
                            <form id="deleteMember_{{$member->id}}" method="POST" action="{{ url('delete-member') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <input type="hidden" name="member_id" value="{{$member->id}}">
                            </form>
                        @else
                            <button class="btn btn-default" style="float: right;margin-left: 5px;" onClick="deleteMember({{$member->is_admin}},{{$member->id}});">Delete</button>
                            <form id="deleteMember_{{$member->id}}" method="POST" action="{{ url('delete-member') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <input type="hidden" name="member_id" value="{{$member->id}}">
                            </form>
                        @endif
                            <button class="btn btn-primary" style="float: right;margin-left: 5px;margin-top: -21px;" onClick="toggleReadonly(this);">Edit </button>
                    </div>
                @endif
                <div class="panel-body">
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
                                <input id="f_name" type="text" class="form-control" name="f_name" value="{{ (!empty($member->id))?$member->f_name:old('f_name') }}" required placeholder="first name" @if(!empty($member->id)) readonly @endif>
                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="m_name" type="text" class="form-control" name="m_name" value="{{ (!empty($member->id))?$member->m_name:old('m_name') }}" required placeholder="middle name" @if(!empty($member->id)) readonly @endif>
                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="l_name" type="text" class="form-control" name="l_name" value="{{ (!empty($member->id))?$member->l_name:old('l_name') }}" required placeholder="last name" @if(!empty($member->id)) readonly @endif>
                                @if ($errors->has('l_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('l_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id" class="col-md-3 control-label">UserId <sup>*</sup></label>
                            <div class="col-md-6">
                                @if(!empty($member->id))
                                    {{ $member->user_id}}
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $member->user_id}}" required placeholder="User id" readonly>
                                @else
                                    <input id="user_id" type="text" class="form-control" name="user_id" value="{{ old('user_id') }}" required placeholder="User id" >
                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-6">
                                @if(!empty($member->id))
                                    {{ $member->email }}
                                    <input type="hidden" class="form-control" name="email" value="{{ $member->email }}" placeholder="email" readonly>
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
                            <label for="mobile" class="col-md-3 control-label">Mobile <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ (!empty($member->id))?$member->mobile:old('mobile') }}" required placeholder="10 digit mobile number" pattern="[0-9]{10}" @if(!empty($member->id)) readonly @endif>
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
                        @if(empty($member->id))
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label">Password <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-3 control-label">Confirm Password <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="land_line_no" class="col-md-3 control-label">Land Line No</label>
                            <div class="col-md-6">
                                <input id="land_line_no" type="text" class="form-control" name="land_line_no" value="{{ (!empty($member->id))?$member->land_line_no:old('land_line_no') }}" placeholder="land line number" @if(!empty($member->id)) readonly @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax" class="col-md-3 control-label">Fax No</label>
                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ (!empty($member->id))?$member->fax:old('fax') }}" placeholder="land line number" @if(!empty($member->id)) readonly @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-md-3 control-label">Date of Birth</label>
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ (!empty($member->id))?$member->dob:old('dob') }}" @if(!empty($member->id)) disabled @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="anniversary" class="col-md-3 control-label">Anniversary Date</label>
                            <div class="col-md-6">
                                <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{ (!empty($member->id))?$member->anniversary:old('anniversary') }}" @if(!empty($member->id)) disabled @endif>
                            </div>
                        </div>
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
                                <label for="is_marriage_candidate" class="col-md-3 control-label">Is Married Candidate</label>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="1" @if(1 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disabled> Yes
                                </div>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="0" @if(0 == $member->is_marriage_candidate)checked="true" @endif checked="true"onclick="toggleMarriedCandidate(this);" disable> No
                                </div>
                            </div>
                            @else
                                <div id="UnMarriedDiv" class="form-group hide">
                                    <label for="is_marriage_candidate" class="col-md-3 control-label">Is Married Candidate</label>
                                    <div class="col-md-2">
                                        <input type="radio" name="is_marriage_candidate" value="1" @if(1 == $member->is_marriage_candidate)checked="true" @endif onclick="toggleMarriedCandidate(this);" disabled> Yes
                                    </div>
                                    <div class="col-md-2">
                                        <input type="radio" name="is_marriage_candidate" value="0" @if(0 == $member->is_marriage_candidate)checked="true" @endif checked="true"onclick="toggleMarriedCandidate(this);" disable> No
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="UnMarriedDiv" class="form-group hide">
                                <label for="is_marriage_candidate" class="col-md-3 control-label">Is Married Candidate</label>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="1" onclick="toggleMarriedCandidate(this);"> Yes
                                </div>
                                <div class="col-md-2">
                                    <input type="radio" name="is_marriage_candidate" value="0" checked="true"onclick="toggleMarriedCandidate(this);"> No
                                </div>
                            </div>
                        @endif
                        @if(!empty($member->id) && 0 == $member->married_status)
                            <div id="bioDataDiv" class="form-group hide ">
                                <label for="bio_data" class="col-md-3 control-label">Bio-Data</label>
                                <div class="col-md-6">
                                    <input id="bio_data" type="file" class="form-control" name="bio_data" disabled>
                                </div>
                            </div>
                            @if($member->bio_data)
                                <div id="bioDataDiv" class="form-group hide ">
                                    <label for="bio_data" class="col-md-3 control-label">Existing Bio-Data</label>
                                    <div class="col-md-6">
                                        {{basename($member->bio_data)}}
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="bioDataDiv" class="form-group hide ">
                                <label for="bio_data" class="col-md-3 control-label">Bio-Data</label>
                                <div class="col-md-6">
                                    <input id="bio_data" type="file" class="form-control" name="bio_data">
                                </div>
                            </div>
                        @endif
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
                                <select class="form-control" name="education"  @if(!empty($member->id)) disabled @endif>
                                    <option value="">Select Education</option>
                                    <optgroup label="Engineering">
                                        <option value="B.Arch" @if('B.Arch' == $member->education)selected="true" @endif>B.Arch</option>
                                        <option value="B.E" @if('B.E' == $member->education)selected="true" @endif>B.E</option>
                                        <option value="B.S(Engg)" @if('B.S(Engg)' == $member->education)selected="true" @endif>B.S(Engg)</option>
                                        <option value="B.Tech" @if('B.Tech' == $member->education)selected="true" @endif>B.Tech</option>
                                        <option value="M.S(Engg)" @if('M.S(Engg)' == $member->education)selected="true" @endif>M.S(Engg)</option>
                                        <option value="M.E/M.Tech" @if('M.E/M.Tech' == $member->education)selected="true" @endif>M.E/M.Tech</option>
                                    </optgroup>
                                    <optgroup label="Finance / Commerce">
                                        <option value="B.Com" @if('B.Com' == $member->education)selected="true" @endif>B.Com</option>
                                        <option value="CA" @if('CA' == $member->education)selected="true" @endif>CA</option>
                                        <option value="CFA" @if('CFA' == $member->education)selected="true" @endif>CFA</option>
                                        <option value="CPA" @if('CPA' == $member->education)selected="true" @endif>CPA</option>
                                        <option value="CS" @if('CS' == $member->education)selected="true" @endif>CS</option>
                                        <option value="ICWAI" @if('ICWAI' == $member->education)selected="true" @endif>ICWAI</option>
                                        <option value="M.Com" @if('M.Com' == $member->education)selected="true" @endif>M.Com</option>
                                    </optgroup>
                                    <optgroup label="Computers">
                                        <option value="BCA" @if('BCA' == $member->education)selected="true" @endif>BCA</option>
                                        <option value="MCS" @if('MCS' == $member->education)selected="true" @endif>MCS</option>
                                        <option value="MCA/PGDCA" @if('MCA/PGDCA' == $member->education)selected="true" @endif>MCA/PGDCA</option>
                                    </optgroup>
                                    <optgroup label="Law">
                                        <option value="BL" @if('BL' == $member->education)selected="true" @endif>BL</option>
                                        <option value="LLB" @if('LLB' == $member->education)selected="true" @endif>LLB</option>
                                        <option value="ML/LLM" @if('ML/LLM' == $member->education)selected="true" @endif>ML/LLM</option>
                                    </optgroup>
                                    <optgroup label="Management">
                                        <option value="BBA" @if('BBA' == $member->education)selected="true" @endif>BBA</option>
                                        <option value="MBA/PGDM" @if('MBA/PGDM' == $member->education)selected="true" @endif>MBA/PGDM</option>
                                        <option value="PGDBM" @if('PGDBM' == $member->education)selected="true" @endif>PGDBM</option>
                                    </optgroup>
                                    <optgroup label="Medicine">
                                        <option value="BAMS" @if('BAMS' == $member->education)selected="true" @endif>BAMS</option>
                                        <option value="BDS" @if('BDS' == $member->education)selected="true" @endif>BDS</option>
                                        <option value="BHMS" @if('BHMS' == $member->education)selected="true" @endif>BHMS</option>
                                        <option value="MBBS" @if('MBBS' == $member->education)selected="true" @endif>MBBS</option>
                                        <option value="MD/MS" @if('MD/MS' == $member->education)selected="true" @endif>MD/MS</option>
                                        <option value="MDS" @if('MDS' == $member->education)selected="true" @endif>MDS</option>
                                    </optgroup>
                                    <optgroup label="Pharamcy">
                                        <option value="B.Pharm" @if('B.Pharm' == $member->education)selected="true" @endif>B.Pharm</option>
                                        <option value="M.Pharm" @if('M.Pharm' == $member->education)selected="true" @endif>M.Pharm</option>
                                    </optgroup>
                                    <optgroup label="Arts / Science">
                                        <option value="Bachelor" @if('Bachelor' == $member->education)selected="true" @endif>Bachelor</option>
                                        <option value="B.A" @if('B.A' == $member->education)selected="true" @endif>B.A</option>
                                        <option value="B.Ed" @if('B.Ed' == $member->education)selected="true" @endif>B.Ed</option>
                                        <option value="B.S" @if('B.S' == $member->education)selected="true" @endif>B.S</option>
                                        <option value="B.Sc" @if('B.Sc' == $member->education)selected="true" @endif>B.Sc</option>
                                        <option value="Integrated PG" @if('Integrated PG' == $member->education)selected="true" @endif>Integrated PG</option>
                                        <option value="M.A" @if('M.A' == $member->education)selected="true" @endif>M.A</option>
                                        <option value="Masters" @if('Masters' == $member->education)selected="true" @endif>Masters</option>
                                        <option value="M.Ed" @if('M.Ed' == $member->education)selected="true" @endif>M.Ed</option>
                                        <option value="M.Sc" @if('M.Sc' == $member->education)selected="true" @endif>M.Sc</option>
                                        <option value="Post graduation" @if('Post graduation' == $member->education)selected="true" @endif>Post graduation</option>
                                    </optgroup>
                                    <optgroup label="Doctorates">
                                        <option value="Doctorate" @if('Doctorate' == $member->education)selected="true" @endif>Doctorate</option>
                                        <option value="M.Phil" @if('M.Phil' == $member->education)selected="true" @endif>M.Phil</option>
                                        <option value="Ph.D" @if('Ph.D' == $member->education)selected="true" @endif>Ph.D</option>
                                    </optgroup>
                                    <optgroup label="Non Graduates">
                                        <option value="Trade School" @if('Trade School' == $member->education)selected="true" @endif>Trade School</option>
                                        <option value="Undergraduate" @if('Undergraduate' == $member->education)selected="true" @endif>Undergraduate</option>
                                        <option value="Polytechnic" @if('Polytechnic' == $member->education)selected="true" @endif>Polytechnic</option>
                                        <option value="High School/HSC" @if('High School/HSC' == $member->education)selected="true" @endif>High School/HSC</option>
                                        <option value="Diploma" @if('Diploma' == $member->education)selected="true" @endif>Diploma</option>
                                        <option value="Intermediate" @if('Intermediate' == $member->education)selected="true" @endif>Intermediate</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="Other" @if('Other' == $member->education)selected="true" @endif>Other</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="occupation" class="col-md-3 control-label">Occupation</label>
                            <div class="col-md-6">
                                <select class="form-control" name="occupation"  @if(!empty($member->id)) disabled @endif>
                                    <option  value=""> Select Occupation</option>
                                    <option value="Business" @if('Business' == $member->occupation)selected="true" @endif>Business</option>
                                    <option value="Service" @if('Service' == $member->occupation)selected="true" @endif>Service</option>
                                    <option value="Other" @if('Other' == $member->occupation)selected="true" @endif>Other</option>
                                </select>
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
                            <label for="is_same_address" class="col-md-3 control-label">Address: Same as Admin</label>
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
                                <div class="col-md-6">
                                    <select class="form-control" name="state"  @if(!empty($member->id)) disabled @endif>
                                        <option value="">Select State</option>
                                        <option value="Maharashtra" @if('Maharashtra' == $member->state)selected="true" @endif>Maharashtra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="city" class="col-md-3 control-label">City</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="city"  @if(!empty($member->id)) disabled @endif>
                                        <option value="">Select City</option>
                                        <option value="Amravati" @if('Amravati' == $member->city)selected="true" @endif>Amravati</option>
                                        <option value="Akola" @if('Akola' == $member->city)selected="true" @endif>Akola</option>
                                        <option value="Nagpur" @if('Nagpur' == $member->city)selected="true" @endif>Nagpur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="pin" class="col-md-3 control-label">Pin</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="pin" value="{{ (!empty($member->id))?$member->pin:old('pin') }}" placeholder="pin"  @if(!empty($member->id)) readonly @endif/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="admin_relation" class="col-md-3 control-label">Relation with Admin</label>
                            <div class="col-md-6">
                                <select class="form-control" name="admin_relation"  @if(!empty($member->id)) disabled @endif>
                                    <option value="">Select Relation</option>
                                    <option value="Self" @if('Self' == $member->admin_relation)selected="true" @endif>Self</option>
                                    <option value="Father" @if('Father' == $member->admin_relation)selected="true" @endif>Father</option>
                                    <option value="Mother" @if('Mother' == $member->admin_relation)selected="true" @endif>Mother</option>
                                    <option value="Brother" @if('Brother' == $member->admin_relation)selected="true" @endif>Brother</option>
                                    <option value="Sister" @if('Sister' == $member->admin_relation)selected="true" @endif>Sister</option>
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
                        <div class="form-group">
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
                        </div>
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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Add Member</button>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function toggleSpouse(ele){
        if(0 == $(ele).val()){
            document.getElementById('spouseDiv').classList.add('hide');
            document.getElementById('UnMarriedDiv').classList.remove('hide');
            document.getElementById('bioDataDiv').classList.remove('hide');
        } else {
            document.getElementById('spouseDiv').classList.remove('hide');
            document.getElementById('UnMarriedDiv').classList.add('hide');
            document.getElementById('bioDataDiv').classList.add('hide');
        }
    }

    function toggleMarriedCandidate(ele){
        if(1 == $(ele).val()){
            document.getElementById('bioDataDiv').classList.remove('hide');
        } else {
            document.getElementById('bioDataDiv').classList.add('hide');
        }
    }

    function toggleAddress(ele){
        if(0 == $(ele).val()){
            document.getElementById('addressDiv').classList.remove('hide');
        } else {
            document.getElementById('addressDiv').classList.add('hide');
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

    function deleteMember(isAdmin, memberId){
        if(1 == isAdmin){
            var message = 'Yor are a Admin. so if you delete your self, all members in your family will be deleted. If you want to delete your self as a member, please assign Admin to another member and then delete. '
        } else {
            var message = 'Are you sure you want to delete.';
        }
        if(confirm(message)){
            formId = 'deleteMember_'+memberId;
            document.getElementById(formId).submit();
        }
        return false;
        // $.confirm({
        //   title: 'Confirmation',
        //   content: 'You want to delete this payment?',
        //   type: 'red',
        //   typeAnimated: true,
        //   buttons: {
        //       Ok: {
        //           text: 'Ok',
        //           btnClass: 'btn-red',
        //           action: function(){
        //             // var id = $(ele).attr('id');
        //             // formId = 'deleteCoursePayment_'+id;
        //             // document.getElementById(formId).submit();
        //           }
        //       },
        //       Cancle: function () {
        //       }
        //     }
        // });
    }
</script>
@endsection
