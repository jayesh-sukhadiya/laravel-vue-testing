<?php 
namespace App\Helper;

use Illuminate\Database\Eloquent\Helper;

class SendSmsMessage 
{
  public static function smsClientRegistration($data)
  {
    // fullname,email,password,mobile_number
    $var1 = $data['users']['use_full_name'];
    $var2 = $data['users']['email'];
    $var3 = $data['password'];

    $mobile_number = $data['users']['use_mob_no'];

    $dynamicPeram = '';
    if($mobile_number){
        $dynamicPeram = "&VAR1=".$var1."&VAR2=".$var2."&VAR3=".$var3;
    }
    $templateName = 'Client_Registration';
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://2factor.in/API/V1/cfa07b62-c045-11eb-8089-0200cd936042/ADDON_SERVICES/SEND/TSMS",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "From=JUCALL&To=".$mobile_number."&TemplateName=".$templateName.$dynamicPeram,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
      ),
    ));
    $buffer = curl_exec($curl);
    if (isset($buffer) && !empty($buffer)) {
        $responseData['status'] = 200;
        $responseData['flag'] = "true";
        $responseData['message'] = "Message send successfully.";
    } else {
        $responseData['status'] = 200;
        $responseData['flag'] = "false";
        $responseData['message'] = "Registration Done Successfully , But Problem in send message.";
    }
    return $responseData;
  }

  public static function sendOtp($data)
  {
    // fullname,email,password,mobile_number
    $var1 = $data['otp_code'];
    $mobile_number = $data['mobile_number'];

    $dynamicPeram = '';
    if($mobile_number){
        $dynamicPeram = "&VAR1=".$var1;
    }
    $templateName = 'user-joinus';

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://2factor.in/API/V1/cfa07b62-c045-11eb-8089-0200cd936042/ADDON_SERVICES/SEND/TSMS",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "From=JUCALL&To=".$mobile_number."&TemplateName=".$templateName.$dynamicPeram,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
      ),
    ));
    $buffer = curl_exec($curl);

    if (isset($buffer) && !empty($buffer)) {
        $responseData['status'] = 200;
        $responseData['flag'] = "true";
        $responseData['message'] = "Message send successfully.";
    } else {
        $responseData['status'] = 401;
        $responseData['flag'] = "false";
        $responseData['message'] = "Somethig is wrong.";
    }
    return $responseData;
  }

  public static function sendOtpUsingSmsGatewayHub($data = array())
  {
      if(!empty($data))
      {
          $apikey = config('app.smsgatewayhub.smsgatewayhub_api_key');
          $apisender = config('app.smsgatewayhub.smsgatewayhub_sender_id');
          $send_otp = rand(100000, 999999);
          $msg ="Dear User, Your OTP is ".$send_otp." regards Just Call Service";
          $num = $data['contact_num'];
          $ms = rawurlencode($msg);
          $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';

          $ch=curl_init($url);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch,CURLOPT_POST,1);
          curl_setopt($ch,CURLOPT_POSTFIELDS,"");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
          $response = curl_exec($ch);

          $response_arr = json_decode($response,true);
          if((!empty($response_arr)) && (isset($response_arr['ErrorCode'])) && ($response_arr['ErrorCode'] == '000') && (isset($response_arr['ErrorMessage'])) && ($response_arr['ErrorMessage'] == 'Success'))
          {
              $response_arr['otp'] = $send_otp;
              return $response_arr;
          }
          else
          {
              return false;
          }
      }
      else
      {
          return false;
      }
  }

  public static function sendInvoicePaymentLink($data = array())
  {
      if(!empty($data))
      { 
          $data = $data['payment'];
          $apikey = config('app.smsgatewayhub.smsgatewayhub_api_key');
          $apisender = config('app.smsgatewayhub.smsgatewayhub_sender_id');
          $msg ="Dear ".$data['name'].", Just Call has requested payment for your service. Rs. ".$data['amount']." for Invoice No ".$data['invoice_no']." Payment Link: ".$data['payment_link']." Thanks Just Call Services";
          $num = $data['contact_num'];
          $ms = rawurlencode($msg);
          $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
          $ch=curl_init($url);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch,CURLOPT_POST,1);
          curl_setopt($ch,CURLOPT_POSTFIELDS,"");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
          $response = curl_exec($ch);
      }
  }
}

?>