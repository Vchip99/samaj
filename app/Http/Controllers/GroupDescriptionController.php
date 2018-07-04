<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\GroupDescription;
use App\Models\Group;

class GroupDescriptionController extends Controller
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
    protected $validateGroupDescription = [
            'group_id' => 'required',
            'description' => 'required',
        ];

    /**
     * show description
     */
    protected function show(){
        $descriptions = GroupDescription::all();
        return view('description.list', compact('descriptions'));
    }

    /**
     * add description
     */
    protected function create(){
        $description = new GroupDescription;
        $groups = Group::all();
        return view('description.create', compact('description', 'groups'));
    }

    /**
     * store description
     */
    protected function store( Request $request){
        $v = Validator::make($request->all(), $this->validateGroupDescription);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $description = GroupDescription::AddOrUpdateGroupDescription($request);
            if(is_object($description)){
                DB::commit();
                return Redirect::to('group-description')->with('message', 'Group Description added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for create group description.');
        }
        return Redirect::to('group-description');
    }

    /**
     * edit business
     */
    protected function edit($id){
        $description = GroupDescription::find(json_decode($id));
        if(is_object($description)){
            $groups = Group::all();
            return view('description.create', compact('description', 'groups'));
        }

        return Redirect::to('group-description');
    }

    /**
     * update business
     */
    protected function update( Request $request){
        $v = Validator::make($request->all(), $this->validateGroupDescription);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        DB::beginTransaction();
        try
        {
            $description = GroupDescription::AddOrUpdateGroupDescription($request, true);
            if(is_object($description)){
                DB::commit();
                return Redirect::to('group-description')->with('message', 'Group Description updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for update group description');
        }
        return Redirect::to('group-description');
    }
}
