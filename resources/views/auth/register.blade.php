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
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('gotra') ? ' has-error' : '' }}">
                            <label for="gotra" class="col-md-3 control-label">Gotra <sup>*</sup></label>
                            <div class="col-md-6">
                                <select class="form-control" name="gotra" id="gotra" required>
                                      <option value="">Select Gotra</option>
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
                                @if ($errors->has('gotra'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gotra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
                            <!-- <div class="col-md-3">
                                <input id="m_name" type="text" class="form-control" name="m_name" value="{{ old('m_name') }}" required autofocus placeholder="middle name">
                                @if ($errors->has('m_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('m_name') }}</strong>
                                    </span>
                                @endif
                            </div> -->
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
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
