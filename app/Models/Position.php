<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'sub_group_id', 'name'
    ];

    protected static function getPositionByGroupIdBySubGroupId(Request $request){
    	$groupId = $request->get('group_id');
    	$subgroupId = $request->get('sub_group_id');
    	return static::where('group_id' ,$groupId)->where('sub_group_id' ,$subgroupId)->get();
    }
}
