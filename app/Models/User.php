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
        'f_name', 'm_name', 'l_name', 'user_id', 'email', 'mobile', 'is_admin', 'family_id', 'is_contact_private', 'password', 'land_line_no', 'fax', 'dob', 'gender', 'photo','married_status', 'spouse', 'is_marriage_candidate', 'bio_data', 'blood_group', 'education','website', 'address', 'state', 'city', 'pin', 'admin_relation', 'anniversary', 'facebook_profile', 'google_profile', 'linkedin_profile'
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
        $lastAdminUser = static::where('is_admin', 1)->orderBy('id', 'desc')->first();
        if(is_object($lastAdminUser)){
            return $lastAdminUser->family_id++;
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
        $fName = $request->get('f_name');
        $mName = $request->get('m_name');
        $lName = $request->get('l_name');
        $userId = $request->get('user_id');
        $email = $request->get('email');
        $mobile = $request->get('mobile');

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
        $occupation =  $request->get('occupation');
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
        }

        $member->f_name = $fName;
        $member->m_name = $mName;
        $member->l_name = $lName;
        $member->mobile = $mobile;
        if(false == $isUpdate && empty($memberId)){
            $member->email = $email;
            $member->user_id =$userId;
            $member->is_admin = 0;
            $member->password = bcrypt($password);
        }
        $member->family_id = $familyId;
        $member->is_contact_private = (empty($isContactPrivate))?0:$isContactPrivate;
        $member->land_line_no = $landLineNo;
        $member->fax = $fax;
        $member->dob = $dob;
        $member->gender = $gender;
        $member->married_status = $marriedStatus;
        $member->spouse = $spouse;
        $member->is_marriage_candidate = $isMarriageCandidate;
        $member->blood_group = $bloodGroup;
        $member->education = $education;
        $member->occupation = $occupation;
        $member->website = $website;
        if(1 == $isSameAddress){
            $member->address = $loginUser->address;
            $member->state = $loginUser->state;
            $member->city = $loginUser->city;
            $member->pin = $loginUser->pin;
        } else {
            $member->address = $address;
            $member->state = $state;
            $member->city = $city;
            $member->pin = $pin;
        }
        $member->admin_relation = $adminRelation;
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
        if($request->exists('photo') || $request->exists('photo')){
            $member->save();
        }
        return $member;
    }

    /**
     * get members by family id
     */
    protected static function getMembersByFamilyId($familyId){
        return static::where('family_id', $familyId)->get();
    }

}
