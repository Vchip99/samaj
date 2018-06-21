<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File,Redirect;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description', 'member_id'
    ];

    protected static function addOrUpdateJob(Request $request, $isUpdate=false){
        $title = $request->get('title');
        $description = $request->get('description');
        $jobId =  $request->get('job_id');
        $loginUser = Auth::user();
        if($isUpdate && $jobId > 0){
            $job = static::find($jobId);
            if(!is_object($job)){
                return false;
            }
        } else {
            $job = new static;
        }
        $job->title = $title;
        $job->description = $description;
        if($isUpdate && $jobId > 0 && 1 == $loginUser->is_super_admin){
            $job->member_id = $job->member_id;
        } else {
            $job->member_id = $loginUser->id;
        }
        $job->save();
        return $job;
    }

    protected static function deleteJobByMemberId($memberId){
        $jobs = static::where('member_id',$memberId)->get();
        if(is_object($jobs) && false == $jobs->isEmpty()){
            foreach($jobs as $job){
                $job->delete();
            }
        }
        return;
    }
}
