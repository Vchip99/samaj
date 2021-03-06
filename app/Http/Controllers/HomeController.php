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
        $memberType = $request->get('member_type');
        $mobile = InputSanitise::inputInt($request->get('mobile'));
        $adminLogin = User::where('is_admin', 1)->where('mobile','=', $mobile)->whereNotNull('mobile')->first();
        if(!is_object($adminLogin)){
            $memberLogin = User::where('is_admin', 0)->where('mobile', $mobile)->whereNotNull('mobile')->first();
            if(is_object($memberLogin)){
                return back()->withErrors('Only admin can login. please use admin mobile no.');
            } else {
                return back()->withErrors('Only family head can login. if you are family head and login first time then, please contact Giridhar Rathi-1234567890 or Sachin Rathi-1234567891 .');
            }
        } else {
            if('non-member' == $memberType && 1 == $adminLogin->is_member){
                return back()->withErrors('Given mobile no. is registered as member. So please select type as a member while login.');
            } else if('member' == $memberType && 0 == $adminLogin->is_member){
                return back()->withErrors('Given mobile no. is registered as non-member. So please select type as a non-member while login.');
            }
        }
        // Cache::put('mobile', $mobile, 5);
        // Cache::put('selected_type', $memberType, 5);
        // dd($request->all());
        $message = new MessageController;
        $response = $message->sendOtp($mobile,$memberType);
        // dd($response);
        // if(is_object(json_decode($response)) && 'success' == json_decode($response)->status){
        if($response){
           return Redirect::to('get-otp')->with('message', 'Otp send successfully to your mobile no.');
        } else {
            return back()->withErrors('something went wrong while sendOtp.');
        }
        // return Redirect::to('get-otp')->with('message', 'Please enter otp:123456.');
    }

    /**
     * show ui for otp
     */
    protected function getOtp(){
        // $mobile = Cache::get('mobile');
        // $serverOtp = Cache::get($mobile);
        // dd($serverOtp);
        return view('layouts.otp');
    }

    /**
     * check otp
     */
    protected function checkOtp(Request $request){
        $mobile = Cache::get('mobile');
        $serverOtp = Cache::get($mobile);
        $memberType = Cache::get('selected_type');
        if(!empty($mobile) && !empty($serverOtp) && !empty($memberType)){
            $userOtp = $request->get('otp');
            // $isNewRecord = false;
            if($userOtp == $serverOtp){
            // if('123456' == $userOtp){
                // login
                $user = User::where('is_admin', 1)->where('mobile','=', $mobile)->whereNotNull('mobile')->first();
                if(!is_object($user)){
                    return Redirect::to('login')->withErrors('Member does not exists.');
                }
                Auth::login($user);
                Cache::forget($mobile);
                Cache::forget('selected_type');
                Cache::forget('mobile');
                return Redirect::to('home')->with('message', 'Welcome Dear');
            } else {
                return Redirect::to('login')->withErrors('Entered otp is wrong.');
            }
        } else {
            return Redirect::to('login')->withErrors('Something went wrong while checkOtp.');
        }
    }
}
