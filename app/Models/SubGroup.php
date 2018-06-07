<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File;

class SubGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'name'
    ];

    protected static function getSubGroupsByGroupId(Request $request){
    	$groupId = $request->get('group_id');
    	return static::where('group_id' ,$groupId)->get();
    }
}
