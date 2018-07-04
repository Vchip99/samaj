<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File,Redirect;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id','description'
    ];

    protected static function addContact(Request $request){
        $suggestionText = $request->get('description');

        $suggestion = new static;
        $suggestion->member_id = Auth::user()->id;
        $suggestion->description = $suggestionText;
        $suggestion->save();
        return $suggestion;
    }
}
