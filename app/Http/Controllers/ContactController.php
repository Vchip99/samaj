<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Contact;

class ContactController extends Controller
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
     * show contact
     */
    protected function show(){
        if( 0 == Auth::user()->is_super_admin){
            return Redirect::to('home');
        }
        $contacts = Contact::all();
        return view('contact.list', compact('contacts'));
    }

    /**
     * add contact
     */
    protected function create(){
        $contact = new Contact;
        return view('contact.create', compact('contact'));
    }

    /**
     * store contact
     */
    protected function store( Request $request){
        DB::beginTransaction();
        try
        {
            $contact = Contact::addOrUpdateContact($request);
            if(is_object($contact)){
                DB::commit();
                return Redirect::to('show-contact')->with('message', 'Contact added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while store contact.');
        }
        return Redirect::to('show-contact');
    }

    /**
     * edit contact
     */
    protected function edit($id){
        $contact = Contact::find(json_decode($id));
        if(is_object($contact)){
            return view('contact.create', compact('contact'));
        }
        return Redirect::to('show-contact');
    }

    /**
     * update contact
     */
    protected function update( Request $request){
        DB::beginTransaction();
        try
        {
            $contact = Contact::addOrUpdateContact($request, true);
            if(is_object($contact)){
                DB::commit();
                return Redirect::to('show-contact')->with('message', 'Contact updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while update contact');
        }
        return Redirect::to('show-contact');
    }

    /**
     * delete contact
     */
    protected function delete(Request $request){
        $contactId = json_decode($request->get('contact_id'));
        $contact = Contact::find($contactId);
        DB::beginTransaction();
        try
        {
            if(is_object($contact)){
                    $contact->delete();
                    DB::commit();
                    return Redirect::to('show-contact')->with('message', 'Contact deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong while delete contact.');
        }
        return Redirect::to('show-contact');
    }

    /**
     * all contacts
     */
    protected function contacts(){
        $contacts = Contact::all();
        return view('contact.contacts', compact('contacts'));
    }

    protected function getContactByCity(Request $request){
        return Contact::getContactByCity($request);
    }

    protected function searchContact(Request $request){
        return Contact::searchContact($request);
    }
}
