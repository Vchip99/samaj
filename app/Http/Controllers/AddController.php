<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Add;

class AddController extends Controller
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
    protected $validateAdd = [
            'start_date' => 'required',
            'end_date' => 'required',
        ];

    /**
     * show adds
     */
    protected function show(){
        $adds = Add::orderBy('id', 'desc')->get();
        return view('adds.list', compact('adds'));
    }

    /**
     * add add
     */
    protected function create(){
        $add = new Add;
        return view('adds.create', compact('add'));
    }

    /**
     * store add
     */
    protected function store( Request $request){
        $v = Validator::make($request->all(), $this->validateAdd);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $add = Add::AddOrUpdateAdd($request);
            if(is_object($add)){
                DB::commit();
                return Redirect::to('show-ad')->with('message', 'New ad created successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while create ad.');
        }
        return Redirect::to('show-ad');
    }

    /**
     * edit ad
     */
    protected function edit($id){
        $loginUser = Auth::user();
        $add = Add::find(json_decode($id));
        if(is_object($add)  && 1 == $loginUser->is_super_admin){
            return view('adds.create', compact('add'));
        }
        return Redirect::to('show-ad');
    }

    /**
     * update ad
     */
    protected function update( Request $request){
        $v = Validator::make($request->all(), $this->validateAdd);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $add = Add::AddOrUpdateAdd($request, true);
            if(is_object($add)){
                DB::commit();
                return Redirect::to('show-ad')->with('message', 'Ad updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while update Ad');
        }
        return Redirect::to('show-ad');
    }

    /**
     * delete ad
     */
    protected function delete(Request $request){
        $add = Add::find(json_decode($request->get('add_id')));
        DB::beginTransaction();
        try
        {
            if(is_object($add)){
                    $path = 'ads/'.$add->id;
                    InputSanitise::delFolder($path);
                    $add->delete();
                    DB::commit();
                    return Redirect::to('show-ad')->with('message', 'Ad deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while delete ad.');
        }
        return Redirect::to('show-ad');
    }

    /**
     * category
     */
    protected function getBusinessByCategory(Request $request){
        $category = $request->get('category');
        return BusinessDetails::getBusinessByCategory($category);
    }

    /**
     * show business
     */
    protected function showAllBusiness(){
        $businesses = BusinessDetails::all();
        $loginUser = Auth::user();
        return view('business.search', compact('businesses', 'loginUser'));
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
            $previousUrl = url()->previous();
            $familyMembers = User::getMembersByFamilyId($business->family_id);
            return view('business.show_business', compact('business', 'previousUrl', 'familyMembers'));
        }
        return Redirect::to('search-business');
    }
}
