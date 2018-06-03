<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Validator,DB,Redirect,Auth,Cache;
use App\Libraries\InputSanitise;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validateMobile = [
            'mobile' => 'required|regex:/[0-9]{10}/|digits:10',
        ];

     /**
     * show opt to mobile number
     */
    protected function sendOtp(Request $request){
        $v = Validator::make($request->all(), $this->validateMobile);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $mobile = InputSanitise::inputInt($request->get('mobile'));
        $message = new MessageController;
        $response = $message->sendOtp($mobile);
        // dd(is_object(json_decode($response)));
        if(is_object(json_decode($response)) && 'success' == json_decode($response)->status){
           return Redirect::to('get-otp')->with('message', 'Otp send successfully to your mobile no.');
        } else {
            return back()->withErrors('something went wrong while sendOtp.');
        }
    }

    /**
     * show ui for otp
     */
    protected function getOtp(){
        return view('layouts.otp');
    }

    /**
     * check otp
     */
    protected function checkOtp(Request $request){

        // dd(Cache::get('mobile'));
        $mobile = Cache::get('mobile');
        $serverOtp = Cache::get($mobile);
        if(!empty($mobile) && !empty($serverOtp)){
            $userOtp = $request->get('otp');
            if($userOtp == $serverOtp){
                // login
                $user = User::where('mobile', $mobile)->first();
                if(!is_object($user)){
                    $nextAdminFamilyId = User::getNextAdminFamilyId();
                    $user = User::create([
                        'mobile' => $mobile,
                        'is_admin' => 0,
                        'family_id' => $nextAdminFamilyId,
                        'is_contact_private' => 0,
                        'admin_relation' => 'Admin',
                    ]);
                }
                // dd($user);
                Auth::login($user);
                // $request->session()->regenerate();
                return Redirect::to('home')->with('message', 'Welcome Dear');
            } else {
                return Redirect::to('login')->withErrors('Entered otp is wrong.');
            }
        } else {
            return Redirect::to('login')->withErrors('Something went wrong while checkOtp.');
        }
    }
}
