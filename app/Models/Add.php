<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Libraries\InputSanitise;
use Auth,File,Redirect;

class Add extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo','start_date','end_date'
    ];

    protected static function AddOrUpdateAdd(Request $request, $isUpdate=false){
        $addId = $request->get('add_id');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if($isUpdate && $addId > 0){
            $add = static::find($addId);
            if(!is_object($add)){
                return false;
            }
        } else {
            $add = new static;
            $add->photo = '';
        }

        $add->start_date = $startDate;
        $add->end_date = $endDate;
        $add->save();

        if($request->exists('photo')){
	        $path = 'ads/'.$add->id;
	        if(!is_dir($path)){
	            File::makeDirectory($path, $mode = 0777, true, true);
	        }

            if($isUpdate && $addId > 0){
                if(!empty($add->photo) && is_file($add->photo)){
                    unlink($add->photo);
                }
            }
            $applicantPhoto = str_replace(' ', '_', $request->file('photo')->getClientOriginalName());
            $request->file('photo')->move($path, $applicantPhoto);
            $add->photo = $path."/".$applicantPhoto;
            $add->save();
        }
        return $add;
    }
}
