<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Auth,File;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gotra','f_name', 'm_name', 'l_name', 'user_id', 'email', 'mobile', 'is_admin', 'is_super_admin', 'is_member', 'family_id', 'is_contact_private', 'land_line_no', 'fax', 'dob', 'gender', 'photo','married_status', 'spouse', 'is_marriage_candidate', 'bio_data', 'kundali', 'blood_group', 'education','profession', 'other_profession', 'designation','website', 'address', 'state', 'city', 'pin', 'admin_relation', 'anniversary','group_1','group_2','group_3','group_4','group_5','group_6', 'facebook_profile', 'google_profile', 'linkedin_profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * get next admin family id
     */
    protected static function getNextAdminFamilyId(){
        $lastAdminUser = static::where('is_admin', 1)->where('is_member', 1)->orderBy('id', 'desc')->first();
        if(is_object($lastAdminUser)){
            return $lastAdminUser->family_id + 1;
        } else {
            return '1';
        }
    }

    protected static function validateEmailAndUserId(Request $request){
        $email = $request->get('email');
        $userId = $request->get('user_id');
        $result = static::where('user_id', $userId)->orWhere('email', $userId);
        if(!empty($email)){
            $result->orWhere('email', $email)->orWhere('user_id', $email);
        }
        return $result->get();
    }

    protected static function addMember(Request $request, $isUpdate=false){
        $otherInputs = $request->except('_token', 'is_contact_private', 'married_status', 'is_marriage_candidate', 'is_same_address', 'gender');
        $inputCount = 0;
        foreach($otherInputs as $otherInput){
            if(!empty($otherInput)){
                $inputCount = $inputCount + 1;
            }
        }
        if( 0 == $inputCount){
            return false;
        }
        $fName = $request->get('f_name');
        $mName = $request->get('m_name');
        $lName = $request->get('l_name');
        $userId = $request->get('user_id');
        $email = $request->get('email');
        $mobile = $request->get('mobile');
        $gotra = $request->get('gotra');
        $isContactPrivate = $request->get('is_contact_private');
        $password = $request->get('password');
        $landLineNo = $request->get('land_line_no');
        $fax =  $request->get('fax');
        $dob =  $request->get('dob');
        $gender =  $request->get('gender');
        $marriedStatus =  $request->get('married_status');
        $spouse =  $request->get('spouse');
        $isMarriageCandidate =  $request->get('is_marriage_candidate');
        $bloodGroup =  $request->get('blood_group');
        $education =  $request->get('education');
        $profession =  $request->get('profession');
        $otherProfession =  $request->get('other_profession');
        $designation =  $request->get('designation');
        $website =  $request->get('website');
        $address =  $request->get('address');
        $state =  $request->get('state');
        $city =  $request->get('city');
        $pin =  $request->get('pin');
        $anniversary =  $request->get('anniversary');
        $facebookProfile =  $request->get('facebook_profile');
        $googleProfile =  $request->get('google_profile');
        $linkedinProfile =  $request->get('linkedin_profile');
        $adminRelation =  $request->get('admin_relation');
        $isSameAddress =  $request->get('is_same_address');
        $loginUser = Auth::user();
        $familyId = $loginUser->family_id;
        $memberId =  $request->get('member_id');

        if($isUpdate && $memberId > 0){
            $member = static::find($memberId);
            if(!is_object($member)){
                return Redirect::to('home')->withErrors('something went wrong.');
            }
        } else {
            $member = new static;
            $member->is_admin = 0;
            $member->is_member = 1;
        }

        $member->gotra = $gotra;
        $member->f_name = $fName;
        $member->m_name = $mName;
        $member->l_name = $lName;
        $member->email = $email;

        if( 0 ==$member->is_admin ){
            $member->admin_relation = $adminRelation;
            $member->mobile = $mobile;
        }
        $member->is_super_admin = 0;
        $member->family_id = $familyId;
        $member->is_contact_private = (empty($isContactPrivate))?0:$isContactPrivate;
        $member->land_line_no = $landLineNo;
        $member->fax = $fax;
        $member->dob = $dob;
        $member->gender = $gender;
        if( 1 ==$member->is_member && !empty($marriedStatus)){
            $member->married_status = $marriedStatus;
        }
        $member->spouse = $spouse;
        if( 1 ==$member->is_member && !empty($isMarriageCandidate)){
            $member->is_marriage_candidate = $isMarriageCandidate;
        }
        $member->blood_group = $bloodGroup;
        $member->education = $education;
        $member->profession = $profession;
        $member->other_profession = $otherProfession;
        $member->designation = $designation;
        $member->website = $website;
        if(1 == $isSameAddress){
            $member->address = $loginUser->address;
            $member->state = $loginUser->state;
            $member->city = $loginUser->city;
            $member->pin = $loginUser->pin;
        } else {
            $member->address = $address;
            $member->state = 'Maharashtra';
            if( 1 ==$member->is_member){
                $member->city = 'Amravati';
            } else {
                $member->city = $city;
            }
            $member->pin = $pin;
        }
        $member->anniversary = $anniversary;
        $member->facebook_profile = $facebookProfile;
        $member->google_profile = $googleProfile;
        $member->linkedin_profile = $linkedinProfile;
        $member->save();

        $path = 'user-documents/'.$member->id;
        if(!is_dir($path)){
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if($request->exists('photo')){
            if($isUpdate && $memberId > 0){
                if(!empty($member->photo) && is_file($member->photo)){
                    unlink($member->photo);
                }
            }
            $applicantPhoto = str_replace(' ', '_', $request->file('photo')->getClientOriginalName());
            $request->file('photo')->move($path, $applicantPhoto);
            $member->photo = $path."/".$applicantPhoto;
        }
        if($request->exists('bio_data')){
            if($isUpdate && $memberId > 0){
                if(!empty($member->bio_data) && is_file($member->bio_data)){
                    unlink($member->bio_data);
                }
            }
            $applicantBioData = str_replace(' ', '_', $request->file('bio_data')->getClientOriginalName());
            $request->file('bio_data')->move($path, $applicantBioData);
            $member->bio_data = $path."/".$applicantBioData;
        }
        if($request->exists('kundali')){
            if($isUpdate && $memberId > 0){
                if(!empty($member->kundali) && is_file($member->kundali)){
                    unlink($member->kundali);
                }
            }
            $applicantKundali = str_replace(' ', '_', $request->file('kundali')->getClientOriginalName());
            $request->file('kundali')->move($path, $applicantKundali);
            $member->kundali = $path."/".$applicantKundali;
        }
        if($request->exists('photo') || $request->exists('photo') || $request->exists('kundali')){
            $member->save();
        }
        return $member;
    }

    /**
     * get members by family id
     */
    protected static function getMembersByFamilyId($familyId){
        return static::where('family_id', $familyId)->where('is_member', 1)->get();
    }

    /**
     * search member
     */
    protected static function searchMember(Request $request){
        $profession = $request->get('profession');
        $member = $request->get('member');
        $result = static::where(function ($query) use ($member) {
                            $query->where('f_name', 'like', '%'.$member.'%')
                                  ->orWhere('l_name', 'like', '%'.$member.'%');
                        });
        if(!empty($profession) && 'All' != $profession){
            $result->where('profession', $profession);
        }
        return $result->where('is_member', 1)->get();
    }

    /**
     * search marriage member
     */
    protected static function searchMarriageMember(Request $request){
        $gender = $request->get('gender');
        $member = $request->get('member');
        $result = static::where('is_marriage_candidate', 1);
        if(!empty($gender) && 'All' != $gender){
            $result->where('gender', $gender);
        }
        return $result->where(function ($query) use ($member) {
                $query->where('f_name', 'like', '%'.$member.'%')
                      ->orWhere('l_name', 'like', '%'.$member.'%');
            })->select('id', 'f_name','l_name','photo')->get();
    }

    protected static function changeAdmin(Request $request){
        $otherMembers = $request->except('_token');
        if(count($otherMembers) > 0){
            foreach($otherMembers as  $memberId => $relation){
                $member = static::find($memberId);
                if('Admin' == $relation){
                    $member->is_admin = 1;
                } else {
                    $member->is_admin = 0;
                }
                $member->admin_relation = $relation;
                $member->save();
            }
        }
        return;
    }

    /**
     * search blood
     */
    protected static function searchBlood(Request $request){
        $bloodgroup = $request->blood_group;
        return static::where('blood_group', $bloodgroup)->where('is_member', 1)->get();
    }

    protected static function associateGroupToMember($request){
        $group = $request->get('group');
        $subgroup = $request->get('subgroup');
        $position = $request->get('position');
        $memberIds = $request->get('members');
        foreach($memberIds as $memberId) {
            $user = static::find($memberId);
            if(1 == $group){
                $user->group_1 = $subgroup.'|'.$position;
            } else if(2 == $group){
                $user->group_2 = $subgroup.'|'.$position;
            } else if(3 == $group){
                $user->group_3 = $subgroup.'|'.$position;
            } else if(4 == $group){
                $user->group_4 = $subgroup.'|'.$position;
            } else if(5 == $group){
                $user->group_5 = $subgroup.'|'.$position;
            } else if(6 == $group){
                $user->group_6 = $subgroup.'|'.$position;
            }
            $user->save();
        }
        return;
    }

}
