<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect;
use App\Models\User;

class MemberController extends Controller
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
    protected $validateRegistration = [
            'f_name' => 'required',
            'm_name' => 'required',
            'l_name' => 'required',
            'user_id' => 'required|unique:users',
            'email' => 'sometimes|nullable|email|unique:users',
            'mobile' => 'required|regex:/[0-9]{10}/',
            'is_contact_private' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];

    /**
     * add member
     */
    protected function create(){
        return view('layouts.add_member');
    }

    /**
     * store member
     */
    protected function store( Request $request){
        // dd($request->all());
        $v = Validator::make($request->all(), $this->validateRegistration);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $member = User::addMember($request);
            if(is_object($member)){
                DB::commit();
                return Redirect::to('add-member')->with('message', 'New member added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong.');
        }
        return Redirect::to('add-member');
    }
}
