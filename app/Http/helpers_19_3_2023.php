<?php


use App\Models\Setting;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\SystemAction;
use Mail;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;


    function has_permission($route_name)
    {
    if(auth()->guard('admin')->user()->id == 1){
        return true;
    }
            
    $checkPermission = Permission::where('route_name', $route_name)->first();

    if(!$checkPermission){
        return false;
    }
    
    
    $rolePermissionsIDs = RolePermission::where('role_id', auth()->guard('admin')->user()->role_id)->pluck('permission_id')->toArray();
    $roleParentsPermissionsIDs = Permission::whereIn('id', $rolePermissionsIDs)->pluck('parent_id')->toArray();
    
    if(in_array($checkPermission->id, $rolePermissionsIDs)){
        return true;
    }
    
    
    if(in_array($checkPermission->id, $roleParentsPermissionsIDs)){
        return true;
    }
    
    
    

    return false;
}



    function admin_assets($dir)
    {
    return url('/admin_assets/assets/' . $dir);
}


    function sendSMS($mobile, $msg)
    {
    
    
    
    $url = 'https://api.taqnyat.sa/v1/messages?bearerTokens=1fae22be293c2a965a723f4469a8b0a9&sender=Das-Alumni&recipients='. $mobile .'&body=' .$msg;
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    curl_exec($ch);
    
    curl_close($ch);
    
    }


    function uploadImage($file, $path){
        $image = $file;
        $extention = $image->getClientOriginalExtension();
        $file_name = rand(1, 100) . rand(1000000, 9999999) . time() . rand(1, 200) . "." . $extention;
        Image::make($image)->save('uploads/' . $path . '/' . $file_name);
        return $file_name;
    }



    function uploadFile($file, $path){
        $extension = $file->getClientOriginalExtension();
        $filename  = rand(1, 1000) . "_" . time() . "_" . rand(1,50000) . 'book.' .$extension;
        $destinationPath = 'uploads/' . $path;
        $file->move($destinationPath, $filename);
        return $filename;
    }



    function sendToOneEmail($send_to, $blade, $subject, $message){

    $blade_data = array(
        'subject'=> $subject,
        'message1' => $message,
    );
    
    $email_data = array(
        'from' => env('MAIL_FROM_ADDRESS'),
        'fromName' => env('MAIL_FROM_NAME'),
        'to' => $send_to);
    try{
        Mail::send('emails.' . $blade , $blade_data, function ($message) use ($email_data, $subject) {
            $message->to($email_data['to'])
                ->subject($subject)
                ->replyTo($email_data['from'], $email_data['fromName'])
                ->from($email_data['from'],$email_data['fromName']);
        });
    }    

    catch(Exception $e) {
        // do any thing
    }
}



    
    function sendMailToMultiple($send_to, $emails_cc, $blade, $subject, $message)
    {
    
        $blade_data = array(
            'subject'=> $subject,
            'message1' => $message,
        );
        
        
        $email_data = array(
        'from' => env('MAIL_FROM_ADDRESS'),
        'fromName' => env('MAIL_FROM_NAME'),
        'to' => $send_to);
        try{
            Mail::send('emails.' . $blade , $blade_data, function ($message) use ($email_data, $subject, $emails_cc) {
                $message->to($email_data['to'])
                    ->bcc($emails_cc)
                    ->subject($subject)
                    ->replyTo($email_data['from'], $email_data['fromName'])
                    ->from($email_data['from'],$email_data['fromName']);
            });
        }    
        
        catch(Exception $e) {
        }
    }


    
    function checkEmailDomainExists($email){
    function domain_exists($email, $record = 'MX'){
        list($user, $domain) = explode('@', $email);
        return checkdnsrr($domain, $record);
    }
        
    if(!domain_exists($email)) {
        return false;
    }else{
        return true;
    }
}



    function sendNotificationToClient( $tokens_android, $tokens_ios, $order_id, $message,$code=200 ){
        try {
            $headers = [
    
                'Authorization: key=AAAA1e6pAAw:APA91bEoiUbsHb5vLm77xEQEPWDDADCctLN2dGjYSt9_e9hrGAnXCVir0WrTgnY5-Q8mhmlpUq7ZjkmTNWWt1bWEUdRmdcGnsXEiL_DR3T7zxdOtQwjDZ2-koA6dyUkY7CII3Q_L3Ear',
                'Content-Type: application/json'
            ];
    
            if(!empty($tokens_ios)) {
                $dataForIOS = [
                    "registration_ids" => $tokens_ios,
                    "notification" => [
                        'body' => $message,
                        'type' => "notify",
                        'title' => 'GoodLifeApp',
                        'code' => $code,
                        'order_id' => $order_id,
                        'badge' => 1,
                        'icon' => 'myicon',//Default Icon
                        'sound' => 'mySound'//Default sound
                    ]
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataForIOS));
                $result = curl_exec($ch);
                curl_close($ch);
                // $resultOfPushToIOS = "Done";
                //   return $result; // to check does the notification sent or not
            }
            if(!empty($tokens_android)) {
                $dataForAndroid = [
                    "registration_ids" => $tokens_android,
                    "data" => [
                        'body' => $message,
                        'type' => "notify",
                        'title' => 'GoodLifeApp',
                        'order_id' => $order_id,
                        'code' => $code,
                        'badge' => 1,
                        'icon' => 'myicon',//Default Icon
                        'sound' => 'mySound'//Default sound
                    ]
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataForAndroid));
                $result = curl_exec($ch);
                curl_close($ch);
                //    $resultOfPushToAndroid = "Done";
            }
            //   return $resultOfPushToIOS." ".$resultOfPushToAndroid;
            //    return $result;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    
    
    
    
    
    }
    
    
    
    function getLocal()
    {
        return app()->getLocale();
    }
    
    
    function convertAr2En($string){
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
        return $englishNumbersOnly;
    }
    
    
    function pageNum(){
        if(isset($_GET['page'])){
            $pageNum = $_GET['page'];
        }else{
            $pageNum = 1;
        }
        return ($pageNum-1) * Setting::query()->first()->rows_pagination_count; 
    }
    
    
    function slugURL($title){
        $WrongChar = array('@', '؟', '.', '!','?','&','%','$','#','{','}','(',')','"',':','>','<','/','|','{','^');
    
        $titleNoChr = str_replace($WrongChar, '', $title);
        $titleSEO = str_replace(' ', '-', $titleNoChr);
        return $titleSEO;
    }
    



