<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,DB,Redirect,Auth;
use App\Libraries\InputSanitise;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
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
     * show notification
     */
    protected function show(){
        if( 0 == Auth::user()->is_super_admin){
            return Redirect::to('home');
        }
        $notifications = Notification::all();
        return view('notification.list', compact('notifications'));
    }

    /**
     * add notification
     */
    protected function create(){
        $notification = new Notification;
        return view('notification.create', compact('notification'));
    }

    /**
     * store notification
     */
    protected function store( Request $request){
        DB::beginTransaction();
        try
        {
            $notification = Notification::addOrUpdateNotification($request);
            if(is_object($notification)){
                DB::commit();
                return Redirect::to('show-notification')->with('message', 'Notification added successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for store notification.');
        }
        return Redirect::to('show-notification');
    }

    /**
     * edit notification
     */
    protected function edit($id){
        $notification = Notification::find(json_decode($id));
        if(is_object($notification)){
            return view('notification.create', compact('notification'));
        }
        return Redirect::to('show-notification');
    }

    /**
     * update notification
     */
    protected function update( Request $request){
        DB::beginTransaction();
        try
        {
            $notification = Notification::addOrUpdateNotification($request, true);
            if(is_object($notification)){
                DB::commit();
                return Redirect::to('show-notification')->with('message', 'Notification updated successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for update notification');
        }
        return Redirect::to('show-notification');
    }

    /**
     * delete member
     */
    protected function delete(Request $request){
        $notificationId = json_decode($request->get('notification_id'));
        $notification = Notification::find($notificationId);
        DB::beginTransaction();
        try
        {
            if(is_object($notification)){
                    $path = 'notification-image/'.$notification->id;
                    InputSanitise::delFolder($path);
                    $notification->delete();
                    DB::commit();
                    return Redirect::to('show-notification')->with('message', 'Notification deleted successfully.');
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->withErrors('something went wrong for delete notification.');
        }
        return Redirect::to('show-notification');
    }

    /**
     * all notifications
     */
    protected function notifications(){
        $notifications = Notification::orderBy('id', 'desc')->get();
        return view('notification.notifications', compact('notifications'));
    }
}
