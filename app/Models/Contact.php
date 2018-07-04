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
        'name','phone', 'is_amravati_city','description'
    ];

    protected static function addOrUpdateContact(Request $request, $isUpdate=false){
        $name = $request->get('name');
        $phone = $request->get('phone');
        $isAmravatiCity =  $request->get('is_amravati_city');
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
        $contact->is_amravati_city = $isAmravatiCity;
        $contact->description = $description;
        $contact->save();
        return $contact;
    }

    protected static function getContactByCity($request){
        $city =  $request->get('city');
        if(is_string($city) && 'All' != $city){
            return static::where('is_amravati_city', $city)->get();
        } else {
            return static::all();
        }
    }

    protected static function searchContact($request){
        $city =  $request->get('city');
        $contact =  $request->get('contact');
        $result = static::where('name','like', '%'.$contact.'%');
        if(is_string($city) && 'All' != $city){
            $result->where('is_amravati_city', $city);
        }
        return $result->get();
    }
}
