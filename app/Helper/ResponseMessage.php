<?php 
namespace App\Helper;
use Illuminate\Database\Eloquent\Helper;
use Symfony\Component\HttpFoundation\Response;

class ResponseMessage
{
	public static function success($msg,$data)
	{	
		header('Content-type: application/json');
		echo json_encode(['success' => true, 'error' => 200, 'message' => $msg, 'data' => $data],JSON_UNESCAPED_SLASHES);
	}

	public static function error($msg)
	{
		header('Content-type: application/json');
		echo json_encode(['success' => false, 'error' => 401, 'message' => $msg,'data'=> array()],JSON_UNESCAPED_SLASHES);
	}
}
?>