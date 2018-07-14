<?php

namespace App\Listeners;

use App\Events\PushNotification;
use App\Models\Device;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SendNotification
{
    private static $fcmURL = 'https://fcm.googleapis.com/fcm/send';
//    private static $fcmKey = 'AIzaSyCBB1hN3Jk8ekX62fQJXsLmBcRQLyejNBk';
    private static $fcmKey = 'AAAANsoFZh8:APA91bGHwx0nfhh77p50zJJRZMF1ObsF3--eY_MjNbM2mHPXsgce7s1-Y1AIMPpQ2wlq9xrPU4hjFQThBkntqpONH_AJNH10_ZHc9D1WCU1lt-EglEkGjUSgOqtewABHL4YBY13zSqH_';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  PushNotification  $request
     * @return void
     */
    public function handle(PushNotification $request)
    {
        $users=$request->event['users'];
        if(empty($users))
            return;

        if($users=='all'){
            $fcmTokens=Device::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        }
        elseif(is_array($users)){
            $fcmTokens=Device::whereNotNull('fcm_token')->whereIn('user_id',$users)->pluck('fcm_token')->toArray();
        }
        else{
            $fcmTokens=Device::whereNotNull('fcm_token')->where('user_id',$users)->pluck('fcm_token')->toArray();
        }


        if(count($fcmTokens) ==0)
            return;
        $fields = array(
            'registration_ids' => $fcmTokens,
            'notification' => [
                "body" => isset($request->event['notification']) ? $request->event['notification'] : '',
                "title" => isset($request->event['title']) ? $request->event['title'] : "New Notification",
            ]
        );

        $headers = array(
            'Authorization: key=' . self::$fcmKey,
            'Content-Type: application/json'
        );

        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, self::$fcmURL );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields));

        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if(Storage::disk('local')->exists('Notifications.txt')){
            Storage::disk('local')->append('Notifications.txt',Carbon::now()->format("Y-m-d H:i:s").": ".$result);
        }
        else{
            Storage::disk('local')->put('Notifications.txt',Carbon::now()->format("Y-m-d H:i:s").": ".$result);
        }
        curl_close($ch);
    }
}
