<?php
namespace App\Helper;
use Illuminate\Http\Request;
use App\Model\OperationLog;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Helper;
use Auth;

class ProjectHelper
{
	public static function emailSetting()
	{
        $data['servicesMail'] = 'services@just-calls.com';
        $data['salesMail']    = 'sales@just-calls.com';
       
        return $data;
	}

    public static function companyDetails()
	{
        $data['companyName']  = 'Just Call Services';
        $data['toll_free_no'] = '1800-120-7699';
        return $data;
	}

	public static function actionLogs($data,$request)
	{
		if (Auth::user()) {   // Check is user logged in
         	$log_createby = Auth::user()->id;
	        $log_updateby = Auth::user()->id;
	    } else {
	        $log_createby = 0;
	        $log_updateby = 0;
	    }
		$logData = ([	
			'log_method' 	=> $data['log_method'],
			'log_action' 	=> $data['log_action'],
			'log_module' 	=> $data['log_module'],
			'log_path' 		=> null,
			'log_ip_address'=> $request->ip(),
			'log_createby' 	=> $log_createby,
			'log_updateby' 	=> $log_updateby,
			'log_createat' 	=> date('Y-m-d H:i:s'),
			'log_updateat' 	=> date('Y-m-d H:i:s')
		]);
		$create = OperationLog::insert($logData);
	}
}

?>