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
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 55px;">
                    <a href="{{ url('members')}}" class="btn btn-primary" style="float: right;margin-left: 5px;margin-top: -2px;">Back </a>
                </div>
                <div class="panel-body">
                        <form class="form-horizontal" >
                        <div class="form-group ">
                            <label for="gotra" class="col-md-3 control-label">Gotra</label>
                            <div class="col-md-6">
                                <select class="form-control" name="gotra"  disabled>
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
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-3 control-label">Name </label>
                            <div class="col-md-3">
                                <input id="f_name" type="text" class="form-control" name="f_name" value="{{ (!empty($member->id))?$member->f_name:old('f_name') }}" required placeholder="first name" readonly>
                            </div>
                            <div class="col-md-3">
                                <input id="m_name" type="text" class="form-control" name="m_name" value="{{ (!empty($member->id))?$member->m_name:old('m_name') }}" required placeholder="middle name" readonly>
                            </div>
                            <div class="col-md-3">
                                <input id="l_name" type="text" class="form-control" name="l_name" value="{{ (!empty($member->id))?$member->l_name:old('l_name') }}" required placeholder="last name" readonly>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-6">
                                @if(!empty($member->id))
                                    @if(1 == $member->is_contact_private)
                                        **********
                                    @else
                                        <input id="email" type="email" class="form-control" name="email" value="{{ (!empty($member->id))?$member->email:old('email') }}" placeholder="email" readonly>
                                    @endif
                                @else
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-3 control-label">Mobile </label>
                            <div class="col-md-6">
                                @if(1 == $member->is_contact_private)
                                    **********
                                @else
                                    {{ $member->mobile }}
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="land_line_no" class="col-md-3 control-label">Land Line No</label>
                            <div class="col-md-6">
                                @if(1 == $member->is_contact_private)
                                    *********
                                @else
                                    <input id="land_line_no" type="text" class="form-control" name="land_line_no" value="{{ (!empty($member->id))?$member->land_line_no:old('land_line_no') }}" placeholder="land line number" readonly>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fax" class="col-md-3 control-label">Fax No</label>
                            <div class="col-md-6">
                                @if(1 == $member->is_contact_private)
                                    *********
                                @else
                                    <input id="fax" type="text" class="form-control" name="fax" value="{{ (!empty($member->id))?$member->fax:old('fax') }}" placeholder="land line number" readonly>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-md-3 control-label">Date of Birth</label>
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ (!empty($member->id))?$member->dob:old('dob') }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="anniversary" class="col-md-3 control-label">Anniversary Date</label>
                            <div class="col-md-6">
                                <input id="anniversary" type="date" class="form-control" name="anniversary" value="{{ (!empty($member->id))?$member->anniversary:old('anniversary') }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-md-3 control-label">Gender</label>
                            <div class="col-md-2">
                                <input type="radio" name="gender" value="M" @if('M' == $member->gender)checked="true" @endif disabled> Male
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="gender" value="F" @if('F' == $member->gender)checked="true" @endif disabled> Female
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="married_status" class="col-md-3 control-label">Married Status</label>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="1" @if(1 == $member->married_status)checked="true" @endif onclick="toggleSpouse(this);" disabled> Married
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="married_status" value="0" @if(0 == $member->married_status)checked="true" @endif onclick="toggleSpouse(this);" disabled> Un-Married
                            </div>
                        </div>
                        @if(!empty($member->id ))
                            @if(1 == $member->married_status)
                                <div id="spouseDiv" class="form-group">
                                    <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                                    <div class="col-md-6">
                                        <input id="spouse" type="text" class="form-control" name="spouse" value="{{$member->spouse}}" placeholder="Spouse Name" readonly>
                                    </div>
                                </div>
                            @else
                                <div id="spouseDiv" class="form-group hide">
                                    <label for="spouse" class="col-md-3 control-label">Spouse Name</label>
                                    <div class="col-md-6">
                                        <input id="spouse" type="text" class="form-control" name="spouse" value="{{$member->spouse}}" placeholder="Spouse Name" readonly>
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
                        <div class="form-group ">
                            <label for="blood_group" class="col-md-3 control-label">Blood Group</label>
                            <div class="col-md-6">
                                <select class="form-control" name="blood_group" disabled>
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
                                <select class="form-control" name="education"  disabled>
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
                                <select class="form-control" name="occupation"  disabled>
                                    <option  value=""> Select Occupation</option>
                                    <option value="Farmer" @if('Farmer' == $member->occupation)selected="true" @endif>Farmer</option>
                                    <option value="Businessman" @if('Businessman' == $member->occupation)selected="true" @endif>Businessman</option>
                                    <option value="Self employee" @if('Self employee' == $member->occupation)selected="true" @endif>Self employee</option>
                                    <option value="Government Job" @if('Government Job' == $member->occupation)selected="true" @endif>Government Job</option>
                                    <option value="Private Job" @if('Private Job' == $member->occupation)selected="true" @endif>Private Job</option>
                                    <option value="Other" @if('Other' == $member->occupation)selected="true" @endif>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website" class="col-md-3 control-label">Web-site(Personal)</label>
                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" value="{{ (!empty($member->id))?$member->website:old('website') }}" placeholder="personal webiste url"  readonly>
                            </div>
                        </div>
                        <div id="addressDiv" class="">
                            <div class="form-group">
                                <label for="address" class="col-md-3 control-label">Address</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="address"  readonly>{{ (!empty($member->id))?$member->address:old('address') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="state" class="col-md-3 control-label">State</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="state"  disabled>
                                        <option value="">Select State</option>
                                        <option value="Maharashtra" @if('Maharashtra' == $member->state)selected="true" @endif>Maharashtra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="city" class="col-md-3 control-label">City</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="city"  disabled>
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
                                    <input type="text" class="form-control" name="pin" value="{{ (!empty($member->id))?$member->pin:old('pin') }}" placeholder="pin"  readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="admin_relation" class="col-md-3 control-label">Relation with Admin</label>
                            <div class="col-md-6">
                                <select class="form-control" name="admin_relation"  disabled>
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
                        <div class="form-group">
                            <label for="facebook_profile" class="col-md-3 control-label">Facebook Profile Url</label>
                            <div class="col-md-6">
                                <input id="facebook_profile" type="text" class="form-control" name="facebook_profile" value="{{ (!empty($member->id))?$member->facebook_profile:old('facebook_profile') }}" placeholder="facebook profile url" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="google_profile" class="col-md-3 control-label">Google Plus Profile Url</label>
                            <div class="col-md-6">
                                <input id="google_profile" type="text" class="form-control" name="google_profile" value="{{ (!empty($member->id))?$member->google_profile:old('google_profile') }}" placeholder="google plus profile url" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="linkedin_profile" class="col-md-3 control-label">Linkedin Profile Url</label>
                            <div class="col-md-6">
                                <input id="linkedin_profile" type="text" class="form-control" name="linkedin_profile" value="{{ (!empty($member->id))?$member->linkedin_profile:old('linkedin_profile') }}" placeholder="linkedin profile url" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
