<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth,File,Redirect;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image','message'
    ];

    protected static function addOrUpdateNotification(Request $request, $isUpdate=false){
        $message = $request->get('message');
        $notificationId =  $request->get('notification_id');

        if($isUpdate && $notificationId > 0){
            $notification = static::find($notificationId);
            if(!is_object($notification)){
                return false;
            }
        } else {
            $notification = new static;
        }
        $notification->message = $message;
        $notification->save();

        if($request->exists('image')){
	        $path = 'notification-image/'.$notification->id;
	        if(!is_dir($path)){
	            File::makeDirectory($path, $mode = 0777, true, true);
	        }

            if($isUpdate && $notificationId > 0){
                if(!empty($notification->image) && is_file($notification->image)){
                    unlink($notification->image);
                }
            }
            $notificationImage = str_replace(' ', '_', $request->file('image')->getClientOriginalName());
            $request->file('image')->move($path, $notificationImage);
            $notification->image = $path."/".$notificationImage;
            $notification->save();
        }
        return $notification;
    }
}
