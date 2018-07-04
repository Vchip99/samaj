<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Validator,DB,Redirect,Auth,Cache,Session;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Group;
use App\Models\SubGroup;
use App\Models\Position;
use App\Models\BusinessDetails;
use App\Models\GroupDescription;

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
        $members = User::where('is_marriage_candidate', 1)->where('married_status', 0)->orderBy('dob', 'desc')->get();
        $groom = User::where('is_marriage_candidate', 1)->where('married_status', 0)->where('gender', 'M')->count();
        $bride = User::where('is_marriage_candidate', 1)->where('married_status', 0)->where('gender', 'F')->count();
        $loginUser = Auth::user();
        return view('layouts.marriage', compact('members','groom','bride','loginUser'));
    }

    protected function groupMember(){
        $members = User::where('is_member', 1)->get();
        $groups = Group::all();
        $subgroups = [];
        $positions = Position::all();
        return view('layouts.group_member', compact('members', 'groups', 'positions', 'subgroups'));
    }

    protected function getSubGroupsByGroupId(Request $request){
        return SubGroup::getSubGroupsByGroupId($request);
    }

    protected function getPositionByGroupIdBySubGroupId(Request $request){
        return Position::getPositionByGroupIdBySubGroupId($request);
    }

    protected function associateGroup(Request $request){
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
            return Redirect::to('group-member')->with('message', 'Position associated to members successfully.');
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName', 'description'));
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName', 'description'));
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName', 'description'));
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName', 'description'));
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions', 'groupName', 'description'));
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName', 'description'));
    }


    protected function aadharSamity(Request $request){
        $result = $this->getGroupMembers(7,'group_7');
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName', 'description'));
    }

    protected function maheshwaryGroup8(Request $request){
        $result = $this->getGroupMembers(8,'group_8');
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName', 'description'));
    }

    protected function maheshwaryGroup9(Request $request){
        $result = $this->getGroupMembers(9,'group_9');
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
        $description = GroupDescription::find($groupId);
        return view('layouts.panchayat', compact('groupId','memberPositions', 'panchayatSubGroup', 'groupPositions','groupName', 'description'));
    }

    protected function getGroupMembers($groupId,$groupColumn){
        $members = User::where('is_member', 1)->whereNotNull($groupColumn)->get();
        $memberPositions = [];
        $panchayatSubGroup = [];
        $groupPositions = [];
        if(count($members) > 0){
            foreach($members as $member){
                if(!empty($member->$groupColumn)){
                    $arrExplode = explode('|', $member->$groupColumn);
                    if(isset($arrExplode[0]) && isset($arrExplode[1])){
                        $memberPositions[$arrExplode[0]][$arrExplode[1]][$member->id] = [
                            'id' => $member->id,
                            'name' => $member->f_name.' '.$member->l_name,
                            'photo' => $member->photo,
                        ];
                    }
                }
            }
        }
        if(2 == $groupId){
            $members = User::where('is_member', 1)->whereNotNull('app_formation')->get();
            if(count($members) > 0){
                foreach($members as $member){
                    if(!empty($member->app_formation)){
                        $arrExplode = explode('|', $member->app_formation);
                        if(isset($arrExplode[0]) && isset($arrExplode[1])){
                            $memberPositions[$arrExplode[0]][$arrExplode[1]][$member->id] = [
                                'id' => $member->id,
                                'name' => $member->f_name.' '.$member->l_name,
                                'photo' => $member->photo,
                            ];
                        }
                    }
                }
            }
        }
        ksort($memberPositions);
        $subgroups = SubGroup::where('group_id', $groupId)->get();
        if(is_object($subgroups) && false == $subgroups->isEmpty()){
            foreach($subgroups as $subgroup){
                $panchayatSubGroup[$subgroup->group_id][$subgroup->id] = $subgroup->name;
            }
        }

        $positions = Position::all();
        if(is_object($positions) && false == $positions->isEmpty()){
            foreach($positions as $position){
                $groupPositions[$position->id] = $position->name;
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
            '7' => 'group_7',
            '8' => 'group_8',
            '9' => 'group_9',
        ];
        $groupId = $request->get('group');
        $subgroupId = $request->get('subgroup');
        $positionId = $request->get('position');
        $groupColumn = $groups[$groupId];
        $positionMembers = [];
        if(12 == $subgroupId){
            $members = User::where('is_member', 1)->whereNotNull('app_formation')->get();
            if(count($members) > 0){
                foreach($members as $member){
                    if(!empty($member->app_formation)){
                        $arrExplode = explode('|', $member->app_formation);
                        if($subgroupId == $arrExplode[0] && $positionId == $arrExplode[1]){
                            $positionMembers[] = $member->id;
                        }
                    }
                }
            }
        } else {
            $members = User::where('is_member', 1)->whereNotNull($groupColumn)->get();
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
        }
        return $positionMembers;
    }
}
