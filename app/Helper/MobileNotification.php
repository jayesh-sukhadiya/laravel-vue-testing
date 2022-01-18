<?php 
namespace App\Helper;

use Illuminate\Database\Eloquent\Helper;
use App\Model\MobileNotifications;

class MobileNotification 
{
	public static function sendNotification($sender_id,$sender_name,$received_name,$received_id,$device_token,$content,$title,$global_id,$notification_count,$user_type,$device_type,$notification_type)
	{
        $insertData = new MobileNotifications;
        $insertData->not_sender_id      = $sender_id;
        $insertData->not_sender_name    = $sender_name;
        $insertData->not_received_id    = $received_id;
        $insertData->not_received_name  = $received_name;
        $insertData->not_type           = $notification_type;
        $insertData->not_global_id      = $global_id; 
        $insertData->not_title          = $title;
        $insertData->not_content        = $content;
        $insertData->not_is_read        = 0; // 0 = Not read 1 = read
        $insertData->not_read_at        = date('Y-m-d H:i:s');
        $insertData->not_createdat      = date('Y-m-d H:i:s');
        $insertData->not_updatedat      = date('Y-m-d H:i:s');
        $insertData->save();

        $url = 'https://fcm.googleapis.com/fcm/send';
        $token = $device_token;

        if($device_type)
        {
            if($device_type == '2') // iOs
            {
                $notificationMessage = array(
                'body'      => $content,
                'title'     => $title.' - Just Call Services',
                'global_id' => $global_id,
                'sound'     => "default",
                'color'     => "#55C0A8",
                'type'      => $notification_type,
                'badge'     => $notification_count,
                'user_type' => $user_type
                );

                $fcmNotification = array(
                    'registration_ids' => array($token),
                    'priority' => 'high',
                    'aps'=>array('alert'=>array('title'=>'test','body'=>'body'), 'content-available'=>1,'mutable_content' =>1),
                    'type'  => 'comments_on_forums',
                    'badge' => $notification_count,

                    'headers' => array( 'apns-priority' => '10'),
                    'content_available' => true,
                    'notification'=> $notificationMessage,
                    'data' => array(
                        'date'      => date('d-m-Y H:i:s'),
                        'message'   => $content,
                        'global_id' => $global_id,
                        'type'      => "comment_on_post", // post,
                        'vibrate'   => 1,
                        'sound'     => 1,
                        'badge'     => $notification_count,
                        'user_type' => $user_type
                    )
                );
            }

            else if($device_type == 3){ // Android
              $notification = [
                'date'      => date('d-m-Y H:i:s'),
                'title'     => $title.' - Just Call Services',
                'body'      => $content,
                'global_id' => $global_id,
                'sound'     => "default",
                'color'     => "#55C0A8",
                'type'      => $notification_type,
                'message'   => $content,
                'vibrate'   => 1,
                'badge'     => $notification_count,
                'user_type' => $user_type
              ];
              
              $extraNotificationData = $notification;

              $fcmNotification = [
                  'to'   => $token,
                  'data' => $extraNotificationData
              ];
            }
            
            $fcmNotification = json_encode ( $fcmNotification );

            $headers = array (
                  'Authorization: key=' . "AAAAqwL0Waw:APA91bF5TXv__QfFJOPzDZj86jy5lMnZW6DHkmmLZK7rN84K3YGCqRpf-RpvfhufSr4w1zVLhkHDTJIgZAM-M8E06fz5wTl-Tu9jFEDlunirmQFLycXQ8hOzPp5wVb98AkY2Ibugfn6F",
                  'Content-Type: application/json'
              );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fcmNotification );
            $result = curl_exec ( $ch );
            curl_close ( $ch );
            return true;
        }
	}
}

?>