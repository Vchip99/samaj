<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Libraries\InputSanitise;
use Auth,File,Redirect;

class BusinessDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_category','other_business','name','email','phone','website','logo','address','description','facebook','linkedin','youtube','google','google_location','family_id'
    ];

    protected static function AddOrUpdateBusinessDetails(Request $request, $isUpdate=false){
        $businessCategoryId = $request->get('business_category');
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $website =  $request->get('website');
        $address =  $request->get('address');
        $description =  $request->get('description');
        $facebook =  $request->get('facebook');
        $linkedin =  $request->get('linkedin');
        $youtube =  $request->get('youtube');
        $google =  $request->get('google');
        $otherBusiness =  $request->get('other_business');
        $googleLocation =  $request->get('google_location');
        $businessId =  $request->get('business_id');
        $loginUser = Auth::user();
        $familyId = $loginUser->family_id;

        if($isUpdate && $businessId > 0){
            $business = static::find($businessId);
            if(!is_object($business)){
                return false;
            }
        } else {
            $business = new static;
        }

        $business->business_category = $businessCategoryId;
        if('Other' == $businessCategoryId){
            $business->other_business = $otherBusiness;
        } else {
            $business->other_business = ' ';
        }
        $business->name = $name;
        $business->email = $email;
        $business->phone = $phone;
        $business->website = $website;
        $business->address = $address;
        $business->description = $description;
        $business->facebook = $facebook;
        $business->linkedin = $linkedin;
        $business->youtube = $youtube;
        $business->google = $google;
        $business->google_location = $googleLocation;
        if(1 == $loginUser->is_super_admin){
            if( true == $isUpdate && $businessId > 0){
                $business->family_id = $business->family_id;
            } else {
                $business->family_id = $familyId;
            }
        } else {
            $business->family_id = $familyId;
        }
        $business->save();

        if($request->exists('logo')){
	        $path = 'business-logo/'.$business->id;
	        if(!is_dir($path)){
	            File::makeDirectory($path, $mode = 0777, true, true);
	        }

            if($isUpdate && $businessId > 0){
                if(!empty($business->logo) && is_file($business->logo)){
                    unlink($business->logo);
                }
            }
            $applicantPhoto = str_replace(' ', '_', $request->file('logo')->getClientOriginalName());
            $request->file('logo')->move($path, $applicantPhoto);
            $business->logo = $path."/".$applicantPhoto;
            $business->save();
        }
        return $business;
    }

    protected static function searchBusiness($request){
    	$name = $request->get('business');
        $category = $request->get('business_category');
    	$result = static::where('name', 'like', '%'.$name.'%');
        if('All' != $category && !empty($category)){
            $result->where('business_category', $category);
        }
        return $result->select('id','logo','name', 'business_category', 'other_business')->get();
    }

    protected static function deleteBusinessByFamilyId($familyId){
        $businesses = static::where('family_id', $familyId)->get();
        if(is_object($businesses) && false == $businesses->isEMpty()){
            foreach($businesses as $business){
                $path = 'business-logo/'.$business->id;
                InputSanitise::delFolder($path);
                $business->delete();
            }
        }
        return;
    }

    protected static function getBusinessByFamilyId($familyId){
        return static::where('family_id', $familyId)->get();
    }

    /**
     *
     */
    protected static function getBusinessByCategory($category){
        if('All' != $category && !empty($category)){
            return static::where('business_category', $category)->get();
        } else{
            return static::select('id','logo','name', 'business_category', 'other_business')->get();
        }
    }
}