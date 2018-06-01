<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginUser = Auth::user();
        $otherMembers = User::where('family_id', $loginUser->family_id)->where('id' ,'!=', $loginUser->id)->get();
        return view('layouts.home', compact('loginUser', 'otherMembers'));
    }

}
