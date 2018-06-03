<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
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
            'mobile' => 'required|regex:/[0-9]{10}/|digits:10',
        ];
    protected $validateUpdateRegistration = [
            'mobile' => 'required|regex:/[0-9]{10}/|digits:10',
        ];

    /**
     * add member
     */
    protected function create(){
        $member = new User;
        $loginUser = Auth::user();
        return view('layouts.add_member', compact('member', 'loginUser'));
    }

    /**
     * store member
     */
    protected function store( Request $request){
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
            return back()->withErrors('something went wrong for store member.');
        }
        return Redirect::to('add-member');
    }

    /**
     * edit member
     */
    protected function edit($id){
        $memberId = json_decode($id);
        $member = User::find($memberId);
        $loginUser = Auth::user();
        if(is_object($member) && ($loginUser->id == $member->id || $loginUser->family_id == $member->family_id )){
            return view('layouts.add_member', compact('member', 'loginUser'));
        }
        return Redirect::to('home');
    }

    /**
     * update member
     */
    protected function update( Request $request){
        $v = Validator::make($request->all(), $this->validateUpdateRegistration);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $member = User::addMember($request, true);
            if(is_object($member)){
                DB::commit();
                return Redirect::to('home')->with('message', 'Member updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for update member');
        }
        return Redirect::to('home');
    }

    /**
     * delete member
     */
    protected function delete(Request $request){
        $memberId = json_decode($request->get('member_id'));
        $member = User::find($memberId);
        $loginUser = Auth::user();
        DB::beginTransaction();
        try
        {
            if(is_object($member)){
                // if(1 == $member->is_admin){
                //     $familyMembers = User::getMembersByFamilyId($member->family_id);
                //     if(is_object($familyMembers) && false == $familyMembers->isEmpty()){
                //         foreach($familyMembers as $familyMember){
                //             $path = 'user-documents/'.$familyMember->id;
                //             InputSanitise::delFolder($path);
                //             $familyMember->delete();
                //         }
                //         DB::commit();
                //         Auth::guard()->logout();
                //         $request->session()->invalidate();
                //         return redirect('/');
                //     }
                // } else {
                    $path = 'user-documents/'.$member->id;
                    InputSanitise::delFolder($path);
                    $member->delete();
                    DB::commit();
                    if($loginUser != $memberId){
                        return Redirect::to('home')->with('message', 'Member deleted successfully.');
                    } else {
                        Auth::guard()->logout();
                        $request->session()->invalidate();
                        return redirect('/');
                    }
                // }
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for delete member.');
        }
        return Redirect::to('home');
    }

    /**
     * all members
     */
    protected function members(){
        $members = User::where('id', '!=', Auth::user()->id)->get();
        return view('layouts.members', compact('members'));
    }

    /**
     * show member
     */
    protected function showMember($id){
        $memberId = json_decode($id);
        $member = User::find($memberId);
        if(is_object($member)){
            return view('layouts.show_member', compact('member'));
        }
        return Redirect::to('home');
    }

    /**
     * search member
     */
    protected function searchMember(Request $request){
        return User::searchMember($request);
    }

    /**
     * show change admin ui
     */
    protected function showChangeAdmin(){
        $loginUser = Auth::user();
        $members = User::getMembersByFamilyId($loginUser->family_id);
        return view('layouts.change_admin', compact('members', 'loginUser'));
    }

    /**
     * change admin
     */
    protected function changeAdmin(Request $request){
        DB::beginTransaction();
        try
        {
            User::changeAdmin($request);
            DB::commit();
            return Redirect::to('home')->with('message', 'Admin changed successfully.');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong.');
        }
        return Redirect::to('home');
    }

    /**
     * show blood group members
     */
    protected function showBloodGroup(){
        $members = User::where('blood_group', '=', 'A+')->get();
        return view('layouts.show_blood_group', compact('members'));
    }

    /**
     * search blood
     */
    protected function searchBlood(Request $request){
        return User::searchBlood($request);
    }

}
