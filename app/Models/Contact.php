<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File,Redirect;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone', 'description'
    ];

    protected static function addOrUpdateContact(Request $request, $isUpdate=false){
        $name = $request->get('name');
        $phone = $request->get('phone');
        $description = $request->get('description');
        $contactId =  $request->get('contact_id');

        if($isUpdate && $contactId > 0){
            $contact = static::find($contactId);
            if(!is_object($contact)){
                return false;
            }
        } else {
            $contact = new static;
        }
        $contact->name = $name;
        $contact->phone = $phone;
        $contact->description = $description;
        $contact->save();
        return $contact;
    }
}
