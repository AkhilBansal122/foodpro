<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

use App\Models\Cart;
use App\Models\cartItem;
use App\Models\OrdersItem;
use App\Models\Tables;
use App\Models\Orders;
use App\Models\Transation;
use App\Models\CustomOrders;
use App\Models\User;
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
        $RAZORPAY_KEY="rzp_test_AlibpgXADTGmiN";
        $RAZORPAY_SECRET="tIoKEMQRNG6pLKN1LSorIXQt";

        $input = $request->all();
      //  dd($input);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));


        $payment = $api->payment->fetch($request->razorpay_payment_id);


        if(count($input)  && !empty($input['razorpay_payment_id'])) {

            try {


                $payment->capture(array('amount'=>$payment['amount']));


            } catch (\Exception $e) {

                return  $e->getMessage();

                Session::put('error',$e->getMessage());

                return redirect()->back();

            }

        }

        if((auth()->user()) && auth()->user()->is_admin==5){
        {
            $id = $request->table_id;
            $user_id = auth()->user()->id;
            $get_cart = Cart::where("user_id",$user_id)->first();
            $table= Tables::where("unique_id",$id)->first();
            
            $order  =new Orders();
            if(!is_null($get_cart)){
                $get_cartItem = cartItem::where("cart_id",$get_cart->id)->get();

                $order->table_id = $request->table_id;
                $order->user_id = $get_cart->user_id;
                $order->coupon_id = $get_cart->coupon_id;
                $order->coupon_code = $get_cart->coupon_code;
                $order->price = $get_cart->price;
                $order->discount_amount = $get_cart->discount_amount;
                $order->final_amount = $get_cart->final_amount;
                $order->shipping_price = $get_cart->shipping_price;
                $order->order_in_process = 0;
                $order->branch_id= isset($table->get_manager->branch_id) ? $table->get_manager->branch_id :0;
                $order->save();
                $order->unique_id = "ODR-0000".$order->id;
                $order->save();
                if(!empty($get_cartItem)){
                    foreach($get_cartItem as $value){
                        $orderItem = new OrdersItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->user_id = $user_id;
                        $orderItem->product_id = $value->product_id;
                        $orderItem->qty = $value->qty;
                        $orderItem->product_price = $value->product_price;
                        $orderItem->save();
                    }
                }
                $Transation = new Transation();
                $Transation->order_id = $order->id;
                $Transation->from_id  =$user_id;
                $Transation->to_id =$table->restaurent_id;
                $Transation->status='Successfully';
                $Transation->save();
                $order->transation_id = $Transation->id;
                $order->save();
                $Transation->unique_id = "TRN-0000".$Transation->id;
                $Transation->payment_id = $request->razorpay_payment_id;
                $Transation->save();
                cartItem::where("cart_id",$get_cart->id)->delete();
                Cart::where("id",$get_cart->id)->delete();
                Session::put('success', 'Payment successful');
                return response()->json(['success' => 'Payment successful']);
            }
        }
      }
    }
}