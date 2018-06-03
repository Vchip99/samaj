<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Cache;
use App\Models\User;

class MessageController extends Controller
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
     * send opt
     *
     * @return send otp
     */
    public function sendOtp($mobile)
    {
        // Account details
        $apiKey = urlencode(config('custom.sms_key'));
        // Message details
        $mobileNo = '91'.$mobile;
        $numbers = array($mobileNo);
        $sender = urlencode('TXTLCL');
        $otp = rand(100000, 999999);
        // dd($otp);
        $userMessage = 'Your OTP: '.$otp;
        Cache::put($mobile, $otp, 5);
        Cache::put('mobile', $mobile, 5);
        $message = rawurlencode($userMessage);
        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }



}
