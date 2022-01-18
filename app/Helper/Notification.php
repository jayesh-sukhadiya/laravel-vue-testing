<?php 
namespace App\Helper;

use Illuminate\Database\Eloquent\Helper;

class Notification 
{
	public static function requestData($title,$body,$firebaseToken)
	{
		$SERVER_API_KEY = 'AAAAqwL0Waw:APA91bF5TXv__QfFJOPzDZj86jy5lMnZW6DHkmmLZK7rN84K3YGCqRpf-RpvfhufSr4w1zVLhkHDTJIgZAM-M8E06fz5wTl-Tu9jFEDlunirmQFLycXQ8hOzPp5wVb98AkY2Ibugfn6F';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body"  => $body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
	}
}


?>