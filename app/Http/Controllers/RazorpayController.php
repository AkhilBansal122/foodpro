<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

use Session;

use Exception;


class RazorpayController extends Controller
{
   public function formPage(){
    return  view('payment');
   }


   public function razorpay()
   {        
       return view('website.menu');
   }
   /* */
   public function checkout(Request $request)
   {        
       $input = $request->all();  
       
       $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
       $payment = $api->payment->fetch($input['razorpay_payment_id']);

       if(count($input)  && !empty($input['razorpay_payment_id'])) 
       {
           try 
           {
               $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

           } 
           catch (\Exception $e) 
           {
               return  $e->getMessage();
        //       \Session::put('error',$e->getMessage());
               return redirect()->back();
           }            
       }
       
      // \Session::put('success', 'Payment successful, your order will be despatched within an hours.');
       return redirect()->back();
   }
}
