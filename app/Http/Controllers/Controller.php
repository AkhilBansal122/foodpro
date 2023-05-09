<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function changeStatus($model,$data){
        if(!empty($data)){
            $modelName  = "App\Models\\$model";
            $update     = $modelName::where('id',$data['id'])->update(['status'=>$data['value']]);
            if($update){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
