<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Validator,DB,Redirect,Auth,Cache;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Position;

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
        // Auth::onceUsingId(4);
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
        $otherMembers = User::where('is_member', 1)->where('family_id', $loginUser->family_id)->where('id' ,'!=', $loginUser->id)->get();
        return view('layouts.home', compact('loginUser', 'otherMembers'));
    }

    /**
     * show marriage members
     */
    protected function marriage(){
        $members = User::where('is_marriage_candidate', 1)->get();
        return view('layouts.marriage', compact('members'));
    }

    protected function groupMember(){
        $members = User::where('is_member', 1)->where('id', '!=', Auth::user()->id)->get();
        $groups = Group::all();
        return view('layouts.group_member', compact('members', 'groups'));
    }

    protected function getSubGroupsByGroupId(Request $request){
        return SubGroup::getSubGroupsByGroupId($request);
    }

    protected function getPositionByGroupIdBySubGroupId(Request $request){
        return Position::getPositionByGroupIdBySubGroupId($request);
    }

    protected function associateGroup(Request $request){
        // dd($request->all());
        if(empty($request->get('members'))){
            return back()->withErrors('Please select member');
        }
        User::associateGroupToMember($request);
        return Redirect::to('group-member')->with('message', 'Position associated to member successfully.');
    }
}
