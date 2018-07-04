<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Group;
use Auth,File;

class GroupDescription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id','description'
    ];

    protected static function AddOrUpdateGroupDescription(Request $request, $isUpdate=false){
        $groupId = $request->get('group_id');
        $descriptionMsg =  $request->get('description');
        $descriptionId =  $request->get('description_id');

        if($isUpdate && $descriptionId > 0){
            $description = static::find($descriptionId);
            if(!is_object($description)){
                return false;
            }
        } else {
            $description = new static;
        }

        $description->group_id = $groupId;
        $description->description = $descriptionMsg;
        $description->save();
        return $description;
    }

    public function group(){
    	return $this->belongsTo(Group::class, 'group_id');
    }

}
