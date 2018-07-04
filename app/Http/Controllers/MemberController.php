<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\BusinessDetails;
use App\Models\Job;
use App\Models\Suggestion;

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
    protected $validateMember = [
            'f_name' => 'required',
            'l_name' => 'required',
        ];
    protected $validateAdmin = [
            'f_name' => 'required',
            'l_name' => 'required',
            'mobile' => 'required|regex:/[0-9]{10}/|digits:10|unique:users',
            'is_member' => 'required',
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
        $v = Validator::make($request->all(), $this->validateMember);
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
        if(is_object($member) && (($loginUser->family_id == $member->family_id && 1 == $loginUser->is_admin) || (1 == $loginUser->is_super_admin))){
            return view('layouts.add_member', compact('member', 'loginUser'));
        }
        return Redirect::to('home');
    }

    /**
     * update member
     */
    protected function update( Request $request){

        $v = Validator::make($request->all(), $this->validateMember);
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
                if(1 == $member->is_admin && 1 == $member->is_member){
                    $familyMembers = User::getMembersByFamilyId($member->family_id);
                    if(is_object($familyMembers) && false == $familyMembers->isEmpty()){
                        foreach($familyMembers as $familyMember){
                            $path = 'user-documents/'.$familyMember->id;
                            InputSanitise::delFolder($path);
                            Job::deleteJobByMemberId($familyMember->id);
                            $familyMember->delete();
                        }
                        BusinessDetails::deleteBusinessByFamilyId($member->family_id);
                        DB::commit();
                        if(1 == $loginUser->is_super_admin){
                            return Redirect::to('home')->with('message', 'Member deleted successfully.');
                        } else {
                            Auth::guard()->logout();
                            $request->session()->invalidate();
                            return redirect('/');
                        }
                    }
                } else {
                    $path = 'user-documents/'.$member->id;
                    InputSanitise::delFolder($path);
                    $member->delete();
                    DB::commit();
                    if($loginUser->id != $memberId){
                        return Redirect::to('home')->with('message', 'Member deleted successfully.');
                    } else {
                        Auth::guard()->logout();
                        $request->session()->invalidate();
                        return redirect('/');
                    }
                }
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
        $members = User::where('is_member', 1)->get();
        $loginUser = Auth::user();
        return view('layouts.members', compact('members','loginUser'));
    }

    /**
     * todays Birtday
     */
    protected function todaysBirtday(){
        $members = User::where('is_member', 1)->whereDay('dob', date('d'))->whereMonth('dob', date('m'))->get();
        return view('layouts.todays_birtday', compact('members'));
    }

    /**
     * show member
     */
    protected function showMember($id){
        $memberId = json_decode($id);
        $member = User::find($memberId);
        if(is_object($member)){
            // $previousUrl = array_reverse(explode('/', url()->previous()))[0];
            $previousUrl = url()->previous();
            $familyMembers = User::getMembersByFamilyId($member->family_id);
            $familyBusinesses = BusinessDetails::getBusinessByFamilyId($member->family_id);
            return view('layouts.show_member', compact('member', 'previousUrl', 'familyMembers', 'familyBusinesses'));
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

    /**
     * search marriage member
     */
    protected function searchMarriageMember(Request $request){
        return User::searchMarriageMember($request);
    }

    protected function searchMemberByProfession(Request $request){
        return User::searchMemberByProfession($request);
    }

    protected function searchMarriageMemberByGender(Request $request){
        return User::searchMarriageMemberByGender($request);
    }

    protected function createAdmin(){
        return view('layouts.create_admin');
    }

    protected function storeAdmin(Request $request){
        $v = Validator::make($request->all(), $this->validateAdmin);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }
        $fName = $request->get('f_name');
        $lName = $request->get('l_name');
        $mobile = $request->get('mobile');
        $isMember = $request->get('is_member');
        DB::beginTransaction();
        try
        {
            if(1 == $isMember){
                $nextAdminFamilyId = User::getNextAdminFamilyId();
            } else {
                $nextAdminFamilyId = 0;
            }
            $user = User::create([
                'f_name' => $fName,
                'l_name' => $lName,
                'mobile' => $mobile,
                'is_admin' => 1,
                'is_super_admin' => 0,
                'is_member' => $isMember,
                'family_id' => $nextAdminFamilyId,
                'is_contact_private' => 0,
                'dob' => '1947-08-15',
                'admin_relation' => 'Admin',
            ]);
            if(is_object($user)){
                DB::commit();
                return Redirect::to('create-admin')->with('message', 'Admin created successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong.');
        }
        return Redirect::to('create-admin');
    }

    protected function createSuggestion(){
        return view('layouts.create_suggestion');
    }

    protected function storeSuggestion(Request $request){
        DB::beginTransaction();
        try
        {
            $suggestion = Suggestion::addContact($request);
            if(is_object($suggestion)){
                DB::commit();
                return Redirect::to('create-suggestion')->with('message', 'Suggestion created successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors($e->message());
        }
        return Redirect::to('create-suggestion');
    }

    protected function suggestions(){
        $suggestions = Suggestion::join('users', 'users.id', '=', 'suggestions.member_id')->select('suggestions.*','users.f_name','users.l_name', 'users.mobile')->orderBy('suggestions.id', 'desc')->get();
        return view('layouts.suggestions', compact('suggestions'));
    }

    protected function deleteSuggestion(Request $request){
        $id = json_decode($request->get('suggestion_id'));
        DB::beginTransaction();
        try
        {
            $suggestion = Suggestion::find($id);
            if(is_object($suggestion)){
                $suggestion->delete();
                DB::commit();
                return Redirect::to('suggestions')->with('message', 'Suggestion deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong.');
        }
        return Redirect::to('suggestions');
    }

}