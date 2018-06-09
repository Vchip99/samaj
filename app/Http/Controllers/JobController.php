<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Job;

class JobController extends Controller
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
     * show Job
     */
    protected function show(){
        $jobs = Job::where('member_id', Auth::user()->id)->get();
        return view('job.list', compact('jobs'));
    }

    /**
     * add job
     */
    protected function create(){
        $job = new Job;
        return view('job.create', compact('job'));
    }

    /**
     * store job
     */
    protected function store( Request $request){
        DB::beginTransaction();
        try
        {
            $job = Job::addOrUpdateJob($request);
            if(is_object($job)){
                DB::commit();
                return Redirect::to('show-job')->with('message', 'Job added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for store job.');
        }
        return Redirect::to('show-job');
    }

    /**
     * edit job
     */
    protected function edit($id){
        $job = Job::find(json_decode($id));
        if(is_object($job)){
            if($job->member_id != Auth::user()->id){
                return Redirect::to('show-job');
            }
            return view('job.create', compact('job'));
        }
        return Redirect::to('show-job');
    }

    /**
     * update job
     */
    protected function update( Request $request){
        DB::beginTransaction();
        try
        {
            $job = Job::addOrUpdateJob($request, true);
            if(is_object($job)){
                DB::commit();
                return Redirect::to('show-job')->with('message', 'Job updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for update job');
        }
        return Redirect::to('show-job');
    }

    /**
     * delete job
     */
    protected function delete(Request $request){
        $jobId = json_decode($request->get('job_id'));
        $job = Job::find($jobId);
        DB::beginTransaction();
        try
        {
            if(is_object($job)){
                if($job->member_id != Auth::user()->id){
                    return Redirect::to('show-job');
                }
                $job->delete();
                DB::commit();
                return Redirect::to('show-job')->with('message', 'job deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for delete job.');
        }
        return Redirect::to('show-job');
    }

    /**
     * all Job
     */
    protected function jobs(){
        $jobs = Job::orderBy('id', 'desc')->get();
        return view('job.jobs', compact('jobs'));
    }
}
