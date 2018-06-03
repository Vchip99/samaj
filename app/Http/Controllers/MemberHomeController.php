<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Validator,DB,Redirect,Auth,Cache;
use App\Libraries\InputSanitise;
use App\Models\User;

class MemberHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validateMobile = [
            'mobile' => 'required|regex:/[0-9]{10}/|digits:10',
        ];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginUser = Auth::user();
        $otherMembers = User::where('family_id', $loginUser->family_id)->where('id' ,'!=', $loginUser->id)->get();
        // dd($otherMembers);
        // $otherMembers = [];
        return view('layouts.home', compact('loginUser', 'otherMembers'));
    }

}
