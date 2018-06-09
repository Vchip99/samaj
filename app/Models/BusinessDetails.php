<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Libraries\InputSanitise;
use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;
use Auth,File,Redirect;

class BusinessDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_category_id','business_sub_category_id','name','email','phone','website','logo','address','description','facebook','linkedin','youtube','google','google_location','family_id'
    ];

    protected static function AddOrUpdateBusinessDetails(Request $request, $isUpdate=false){
        $businessCategoryId = $request->get('business_category');
        $businessSubCategoryId = $request->get('business_sub_category');
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
        $googleLocation =  $request->get('google_location');
        $familyId = Auth::user()->family_id;
        $businessId =  $request->get('business_id');

        if($isUpdate && $businessId > 0){
            $business = static::find($businessId);
            if(!is_object($business)){
                return false;
            }
        } else {
            $business = new static;
        }

        $business->business_category_id = $businessCategoryId;
        $business->business_sub_category_id = $businessSubCategoryId;
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
        $business->family_id = $familyId;
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
        $businessCategoryId = $request->get('business_category');
    	$result = static::join('business_categories', 'business_categories.id', '=', 'business_details.business_category_id')->where('business_details.name', 'like', '%'.$name.'%');
        if($businessCategoryId > 0){
            $result->where('business_details.business_category_id', $businessCategoryId);
        }
        return $result->select('business_details.id','business_details.logo','business_details.name', 'business_categories.name as category_name')->get();
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

    public function businessCategory(){
        return $this->belongsTo(BusinessCategory::class, 'business_category_id');
    }
    public function businessSubcategory(){
        return $this->belongsTo(BusinessSubCategory::class, 'business_sub_category_id');
    }
}