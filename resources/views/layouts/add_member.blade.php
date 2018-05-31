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
                <div class="panel-heading">Add Member</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('add-member') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name <sup>*</sup></label>
                            <div class="col-md-3">
                                <input id="f_name" type="text" class="form-control" name="f_name" value="{{ old('f_name') }}" required autofocus placeholder="first name">
                                @if ($errors->has('f_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('f_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="m_name" type="text" class="form-control" name="m_name" value="{{ old('m_name') }}" required autofocus placeholder="middle name">
                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="l_name" type="text" class="form-control" name="l_name" value="{{ old('l_name') }}" required autofocus placeholder="last name">
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
                                <input id="user_id" type="text" class="form-control" name="user_id" value="{{ old('user_id') }}" required placeholder="User id" >
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3 control-label">Mobile <sup>*</sup></label>
                            <div class="col-md-6">
                                <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ old('mobile') }}" required placeholder="10 digit mobile number" pattern="[0-9]{10}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('is_contact_private') ? ' has-error' : '' }}">
                            <label for="is_contact_private" class="col-md-3 control-label">Show Email & Mobile On Profile <sup>*</sup></label>
                            <div class="col-md-2">
                                <input type="radio" name="is_contact_private" value="0" checked="true"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="is_contact_private" value="1"> No
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label for="land_line_no" class="col-md-3 control-label">Land Line No</label>
                            <div class="col-md-6">
                                <input id="land_line_no" type="text" class="form-control" name="land_line_no" value="{{ old('land_line_no') }}" placeholder="land line number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax" class="col-md-3 control-label">Fax No</label>
                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax') }}" placeholder="land line number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-md-3 control-label">Date of Birth</label>
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-md-3 control-label">Gender</label>
                            <div class="col-md-2">
                                <input type="radio" name="gender" value="M" checked="true"> Male
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="gender" value="F"> Female
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="photo" class="col-md-3 control-label">Photo</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="married_status" class="col-md-3 control-label">Married Status</label>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="1" checked="true" onclick="toggleSpouse(this);"> Married
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="0" onclick="toggleSpouse(this);"> Un-Married
                            </div>
                        </div>
                        <div id="spouseDiv" class="form-group">
                            <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                            <div class="col-md-6">
                                <input id="spouse" type="text" class="form-control" name="spouse" placeholder="Spouse Name">
                            </div>
                        </div>
                        <div id="UnMarriedDiv" class="form-group hide ">
                            <label for="is_marriage_candidate" class="col-md-3 control-label">Is Married Candidate</label>
                            <div class="col-md-2">
                                <input type="radio" name="is_marriage_candidate" value="1" onclick="toggleMarriedCandidate(this);"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="is_marriage_candidate" value="0" checked="true"onclick="toggleMarriedCandidate(this);"> No
                            </div>
                        </div>
                        <div id="bioDataDiv" class="form-group hide ">
                            <label for="bio_data" class="col-md-3 control-label">Bio-Data</label>
                            <div class="col-md-6">
                                <input id="bio_data" type="file" class="form-control" name="bio_data">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="blood_group" class="col-md-3 control-label">Blood Group</label>
                            <div class="col-md-6">
                                <select class="form-control" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="education" class="col-md-3 control-label">Education</label>
                            <div class="col-md-6">
                                <select class="form-control" name="education">
                                    <option value="">Select Education</option>
                                    <optgroup label="Engineering">
                                        <option value="B.Arch">B.Arch</option>
                                        <option value="B.E">B.E</option>
                                        <option value="B.S(Engg)">B.S(Engg)</option>
                                        <option value="B.Tech">B.Tech</option>
                                        <option value="M.S(Engg)">M.S(Engg)</option>
                                        <option value="M.E/M.Tech">M.E/M.Tech</option>
                                    </optgroup>
                                    <optgroup label="Finance / Commerce">
                                        <option value="B.Com">B.Com</option>
                                        <option value="CA">CA</option>
                                        <option value="CFA">CFA</option>
                                        <option value="CPA">CPA</option>
                                        <option value="CS">CS</option>
                                        <option value="ICWAI">ICWAI</option>
                                        <option value="M.Com">M.Com</option>
                                    </optgroup>
                                    <optgroup label="Computers">
                                        <option value="BCA">BCA</option>
                                        <option value="MCS">MCS</option>
                                        <option value="MCA/PGDCA">MCA/PGDCA</option>
                                    </optgroup>
                                    <optgroup label="Law">
                                        <option value="BL">BL</option>
                                        <option value="LLB">LLB</option>
                                        <option value="ML/LLM">ML/LLM</option>
                                    </optgroup>
                                    <optgroup label="Management">
                                        <option value="BBA">BBA</option>
                                        <option value="MBA/PGDM">MBA/PGDM</option>
                                        <option value="PGDBM">PGDBM</option>
                                    </optgroup>
                                    <optgroup label="Medicine">
                                        <option value="BAMS">BAMS</option>
                                        <option value="BDS">BDS</option>
                                        <option value="BHMS">BHMS</option>
                                        <option value="MBBS">MBBS</option>
                                        <option value="MD/MS">MD/MS</option>
                                        <option value="MDS">MDS</option>
                                    </optgroup>
                                    <optgroup label="Pharamcy">
                                        <option value="B.Pharm">B.Pharm</option>
                                        <option value="M.Pharm">M.Pharm</option>
                                    </optgroup>
                                    <optgroup label="Arts / Science">
                                        <option value="Bachelor">Bachelor</option>
                                        <option value="B.A">B.A</option>
                                        <option value="B.Ed">B.Ed</option>
                                        <option value="B.S">B.S</option>
                                        <option value="B.Sc">B.Sc</option>
                                        <option value="Integrated PG">Integrated PG</option>
                                        <option value="M.A">M.A</option>
                                        <option value="Masters">Masters</option>
                                        <option value="M.Ed">M.Ed</option>
                                        <option value="M.Sc">M.Sc</option>
                                        <option value="Post graduation">Post graduation</option>
                                    </optgroup>
                                    <optgroup label="Doctorates">
                                        <option value="Doctorate">Doctorate</option>
                                        <option value="M.Phil">M.Phil</option>
                                        <option value="Ph.D">Ph.D</option>
                                    </optgroup>
                                    <optgroup label="Non Graduates">
                                        <option value="Trade School">Trade School</option>
                                        <option value="Undergraduate">Undergraduate</option>
                                        <option value="Polytechnic">Polytechnic</option>
                                        <option value="High School/HSC">High School/HSC</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Intermediate">Intermediate</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="Other">Other</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="occupation" class="col-md-3 control-label">Occupation</label>
                            <div class="col-md-6">
                                <select class="form-control" name="occupation">
                                    <option  value=""> Select Occupation</option>
                                    <option value="Business">Business</option>
                                    <option value="Service">Service</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website" class="col-md-3 control-label">Web-site(Personal)</label>
                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" placeholder="personal webiste url" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_same_address" class="col-md-3 control-label">Address: Same as Admin</label>
                            <div class="col-md-2">
                                <input type="radio" name="is_same_address" value="1" checked="true" onclick="toggleAddress(this);"> Yes
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="is_same_address" value="0" onclick="toggleAddress(this);"> No
                            </div>
                        </div>
                        <div id="addressDiv" class="hide">
                            <div class="form-group">
                                <label for="address" class="col-md-3 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="state" class="col-md-3 control-label">State</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="state">
                                        <option value="">Select State</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="city" class="col-md-3 control-label">City</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="city">
                                        <option value="">Select City</option>
                                        <option value="Amravati">Amravati</option>
                                        <option value="Akola">Akola</option>
                                        <option value="Nagpur">Nagpur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="pin" class="col-md-3 control-label">Pin</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="pin" value="{{ old('pin') }}" placeholder="pin" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="admin_relation" class="col-md-3 control-label">Relation with Admin</label>
                            <div class="col-md-6">
                                <select class="form-control" name="admin_relation">
                                    <option value="">Select Relation</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="GrandFather">GrandFather</option>
                                    <option value="GrandMother">GrandMother</option>
                                    <option value="GrandSon">GrandSon</option>
                                    <option value="GrandDaughter">GrandDaughter</option>
                                    <option value="Uncle">Uncle</option>
                                    <option value="Aunt">Aunt</option>
                                    <option value="Cousin">Cousin</option>
                                    <option value="Nephew">Nephew</option>
                                    <option value="Niece">Niece</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Member
                                </button>
                            </div>
                        </div>
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
</script>
@endsection
