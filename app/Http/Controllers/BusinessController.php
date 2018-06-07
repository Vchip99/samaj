<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\BusinessDetails;
use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;

class BusinessController extends Controller
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
    protected $validateBusiness = [
            'business_category' => 'required',
            'name' => 'required',
        ];

    /**
     * show business
     */
    protected function show(){
        $businesses = BusinessDetails::all();
        return view('business.list', compact('businesses'));
    }

    /**
     * add business
     */
    protected function create(){
        $business = new BusinessDetails;
        $businessCategories = BusinessCategory::all();
        $subCategories = [];
        return view('business.create', compact('businessCategories', 'business', 'subCategories'));
    }

    /**
     * store business
     */
    protected function store( Request $request){
        $v = Validator::make($request->all(), $this->validateBusiness);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $business = BusinessDetails::AddOrUpdateBusinessDetails($request);
            if(is_object($business)){
                DB::commit();
                return Redirect::to('add-business')->with('message', 'New Business added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for create business.');
        }
        return Redirect::to('add-business');
    }

    /**
     * edit business
     */
    protected function edit($id){
        $business = BusinessDetails::find(json_decode($id));
        if(is_object($business) ){
            $businessCategories = BusinessCategory::all();
            if($business->business_sub_category_id > 0){
                $subCategories = BusinessSubCategory::getSubCategoryByCategoryId($business->business_category_id);
            } else {
                $subCategories = [];
            }
            return view('business.create', compact('businessCategories', 'business', 'subCategories'));
        }

        return Redirect::to('add-business');
    }

    /**
     * update business
     */
    protected function update( Request $request){ //dd($request->all());
        $v = Validator::make($request->all(), $this->validateBusiness);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $business = BusinessDetails::AddOrUpdateBusinessDetails($request, true);
            if(is_object($business)){
                DB::commit();
                return Redirect::to('add-business')->with('message', 'Business updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for update business');
        }
        return Redirect::to('add-business');
    }

    /**
     * delete business
     */
    protected function delete(Request $request){
        $business = BusinessDetails::find(json_decode($request->get('business_id')));
        DB::beginTransaction();
        try
        {
            if(is_object($business)){
                    $path = 'business-photo/'.$business->id;
                    InputSanitise::delFolder($path);
                    $business->delete();
                    DB::commit();
                    return Redirect::to('add-business')->with('message', 'Business deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for delete business.');
        }
        return Redirect::to('add-business');
    }

    /**
     * sub category
     */
    protected function getSubCategoryByCategoryId(Request $request){
        $categoryId = $request->get('category_id');
        return BusinessSubCategory::getSubCategoryByCategoryId($categoryId);
    }

    /**
     * show business
     */
    protected function showAllBusiness(){
        $businesses = BusinessDetails::all();
        $businessCategories = BusinessCategory::all();
        return view('business.search', compact('businesses', 'businessCategories'));
    }

    /**
     * search business
     */
    protected function searchBusiness(Request $request){
        return BusinessDetails::searchBusiness($request);
    }

    /**
     * show business
     */
    protected function showBusiness($id){
        $business = BusinessDetails::find(json_decode($id));
        if(is_object($business)){
            $businessCategories = BusinessCategory::all();
            if($business->business_sub_category_id > 0){
                $subCategories = BusinessSubCategory::getSubCategoryByCategoryId($business->business_category_id);
            } else {
                $subCategories = [];
            }
            return view('business.show_business', compact('businessCategories', 'business', 'subCategories'));
        }
        return Redirect::to('search-business');
    }
}
