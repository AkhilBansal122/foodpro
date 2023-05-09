<?php

namespace App\Helpers;
use QrCode;
use App\Models\User;
use App\Models\Tables;
use File;
use Form;
use Str;
class Helper {

    public static function random_token()
    {
        return Str::random(50);
    }
    public static function editAction($route,$param){
        return    $btn = '<a href="'.$route.'/'.$param.'" class="btn btn-light  radius-0 shadow btn-xs sharp me-1"><i class="bx bx-edit"></i></a>';
    }
    public static function viewAction($route,$param){
        return    $btn = '<a href="'.$route.'/'.$param.'"  class="btn btn-light  radius-0 shadow btn-xs sharp me-1"><i class="bx bx-show"></i></a>';
    }

    public static function action($data){
        return    $btn = '<div>'.$data."</div>";
    }
    public static function dateFormat($data){
        return    $btn = '<div>'.$data."</div>";
    }
    public static function statusAction($data){
        $sel="";
        $sel .= "<option value='Active' " . ((isset($data['status']) && $data['status'] == 'Active') ? 'Selected' : '') . ">Active</option>";
        $sel .= "<option value='Inactive' " . ((isset($data['status']) && $data['status'] == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
        return    $sel;
    }

    public static function QrcodeGenerate($lsat_table_id,$tblCode,$restaurent_id,$manager_id,$manager_code,$rest_code,$no_of_table){
       

        $path0 = public_path('qrimages');
        if(!File::isDirectory($path0)){
            File::makeDirectory($path0, 0777, true, true);
        }
  
        $path = public_path('qrimages/'.$rest_code.'/');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        
        $path2 = public_path('qrimages/'.$rest_code.'/'.$manager_code);
        if(!File::isDirectory($path2)){
            File::makeDirectory($path2, 0777, true, true);
        }
        $finalPath  ='qrimages/'.$rest_code.'/'.$manager_code."/table";

        $path3 = public_path($finalPath);
       
        if(!File::isDirectory($path3)){
            File::makeDirectory($path3, 0777, true, true);
        }
        
        $count =1;
        for($i=1;$i<=$no_of_table;$i++)
        {
            $code = $tblCode.$restaurent_id.$manager_id.$lsat_table_id+$i;
            $qrurl1 = url('/')."/".$code;    
            $updated_qrcode_path ="";
            $final_qr_code_name= $code.".svg";
            $uppath = "qrimages/".$rest_code."/".$manager_code."/table/";
            $updated_qrcode_path .=$uppath.$final_qr_code_name;
            \QrCode::size(300)
            ->format('svg')
            ->size(300)->errorCorrection('H')
            ->generate($qrurl1, public_path($uppath.$final_qr_code_name));
                   Tables::create(array(
                    'unique_id'=>$code,
                    'user_id'=>$manager_id,
                    'restaurent_id'=>$restaurent_id,
                    'qrcode'=>$updated_qrcode_path
                   ));
                $count++;
        }
        if($count == $no_of_table){
            return true;
        }
        else{
            return false;
        }
       
    }    

    public function sendWebNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();
          
        $serverKey = 'server key goes here';
  
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);        
    }

}

