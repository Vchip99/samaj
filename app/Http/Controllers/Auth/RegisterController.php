<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'gotra' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'user_id' => 'required|unique:users',
            'email' => 'sometimes|nullable|email|unique:users',
            'mobile' => 'required|regex:/[0-9]{10}/',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $nextAdminFamilyId = User::getNextAdminFamilyId();
        return User::create([
            'gotra' => $data['gotra'],
            'f_name' => $data['f_name'],
            'm_name' => ' ',
            'l_name' => $data['l_name'],
            'user_id' => $data['user_id'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'is_admin' => 1,
            'family_id' => $nextAdminFamilyId,
            'is_contact_private' => 0,
            'password' => bcrypt($data['password']),
            'admin_relation' => 'Admin',
        ]);
    }
}
