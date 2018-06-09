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
use App\Models\BusinessDetails;

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
        $otherMembers = User::where('is_member', 1)->where('family_id', $loginUser->family_id)->where('id' ,'!=', $loginUser->id)->get();
        $businesses = BusinessDetails::where('family_id', $loginUser->family_id)->get();
        return view('layouts.home', compact('loginUser', 'otherMembers', 'businesses'));
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
        if(empty($request->get('members'))){
            return back()->withErrors('Please select member');
        }
        if(empty($request->get('group'))){
            return back()->withErrors('Please select group');
        }
        if(empty($request->get('subgroup'))){
            return back()->withErrors('Please select subgroup');
        }
        if(empty($request->get('position'))){
            return back()->withErrors('Please select position');
        }
        DB::beginTransaction();
        try
        {
            User::associateGroupToMember($request);
            DB::commit();
            return Redirect::to('group-member')->with('message', 'Position associated to member successfully.');
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong.');
        }
    }

    protected function panchayat(Request $request){
        $result = $this->getGroupMembers(1,'group_1');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName'));
    }

    protected function navyuvakMandal(Request $request){
        $result = $this->getGroupMembers(2,'group_2');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName'));
    }

    protected function mahilaMandal(Request $request){
        $result = $this->getGroupMembers(3,'group_3');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName'));
    }

    protected function varishthNagrik(Request $request){
        $result = $this->getGroupMembers(4,'group_4');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName'));
    }

    protected function jilhaSangathan(Request $request){
        $result = $this->getGroupMembers(5,'group_5');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName'));
    }

    protected function sevaManch(Request $request){
        $result = $this->getGroupMembers(6,'group_6');
        $groupId = $result['groupId'];
        $groupObj = Group::where('id',$groupId)->first();
        if(is_object($groupObj)){
            $groupName = $groupObj->name;
        } else {
            $groupName = '';
        }
        $memberPositions = $result['memberPositions'];
        $panchayatSubGroup = $result['panchayatSubGroup'];
        $groupPositions = $result['groupPositions'];
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName'));
    }

    protected function getGroupMembers($groupId,$groupColumn){
        $members = User::where('is_member', 1)->whereNotNull($groupColumn)->get();
        $levels = [];
        $memberPositions = [];
        $panchayatSubGroup = [];
        $groupPositions = [];
        if(count($members) > 0){
            foreach($members as $member){
                if(!empty($member->$groupColumn)){
                    $arrExplode = explode('|', $member->$groupColumn);
                    $levels[$arrExplode[0]][] = $arrExplode[1];
                    $memberPositions[$arrExplode[1]][$member->id] = [
                        'id' => $member->id,
                        'name' => $member->f_name.' '.$member->l_name,
                        'photo' => $member->photo,
                    ];
                }
            }
        }
        if(count($levels) > 0){
            $subgroups = SubGroup::whereIn('id', array_keys($levels))->get();
            if(is_object($subgroups) && false == $subgroups->isEmpty()){
                foreach($subgroups as $subgroup){
                    $panchayatSubGroup[$subgroup->group_id][$subgroup->id] = $subgroup->name;
                }
            }
            $positions = Position::whereIn('sub_group_id', array_keys($panchayatSubGroup[$groupId]))->get();
            if(is_object($positions) && false == $positions->isEmpty()){
                foreach($positions as $position){
                    $groupPositions[$position->group_id][$position->sub_group_id][$position->id] = $position->name;
                }
            }
        }
        $result['groupId'] = $groupId;
        $result['memberPositions'] = $memberPositions;
        $result['panchayatSubGroup'] = $panchayatSubGroup;
        $result['groupPositions'] = $groupPositions;
        return $result;
    }

    protected function getGroupMemberById(Request $request){
        $groups = [
            '1' => 'group_1',
            '2' => 'group_2',
            '3' => 'group_3',
            '4' => 'group_4',
            '5' => 'group_5',
            '6' => 'group_6',
        ];
        $groupId = $request->get('group');
        $subgroupId = $request->get('subgroup');
        $positionId = $request->get('position');
        $groupColumn = $groups[$groupId];
        $members = User::where('is_member', 1)->whereNotNull($groupColumn)->get();
        $positionMembers = [];
        if(count($members) > 0){
            foreach($members as $member){
                if(!empty($member->$groupColumn)){
                    $arrExplode = explode('|', $member->$groupColumn);
                    if($subgroupId == $arrExplode[0] && $positionId == $arrExplode[1]){
                        $positionMembers[] = $member->id;
                    }
                }
            }
        }
        return $positionMembers;
    }
}
