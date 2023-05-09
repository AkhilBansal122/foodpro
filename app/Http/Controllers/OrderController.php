<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;


use App\Models\Cart;
use App\Models\cartItem;
use App\Models\OrdersItem;
use App\Models\Tables;
use App\Models\Orders;
use App\Models\Transation;
use App\Models\CustomOrders;
use App\Models\User;
use DataTables;
use Str;
use Helper;


class OrderController extends Controller
{
    public function add_tocart(Request $request,$id){
        $id= $request->table_id;
        if((auth()->user()) && (auth()->user()->is_admin==5)){
            $user_id = auth()->user()->id;
            $table= Tables::where("unique_id",$request->table_id)->first();
            if(!is_null($table))
            {
                $gst =  $table->get_restaurent->GST;
                $cart = Cart::where("user_id",$user_id)->first();
                $checked =  cartItem::where(['cart_id'=>$cart->id,'product_id'=>$request->product_id])->first();
                if(!is_null($checked))
                {
                    return response()->json(['status'=>true, "message" =>"This Item Already add to Cart then Select Quentity"]);
                }
                else{
                    if(is_null($cart)){
                        $cart = new Cart();
                        $cart->user_id = auth()->user()->id;
                        $cart->save();
                    }
                    $cartDetails = new cartItem();
                    $cartDetails->cart_id = $cart->id;
                    $cartDetails->user_id = $user_id;
                    $cartDetails->product_id = $request->product_id;
                    $cartDetails->product_price = $request->price;
                    $cartDetails->qty = 1;//$request->qty;
                    $cartDetails->save();
                    if($this->add_tocart_calculation($user_id,$cart->id))
                    {
                        return response()->json(['status'=>true, "message" =>"Add Item To Cart Successfully"]);
                    }
                    else{
                        return response()->json(['status'=>true, "message" =>"Add Item To Cart Successfully"]);
                    }
                }   
            }
        }
    }

     public function add_tocart_calculation($user_id,$cart_id){
        $cart =Cart::where("id",$cart_id)->first();
        
       $user =  auth()->user();
       $bill_gst =$user ->bill_gst;
       $GST = $user->GST;

       $final_amount =0;
        $discount_amount = 0;
        $total_price=0;
        if(!is_null($cart)){
            $get_cartItem = cartItem::where(['user_id'=>$user_id,"cart_id"=>$cart_id])->get();
            if(!empty($get_cartItem)){
                foreach($get_cartItem as $row){
                    $qty = $row->qty;
                    $total_product_price =$qty*$row->product_price;
                    $total_price += $total_product_price;
                }
            }
            $cart->price = $total_price;
          
            $discount_amount = $total_price * 10/100;
          
            $cart->discount_amount = $discount_amount;
            
            $final_amount = $total_price - $discount_amount;
            if($bill_gst==1)
            {
                $gstAmount = round($final_amount * $GST, 2);
                $totalPrice = $final_amount + $gstAmount;
                $cart->gstAmount = $gstAmount;
            }else{
                $total_price = $final_amount;
            }
            
            $cart->final_amount = $total_price;
          
            if($cart->save()){
                return true;
            }
            else{
                return false;
            }

        }
     } 

     //CartItemIncDec
   public function CartItemIncDec(Request $request,$id){
    if((auth()->user()) && (auth()->user()->is_admin==5) && $request->all()){
        
        $user_id = auth()->user()->id;
        $type = $request->type;//1 for inc 2 for dec
        $cart_id = $request->cart_id;
        $cart_details_id = $request->cart_details_id;
        $qty = $request->qty;
        $cartItem = cartItem::find($cart_details_id);
        if($type==1)
        {
            $cartItem->qty = $cartItem->qty+1;
        }
        else if($type==2){
            $cartItem->qty = $cartItem->qty-1;
        }
        if($cartItem->save()){
            $this->add_tocart_calculation($user_id,$cart_id);
            return response()->json(['status'=>true, "message" =>"Quantity Update Successfully"]);
        }
        else{
            return response()->json(['status'=>false, "message" =>"Quantity Update Failed"]);
        }
    }
   }

   //remove_cartItem
   public function remove_cartItem(Request $request,$id){
    if((auth()->user()) && (auth()->user()->is_admin==5) && $request->all()){
      // dd($request->all());
        $user_id = auth()->user()->id;
         $cart_details_id = $request->cart_item_id;
        if(!is_null($cart_details_id))
        {
             $cartItem = cartItem::find($cart_details_id);
            //dd($cartItem);
            $cart_id = $cartItem->cart_id;
            if($cartItem->delete()){
                $this->add_tocart_calculation($user_id,$cart_id);
                return response()->json(['status'=>true, "message" =>"Remove Item From Cart Successfully"]);
            }
            else{
                return response()->json(['status'=>false, "message" =>"Remove Item From Cart Failed"]);
            }
        }
    }
   }

   //checkout
   public function checkout(Request $request,$id){
   
    if((auth()->user()) && auth()->user()->is_admin==5){
        if($request->table_id ==$id){
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
                $Transation->save();
                cartItem::where("cart_id",$get_cart->id)->delete();
                Cart::where("id",$get_cart->id)->delete();
                return redirect()->back()->with(["msg"=>"order Place successfully"]);
            }
        }
        else{
            return redirect()->back();
        }
    }
   }

   public function index()
   {
        $user = auth()->user();
      //  dd($user);
        if(!is_null($user) && $user->is_admin==3){
            $query =Orders::where('id','!=',0);
            $query->where("branch_id",$user->branch_id);
            $data = $query->get();
            return view('manager/order/index',compact('data'));
            
        }
        else if(!is_null($user) && $user->is_admin==4){
            return view('chef/order/index');
        }else{
            return redirect('login');
        }
   }

    public function data(Request $request){
      //  dd($request->All());
        if ($request->ajax()) {
            $user= auth()->user();
       
             $limit = $request->input('length');
            $start = $request->input('start');
            //  die;
            $search = $request['search'];
            
            $unique_id = $request['unique_id'];

            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
      
           $querydata = Orders::where('id',"!=",0)->latest();
           if($user->is_admin==3)
           {
               $querydata->where("branch_id",$user->branch_id);
              $querydata->where("order_in_process",0);
           }
           else if($user->is_admin==4){
               $querydata->where("assign_chef_id",$user->id);
           }
           

            if (!is_null($unique_id) && !empty($unique_id)) {
                $querydata->where(function($query) use ($unique_id) {
                    $query->orwhere('unique_id',$unique_id);
                });
            }
            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->orwhere('unique_id',$search);
                });
            }

             $totaldata = $querydata->count();
             $response = $querydata->offset($start)
                    ->limit($limit)
                    ->get();
            if (!$response) {
                $data = [];
                
            } else {
                $data = $response;
            }
            $datas = array();
            $i = 1;

            foreach ($data as $value) {
                $id = $value->id;
                $row['id'] = $i;
                //$row['is_admin'] = $user->is_admin;
                $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                $row['prepared_time']  = date("h:i A", strtotime($value->prepared_time));
                $row['customer_name'] = $value->customerDetails->name;
                $row['transation_id'] = $value->transationDetails->unique_id ?? '-';
                $row['table_id'] = $value->table_id ?? '-';
                $row['assign_chef_name'] = isset($value->chefDetails->firstname) ? $value->chefDetails->firstname ." ".$value->chefDetails->lastname :'-';
                $row['transation_id'] = $value->transation_id?? '-';
                $row['discount_amount'] = $value->discount_amount ?? 0;
                $row['final_amount'] = $value->final_amount ?? 0;
                $row['shipping_price'] = $value->shipping_price ?? 0;
                $row['price'] = $value->price ?? '-';
                $row['discount_amount'] = $value->customerDetails->discount_amount ?? '-';
                
                if($value->order_in_process==0)
                {
                    $row['status'] ="Pending";
                }
                elseif($value->order_in_process==1)
                {
                    $row['status'] ="Assign";
                }
                else if($value->order_in_process==2)
                {
                    $row['status'] ="Accepted";
                }
                else if($value->order_in_process==3)
                {
                    $row['status'] ="Prepared";
                }
                else if($value->order_in_process==4)
                {
                    $row['status'] ="Delivered";
                }

                $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                if($value->order_in_process == 1)
                {
                    $sel .= "<option value='1' " . ((isset($value->order_in_process) && $value->order_in_process == 1) ? 'Selected' : '') . ">Assign</option>";
                    $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                    $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                    $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                }
                if($value->order_in_process == 2){
                    $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                    $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                    $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                }
                if($value->order_in_process == 3){
                    $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                    $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                }
                if($value->order_in_process == 4){
                    $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                }
                $sel .= "</select>";
                $row['order_in_process'] =$sel; 
                $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
               
                if(!is_null($value->assign_chef_id) && $value->assign_chef_id!=0)
               {
                $query->where("id","!=",$value->assign_chef_id);
               }
                $row['chef'] =$query->get(['id','firstname','unique_id']);
                $options="<select class='form-control select_changes2' onChange=\"select_changes2(this);return false;\">";
                $options.="<option value=''>Assign Chef</option>";
                foreach($row['chef'] as $rs){
                      $id = $rs->id;
                      $options .= "<option data-id=".$value->id." value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                }
                $options .= "</select>";
                $row['assign'] = $options;
                $view = Helper::viewAction(url('/manager/order/show/'),encrypt($value->id));
                $row['action'] = Helper::action($view);
                $datas[] = $row;
            $i++;
            }
            $return = [
                "draw" => intval($draw),
                "recordsFiltered" => intval($totaldata),
                "recordsTotal" => intval($totaldata),
                "data" => $datas
            ];
            return response()->json($return);
        }
    }

    public function assigndata(Request $request){
          if ($request->ajax()) {
              $user= auth()->user();
         
               $limit = $request->input('length');
              $start = $request->input('start');
              //  die;
              $search = $request['search'];
              
              $unique_id = $request['unique_id'];
  
              $orderby = $request['order']['0']['column'];
              $order = $orderby != "" ? $request['order']['0']['dir'] : "";
              $draw = $request['draw'];
        
              $querydata =Orders::where('id','!=',0);
              if($user->is_admin==3)
              {
                  $querydata->where("branch_id",$user->branch_id);
                  $querydata->where("order_in_process",1);

              }
              else if($user->is_admin==4){
                  $querydata->where("assign_chef_id",$user->id);
                  $querydata->where("order_in_process",1);
              }
             
  
              if (!is_null($unique_id) && !empty($unique_id)) {
                  $querydata->where(function($query) use ($unique_id) {
                      $query->orwhere('unique_id',$unique_id);
                  });
              }
              if (!is_null($search) && !empty($search)) {
                  $querydata->where(function($query) use ($search) {
                      $query->orwhere('unique_id',$search);
                  });
              }
  
               $totaldata = $querydata->count();
               $response = $querydata->offset($start)
                      ->limit($limit)
                      ->get();
              if (!$response) {
                  $data = [];
                  
              } else {
                  $data = $response;
              }
              $datas = array();
              $i = 1;
  
              foreach ($data as $value) {
                  $id = $value->id;
                  $row['id'] = $i;
                  //$row['is_admin'] = $user->is_admin;
                  $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                  $row['prepared_time']  = date("h:i A", strtotime($value->prepared_time));
                  $row['customer_name'] = $value->customerDetails->name;
                  $row['transation_id'] = $value->transationDetails->unique_id ?? '-';
                  $row['table_id'] = $value->table_id ?? '-';
                  $row['assign_chef_name'] = isset($value->chefDetails->firstname) ? $value->chefDetails->firstname ." ".$value->chefDetails->lastname :'-';
                  $row['transation_id'] = $value->transation_id?? '-';
                  $row['discount_amount'] = $value->discount_amount ?? 0;
                  $row['final_amount'] = $value->final_amount ?? 0;
                  $row['shipping_price'] = $value->shipping_price ?? 0;
                  $row['price'] = $value->price ?? '-';
                  $row['discount_amount'] = $value->customerDetails->discount_amount ?? '-';
                  
                  if($value->order_in_process==0)
                  {
                      $row['status'] ="Pending";
                  }
                  elseif($value->order_in_process==1)
                  {
                      $row['status'] ="Assign";
                  }
                  else if($value->order_in_process==2)
                  {
                      $row['status'] ="Accepted";
                  }
                  else if($value->order_in_process==3)
                  {
                      $row['status'] ="Prepared";
                  }
                      else if($value->order_in_process==4)
                      {
                          $row['status'] ="Delivered";
                      }
  
                      $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                      if($value->order_in_process == 1)
                      {

                          $sel .= "<option value='1' " . ((isset($value->order_in_process) && $value->order_in_process == 1) ? 'Selected' : '') . ">Assign</option>";
                          $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                      }
                      if($value->order_in_process == 2){
                          $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
  
                      }
                      if($value->order_in_process == 3){
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
  
                      }
                      if($value->order_in_process == 4){
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                      }

  
                      $sel .= "</select>";
                      $row['order_process_status'] = $sel;
                 
                 $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                 if(!is_null($value->assign_chef_id) && $value->assign_chef_id!=0)
                 {
                  $query->where("id","!=",$value->assign_chef_id);
                 }
                  $row['chef'] =$query->get(['id','firstname','unique_id']);
                  $options="<select class='form-control select_changes2' onChange=\"select_changes2(this);return false;\">";
                  $options.="<option value=''>Assign Chef</option>";
                  foreach($row['chef'] as $rs){
                        $id = $rs->id;
                        $options .= "<option data-id=".$value->id." value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                  }
                  $options .= "</select>";
                  $row['assign'] = $options;
                //  $edit = Helper::editAction(url('/manager/order/edit/'),encrypt($value->id));
                  if(auth()->user()->is_admin==4)
                  {
                    $view = Helper::viewAction(url('/chef/order/show/'),encrypt($value->id));
                  }
                  else{
                    $view = Helper::viewAction(url('/manager/order/show/'),encrypt($value->id));
                  }
                  $row['action'] = Helper::action($view);
              
                  $datas[] = $row;
              $i++;
              }
             // dd($datas);
              $return = [
                  "draw" => intval($draw),
                  "recordsFiltered" => intval($totaldata),
                  "recordsTotal" => intval($totaldata),
                  "data" => $datas
              ];
              return response()->json($return);
          }
    }
  

    public function acceptdata(Request $request){
        //  dd($request->All());
          if ($request->ajax()) {
              $user= auth()->user();
         
               $limit = $request->input('length');
              $start = $request->input('start');
              //  die;
              $search = $request['search'];
              
              $unique_id = $request['unique_id'];
  
              $orderby = $request['order']['0']['column'];
              $order = $orderby != "" ? $request['order']['0']['dir'] : "";
              $draw = $request['draw'];
        
              $querydata =Orders::where('id','!=',0);
                if($user->is_admin==3)
                {
                    $querydata->where("branch_id",$user->branch_id);
                    $querydata->where("order_in_process",2);

                    
                }
                else if($user->is_admin==4){
                    $querydata->where("assign_chef_id",$user->id);
                    $querydata->where("order_in_process",2);
                }
             
  
              if (!is_null($unique_id) && !empty($unique_id)) {
                  $querydata->where(function($query) use ($unique_id) {
                      $query->orwhere('unique_id',$unique_id);
                  });
              }
              if (!is_null($search) && !empty($search)) {
                  $querydata->where(function($query) use ($search) {
                      $query->orwhere('unique_id',$search);
                  });
              }
  
               $totaldata = $querydata->count();
               $response = $querydata->offset($start)
                      ->limit($limit)
                      ->get();
              if (!$response) {
                  $data = [];
                  
              } else {
                  $data = $response;
              }
              $datas = array();
              $i = 1;
  
              foreach ($data as $value) {
                  $id = $value->id;
                  $row['id'] = $i;
                  //$row['is_admin'] = $user->is_admin;
                  $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                  $row['prepared_time']  = date("h:i A", strtotime($value->prepared_time));
                  $row['customer_name'] = $value->customerDetails->name;
                  $row['transation_id'] = $value->transationDetails->unique_id ?? '-';
                  $row['table_id'] = $value->table_id ?? '-';
                  $row['assign_chef_name'] = isset($value->chefDetails->firstname) ? $value->chefDetails->firstname ." ".$value->chefDetails->lastname :'-';
                  $row['transation_id'] = $value->transation_id?? '-';
                  $row['discount_amount'] = $value->discount_amount ?? 0;
                  $row['final_amount'] = $value->final_amount ?? 0;
                  $row['shipping_price'] = $value->shipping_price ?? 0;
                  $row['price'] = $value->price ?? '-';
                  $row['discount_amount'] = $value->customerDetails->discount_amount ?? '-';
                  
                  if($value->order_in_process==0)
                  {
                      $row['status'] ="Pending";
                  }
                  elseif($value->order_in_process==1)
                  {
                      $row['status'] ="Assign";
                  }
                  else if($value->order_in_process==2)
                  {
                      $row['status'] ="Accepted";
                  }
                  else if($value->order_in_process==3)
                  {
                      $row['status'] ="Prepared";
                  }
                      else if($value->order_in_process==4)
                      {
                          $row['status'] ="Delivered";
                      }
  
                      $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                      if($value->order_in_process == 1)
                      {

                          $sel .= "<option value='1' " . ((isset($value->order_in_process) && $value->order_in_process == 1) ? 'Selected' : '') . ">Assign</option>";
                          $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                      }
                      if($value->order_in_process == 2){
                          $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                        //  $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
  
                      }
                      if($value->order_in_process == 3){
                          $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
  
                      }
                      if($value->order_in_process == 4){
                          $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                      }

  
  
                      $sel .= "</select>";
                      $row['order_process_status'] = $sel;
                 $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                 if(!is_null($value->assign_chef_id) && $value->assign_chef_id!=0)
                 {
                  $query->where("id","!=",$value->assign_chef_id);
                 }
                  $row['chef'] =$query->get(['id','firstname','unique_id']);
                  $options="<select class='form-control select_changes2' onChange=\"select_changes2(this);return false;\">";
                  $options.="<option value=''>Assign Chef</option>";
                  foreach($row['chef'] as $rs){
                        $id = $rs->id;
                        $options .= "<option data-id=".$value->id." value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                  }
                  $options .= "</select>";
                  $row['assign'] = $options;
                //  $edit = Helper::editAction(url('/manager/order/edit/'),encrypt($value->id));
                  if(auth()->user()->is_admin==4)
                  {
                    $view = Helper::viewAction(url('/chef/order/show/'),encrypt($value->id));
               //     $row['action'] = Helper::action($view);
                  }
                  else{
                    $view = Helper::viewAction(url('/manager/order/show/'),encrypt($value->id));
                 
                  }
                  $row['action'] = Helper::action($view);

                  $datas[] = $row;
              $i++;
              }
             // dd($datas);
              $return = [
                  "draw" => intval($draw),
                  "recordsFiltered" => intval($totaldata),
                  "recordsTotal" => intval($totaldata),
                  "data" => $datas
              ];
              return response()->json($return);
          }
    }
/*
    public function preparendata2(Request $request)
    {
        if ($request->ajax()) {
            $user= auth()->user();
            if(!is_null($user) && $user->is_admin!=0){
                $query =Orders::where('id','!=',0);
                if($user->is_admin==3)
                {
                    $query->where("branch_id",$user->branch_id);
                    $query->where("order_in_process",3);

                    
                }
                else if($user->is_admin==4){
                    $query->where("assign_chef_id",$user->id);
                    $query->where("order_in_process",3);
                }
                $data = $query->get();
          
                if(!empty($data)){
                  foreach($data as $r){
                    $r->is_admin = $user->is_admin;

                    $r->prepared_time  = date("h:i A", strtotime($r->prepared_time));

                   
                       $r->customer_name = $r->customerDetails->name;
                       $r->transation_id = $r->transationDetails->unique_id;
                        $r->assign_chef_name = isset($r->chefDetails->firstname) ? $r->chefDetails->firstname ." ".$r->chefDetails->lastname :'-';
                        if($r->order_in_process==0)
                        {
                            $r->status ="Pending";
                        }
                        elseif($r->order_in_process==1)
                        {
                            $r->status ="Assign";
                        }
                        else if($r->order_in_process==2)
                        {
                            $r->status ="Accepted";
                        }
                        else if($r->order_in_process==3)
                        {
                            $r->status ="Prepared";
                        }
                        else if($r->order_in_process==4)
                        {
                            $r->status ="Delivered";
                        }
                   $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                   if(!is_null($r->assign_chef_id) && $r->assign_chef_id!=0)
                   {
                    $query->where("id","!=",$r->assign_chef_id);
                   }
                    $r->chef =$query->get(['id','firstname','unique_id']);
                    $options="";
                    foreach($r->chef as $rs){
                          $id = $rs->id;
                          $options .= "<select class='form-control' onChange=\"select_changes2('$id',this.value);return false;\">";
                          $options .= "<option value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                          $options .= "</select>";
                        }
                   $r->action = $options;
                }
             }   

             return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    
                    if (!empty($request->get('name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['customer_name'], $request->get('name')) ? true : false;
                    });
                    }
                })
                ->addColumn('order_process_status', function($row){
                    $id = $row->id;
                        $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                        if($row['order_in_process'] == 1)
                        {

                            $sel .= "<option value='1' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 1) ? 'Selected' : '') . ">Assign</option>";
                            $sel .= "<option value='2' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }
                        if($row['order_in_process'] == 2){
                            $sel .= "<option value='2' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($row['order_in_process'] == 3){
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($row['order_in_process'] == 4){
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }

                        $sel .= "</select>";

                        return $sel;
            })
                ->addColumn('assign', function($row){
                    $order_id = $row->id;
                        
                    $ss="<select class='form-control assign_chef' onChange=\"select_changes2('".$order_id."',this.value);return false;\">";
                     
                    if($row['chef']){
                        $ss.="<option value=''>Assign Chef</option>";
                        foreach($row['chef'] as $rs){
                            $ss.="<option value='".$rs->id."'> ".$rs->firstname."</option>";
                      }
                    }
                    $ss.="</select>";
                    return $ss;
                })
                ->addColumn('action', function($row){
                       if($row->is_admin==3)
                       {
                        $btn = '<a href="'.url('manager/order/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                    } 
                    else{
                        $btn = '<a href="'.url('chef/order/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';

                    }
                    return $btn;
                    })->rawColumns(['action','assign','order_process_status'])
                ->make(true);
            
   
            }
            
        }
    }*/

    public function preparendata(Request $request){
        //  dd($request->All());
          if ($request->ajax()) {
              $user= auth()->user();
         
               $limit = $request->input('length');
              $start = $request->input('start');
              //  die;
              $search = $request['search'];
              
              $unique_id = $request['unique_id'];
  
              $orderby = $request['order']['0']['column'];
              $order = $orderby != "" ? $request['order']['0']['dir'] : "";
              $draw = $request['draw'];
        
              $querydata =Orders::where('id','!=',0);
              if($user->is_admin==3)
              {
                  $querydata->where("branch_id",$user->branch_id);
                  $querydata->where("order_in_process",3);
             }
              else if($user->is_admin==4){
                  $querydata->where("assign_chef_id",$user->id);
                  $querydata->where("order_in_process",3);
              }
             
  
              if (!is_null($unique_id) && !empty($unique_id)) {
                  $querydata->where(function($query) use ($unique_id) {
                      $query->orwhere('unique_id',$unique_id);
                  });
              }
              if (!is_null($search) && !empty($search)) {
                  $querydata->where(function($query) use ($search) {
                      $query->orwhere('unique_id',$search);
                  });
              }
  
               $totaldata = $querydata->count();
               $response = $querydata->offset($start)
                      ->limit($limit)
                      ->get();
              if (!$response) {
                  $data = [];
                  
              } else {
                  $data = $response;
              }
              $datas = array();
              $i = 1;
  
              foreach ($data as $value) {
                  $id = $value->id;
                  $row['id'] = $i;
                  //$row['is_admin'] = $user->is_admin;
                  $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                  $row['prepared_time']  = date("h:i A", strtotime($value->prepared_time));
                  $row['customer_name'] = $value->customerDetails->name;
                  $row['transation_id'] = $value->transationDetails->unique_id ?? '-';
                  $row['table_id'] = $value->table_id ?? '-';
                  $row['assign_chef_name'] = isset($value->chefDetails->firstname) ? $value->chefDetails->firstname ." ".$value->chefDetails->lastname :'-';
                  $row['transation_id'] = $value->transation_id?? '-';
                  $row['discount_amount'] = $value->discount_amount ?? 0;
                  $row['final_amount'] = $value->final_amount ?? 0;
                  $row['shipping_price'] = $value->shipping_price ?? 0;
                  $row['price'] = $value->price ?? '-';
                  $row['discount_amount'] = $value->customerDetails->discount_amount ?? '-';
                  
                  if($value->order_in_process==0)
                  {
                      $row['status'] ="Pending";
                  }
                  elseif($value->order_in_process==1)
                  {
                      $row['status'] ="Assign";
                  }
                  else if($value->order_in_process==2)
                  {
                      $row['status'] ="Accepted";
                  }
                  else if($value->order_in_process==3)
                  {
                      $row['status'] ="Prepared";
                  }
                      else if($value->order_in_process==4)
                      {
                          $row['status'] ="Delivered";
                      }
  
                      $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                      if($value->order_in_process == 1)
                        {

                            $sel .= "<option value='1' " . ((isset($value->order_in_process) && $value->order_in_process == 1) ? 'Selected' : '') . ">Assign</option>";
                            $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                           // $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }
                        if($value->order_in_process == 2){
                            $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($value->order_in_process == 3){
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($value->order_in_process == 4){
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }

  
  
                      $sel .= "</select>";
                      $row['order_process_status'] = $sel;
                 $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                 if(!is_null($value->assign_chef_id) && $value->assign_chef_id!=0)
                 {
                  $query->where("id","!=",$value->assign_chef_id);
                 }
                  $row['chef'] =$query->get(['id','firstname','unique_id']);
                  $options="<select class='form-control select_changes2' onChange=\"select_changes2(this);return false;\">";
                  $options.="<option value=''>Assign Chef</option>";
                  foreach($row['chef'] as $rs){
                        $id = $rs->id;
                        $options .= "<option data-id=".$value->id." value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                  }
                  $options .= "</select>";
                  $row['assign'] = $options;
                //  $edit = Helper::editAction(url('/manager/order/edit/'),encrypt($value->id));
                  if(auth()->user()->is_admin==4)
                  {
                    $view = Helper::viewAction(url('/chef/order/show/'),encrypt($value->id));
             
                  //  $row['action'] = Helper::action($view);
                  }
                  else{
                    $view = Helper::viewAction(url('/manager/order/show/'),encrypt($value->id));
                 
                  
                  }
                  $row['action'] = Helper::action($view);

                  $datas[] = $row;
              $i++;
              }
             // dd($datas);
              $return = [
                  "draw" => intval($draw),
                  "recordsFiltered" => intval($totaldata),
                  "recordsTotal" => intval($totaldata),
                  "data" => $datas
              ];
              return response()->json($return);
          }
    }
  /*
    public function deliverndata2(Request $request)
    {
        if ($request->ajax()) {
            $user= auth()->user();
            if(!is_null($user) && $user->is_admin!=0){
                $query =Orders::where('id','!=',0);
                if($user->is_admin==3)
                {
                    $query->where("branch_id",$user->branch_id);
                    $query->where("order_in_process",4);
                }
                else if($user->is_admin==4){
                    $query->where("assign_chef_id",$user->id);
                    $query->where("order_in_process",4);
                }
                $data = $query->get();
          
                if(!empty($data)){
                  foreach($data as $r){
                    $r->is_admin = $user->is_admin;

                    $r->prepared_time  = date("h:i A", strtotime($r->prepared_time));

                   
                       $r->customer_name = $r->customerDetails->name;
                       $r->transation_id = $r->transationDetails->unique_id;
                        $r->assign_chef_name = isset($r->chefDetails->firstname) ? $r->chefDetails->firstname ." ".$r->chefDetails->lastname :'-';
                        if($r->order_in_process==0)
                        {
                            $r->status ="Pending";
                        }
                        elseif($r->order_in_process==1)
                        {
                            $r->status ="Assign";
                        }
                        else if($r->order_in_process==2)
                        {
                            $r->status ="Accepted";
                        }
                        else if($r->order_in_process==3)
                        {
                            $r->status ="Prepared";
                        }
                        else if($r->order_in_process==4)
                        {
                            $r->status ="Delivered";
                        }
                   $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                   if(!is_null($r->assign_chef_id) && $r->assign_chef_id!=0)
                   {
                    $query->where("id","!=",$r->assign_chef_id);
                   }
                    $r->chef =$query->get(['id','firstname','unique_id']);
                    $options="";
                    foreach($r->chef as $rs){
                          $id = $rs->id;
                          $options .= "<select class='form-control' onChange=\"select_changes2('$id',this.value);return false;\">";
                          $options .= "<option value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                          $options .= "</select>";
                        }
                   $r->action = $options;
                }
             }   

             return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    
                    if (!empty($request->get('name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['customer_name'], $request->get('name')) ? true : false;
                    });
                    }
                })
                ->addColumn('order_process_status', function($row){
                    $id = $row->id;
                        $sel = "<select class='form-control' onChange=\"select_changes2('$id',this.value);return false;\">";
                        if($row['order_in_process'] == 1)
                        {

                            $sel .= "<option value='1' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 1) ? 'Selected' : '') . ">Assign</option>";
                            $sel .= "<option value='2' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }
                        if($row['order_in_process'] == 2){
                            $sel .= "<option value='2' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($row['order_in_process'] == 3){
                            $sel .= "<option value='3' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($row['order_in_process'] == 4){
                            $sel .= "<option value='4' " . ((isset($row['order_in_process']) && $row['order_in_process'] == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }

                        $sel .= "</select>";

                        return $sel;
            })
                ->addColumn('assign', function($row){
                    $order_id = $row->id;
                        
                    $ss="<select class='form-control assign_chef' onChange=\"select_changes2('".$order_id."',this.value);return false;\">";
                     
                    if($row['chef']){
                        $ss.="<option value=''>Assign Chef</option>";
                        foreach($row['chef'] as $rs){
                            $ss.="<option value='".$rs->id."'> ".$rs->firstname."</option>";
                      }
                    }
                    $ss.="</select>";
                    return $ss;
                })
                ->addColumn('action', function($row){
                       if($row->is_admin==3)
                       {
                        $btn = '<a href="'.url('manager/order/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                    } 
                    else{
                        $btn = '<a href="'.url('chef/order/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';

                    }
                    return $btn;
                    })->rawColumns(['action','assign','order_process_status'])
                ->make(true);
            
   
            }
            
        }
    }
    */
    public function deliverndata(Request $request){
        //  dd($request->All());
          if ($request->ajax()) {
              $user= auth()->user();
         
               $limit = $request->input('length');
              $start = $request->input('start');
              //  die;
              $search = $request['search'];
              
              $unique_id = $request['unique_id'];
  
              $orderby = $request['order']['0']['column'];
              $order = $orderby != "" ? $request['order']['0']['dir'] : "";
              $draw = $request['draw'];
        
              $querydata =Orders::where('id','!=',0);
              if($user->is_admin==3)
              {
                  $querydata->where("branch_id",$user->branch_id);
                  $querydata->where("order_in_process",4);
              }
              else if($user->is_admin==4){
                  $querydata->where("assign_chef_id",$user->id);
                  $querydata->where("order_in_process",4);
              }
  
              if (!is_null($unique_id) && !empty($unique_id)) {
                  $querydata->where(function($query) use ($unique_id) {
                      $query->orwhere('unique_id',$unique_id);
                  });
              }
              if (!is_null($search) && !empty($search)) {
                  $querydata->where(function($query) use ($search) {
                      $query->orwhere('unique_id',$search);
                  });
              }
  
               $totaldata = $querydata->count();
               $response = $querydata->offset($start)
                      ->limit($limit)
                      ->get();
              if (!$response) {
                  $data = [];
                  
              } else {
                  $data = $response;
              }
              $datas = array();
              $i = 1;
  
              foreach ($data as $value) {
                  $id = $value->id;
                  $row['id'] = $i;
                  //$row['is_admin'] = $user->is_admin;
                  $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                  $row['prepared_time']  = date("h:i A", strtotime($value->prepared_time));
                  $row['customer_name'] = $value->customerDetails->name;
                  $row['transation_id'] = $value->transationDetails->unique_id ?? '-';
                  $row['table_id'] = $value->table_id ?? '-';
                  $row['assign_chef_name'] = isset($value->chefDetails->firstname) ? $value->chefDetails->firstname ." ".$value->chefDetails->lastname :'-';
                  $row['transation_id'] = $value->transation_id?? '-';
                  $row['discount_amount'] = $value->discount_amount ?? 0;
                  $row['final_amount'] = $value->final_amount ?? 0;
                  $row['shipping_price'] = $value->shipping_price ?? 0;
                  $row['price'] = $value->price ?? '-';
                  $row['discount_amount'] = $value->customerDetails->discount_amount ?? '-';
                  
                  if($value->order_in_process==0)
                  {
                      $row['status'] ="Pending";
                  }
                  elseif($value->order_in_process==1)
                  {
                      $row['status'] ="Assign";
                  }
                  else if($value->order_in_process==2)
                  {
                      $row['status'] ="Accepted";
                  }
                  else if($value->order_in_process==3)
                  {
                      $row['status'] ="Prepared";
                  }
                      else if($value->order_in_process==4)
                      {
                          $row['status'] ="Delivered";
                      }
  
                      $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                      
                   //   $sel = "<select class='form-control' onChange=\"select_changes2('$id',this.value);return false;\">";
                        if($value->order_in_process == 1)
                        {

                            $sel .= "<option value='1' " . ((isset($value->order_in_process) && $value->order_in_process == 1) ? 'Selected' : '') . ">Assign</option>";
                            $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }
                        if($value->order_in_process == 2){
                            $sel .= "<option value='2' " . ((isset($value->order_in_process) && $value->order_in_process == 2) ? 'Selected' : '') . ">Accepted</option>";
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($value->order_in_process == 3){
                            $sel .= "<option value='3' " . ((isset($value->order_in_process) && $value->order_in_process == 3) ? 'Selected' : '') . ">Prepared</option>";
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
    
                        }
                        if($value->order_in_process == 4){
                            $sel .= "<option value='4' " . ((isset($value->order_in_process) && $value->order_in_process == 4) ? 'Selected' : '') . ">Delivered</option>";
                        }

                        $sel .= "</select>";
                    $row['order_process_status'] = $sel;
                 $query= User::where(['user_id'=>$user->id,'is_admin'=>4,'status'=>"Active"]);
                 if(!is_null($value->assign_chef_id) && $value->assign_chef_id!=0)
                 {
                  $query->where("id","!=",$value->assign_chef_id);
                 }
                  $row['chef'] =$query->get(['id','firstname','unique_id']);
                  $options="<select class='form-control select_changes2' onChange=\"select_changes2(this);return false;\">";
                  $options.="<option value=''>Assign Chef</option>";
                  foreach($row['chef'] as $rs){
                        $id = $rs->id;
                        $options .= "<option data-id=".$value->id." value=".$id." " . ((isset($rs->id) && $rs->id == $id) ? 'Selected' : '') . ">".$rs->firstname."</option>";
                  }
                  $options .= "</select>";
                  $row['assign'] = $options;
               //   $edit = Helper::editAction(url('/manager/order/edit/'),encrypt($value->id));
                  if(auth()->user()->is_admin==4)
                  {
                    $view = Helper::viewAction(url('/chef/order/show/'),encrypt($value->id));
                  //  $row['action'] = Helper::action($view);
                  }
                  
                  else{
                    $view = Helper::viewAction(url('/manager/order/show/'),encrypt($value->id));
              
                //    $row['action'] = Helper::action($edit." ".$view);

                  }
                  $row['action'] = Helper::action($view);
                
                  $datas[] = $row;
              $i++;
              }
             // dd($datas);
              $return = [
                  "draw" => intval($draw),
                  "recordsFiltered" => intval($totaldata),
                  "recordsTotal" => intval($totaldata),
                  "data" => $datas
              ];
              return response()->json($return);
          }
    }

    public function order_status(Request $request){
        $user = auth()->user();
        if(!is_null($user) && $user->is_admin!=0){
           $order =  Orders::find($request->id);
            if(!is_null($order)){
                $query  = Orders::where("id",$request->id);
                if($user->is_admin==3)
                {
                    $update= $query->update(array('assign_chef_id'=>$request->assign_chef_id,'order_in_process'=>$request->order_in_process));
                }
                else if($user->is_admin==4){
                    $prepared_time = $request->prepared_time;
                    if(!is_null($prepared_time)){
                        $update= $query->update(array('order_in_process'=>$request->order_in_process,'prepared_time'=>$prepared_time));
                    }
                    else{
                        $update= $query->update(array('order_in_process'=>$request->order_in_process));
                    }
                }
                if($update){
                    return response()->json(['status'=>true,"message"=>"Status Change Successfully"]);
                }
                else{
                    return response()->json(['status'=>false,"message"=>"Status Change Failed"]);
                }
            }
            else{
                return redirect('login');
            }
        }
    }

    public function edit($id){
       $data = OrdersItem::where('order_id',decrypt($id))->get();
        if(!empty($data)){
            foreach($data as $row){
                $row->order_id = $row->orderDetails->unique_id;
                $row->customer_name = $row->customerDetails->firstname;
                $row->product_name = $row->productDetails->name;
            }
        }
        if(auth()->user()->is_admin==3)
        {
            return view('manager/order/show',compact('data'));
        }
        else if(auth()->user()->is_admin==4){
            return view('chef/order/show',compact('data'));

        }
    }

    public function show($id){
        $data = OrdersItem::where('order_id',decrypt($id))->get();
        if(!empty($data)){
            foreach($data as $row){
                $row->order_id = $row->orderDetails->unique_id;
                $row->customer_name = $row->customerDetails->firstname;
                $row->product_name = $row->productDetails->name;
            }
        }
        if(auth()->user()->is_admin==3)
        {
            return view('manager/order/show',compact('data'));
        }
        else if(auth()->user()->is_admin==4){
            return view('chef/order/show',compact('data'));

        }
    
    }

    public function order_process_change(Request $request){
        $user = auth()->user();
        if(!is_null($user) && $user->is_admin!=0){
           $order =  Orders::find($request->id);
          // $order =  Orders::find($request->id);
           if(!is_null($order)){
               $query  = Orders::where("id",$request->id);
               if(!empty($request->order_in_process))
               {
                $update= $query->update(array('order_in_process'=>$request->order_in_process));
               }
               if($update){
                   return response()->json(['status'=>true,"message"=>"Status Change Successfully"]);
               }
               else{
                   return response()->json(['status'=>false,"message"=>"Status Change Failed"]);
               }
           }
           else{
               return redirect('login');
           }

        }
    }
//<<<<<<< HEAD

//=======
    public function custom_order_request(){
        if(auth()->user()->is_admin==4)
        {
            return view('chef/custom_order/custom_order_request');
        }else{
            return redirect('login');
        }
    }

    public function custom_order_requestdata(Request $request){
      
        if($request->ajax()) {
            $user= auth()->user();
            $limit = $request->input('length');
            $start = $request->input('start');
            $search = $request['search'];
            $unique_id = $request['unique_id'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];

            $querydata =CustomOrders::where("id","!=",0);
            if(auth()->user()->is_admin==3)
            {
                $querydata->where('user_id','=',$user->id);
            }
            else if(auth()->user()->is_admin==4){
                $querydata->where('user_id','=',$user->user_id);
            }
            $totaldata = $querydata->count();
            $response = $querydata->offset($start)
                    ->limit($limit)
                    ->get();
            if (!$response) {
                $data = [];
              } else {
                  $data = $response;
              }
            $datas = array();
            $i = 1;
  
            foreach ($data as $value) {
                  $id = $value->id;
                  $row['id'] = $i;
                  $row['unique_id'] = $value->unique_id ?? "-";
                  $row['category_id'] = $value->uniqye->name ?? '-';
                 
                  $row['category_id'] = $value->categoryDetails->name ?? '-';
                  $row['sub_category_id'] = $value->menuDetails->name ?? '-';
                  $row['qty'] = $value->qty ?? '-';
                  $row['price'] = $value->price ?? '-';
                  $row['total_price'] = isset($value->total_price) ? $value->total_price :'-';
                  $row['payment_mode'] = $value->payment_mode?? '-';
                  $row['status'] = $value->order_status;
             
                    $sel = "<select class='form-control' onChange=\"select_changes3('$id',this.value);return false;\">";
                 
                    if($value->order_status == 'Pending')
                    {
                        $sel .= "<option value='Pending' " . ((isset($value->status) && $value->status == "Pending") ? 'Selected' : '') . ">Pending</option>";
                        $sel .= "<option value='Accept' " . ((isset($value->status) && $value->status == "Accept") ? 'Selected' : '') . ">Accept</option>";
                        $sel .= "<option value='Delived' " . ((isset($value->status) && $value->status == 'Delived') ? 'Selected' : '') . ">Delived</option>";
                    }
                    if($value->order_status == 'Accept')
                    {
                        $sel .= "<option value='Accept' " . ((isset($value->status) && $value->status == 'Accept') ? 'Selected' : '') . ">Accept</option>";
                        $sel .= "<option value='Delived' " . ((isset($value->status) && $value->status == 'Delived') ? 'Selected' : '') . ">Delived</option>";
                    }
                    if($value->order_status == 'Delived')
                    {
                        $sel .= "<option value='Delived' " . ((isset($value->status) && $value->status == "Delived") ? 'Selected' : '') . ">Delived</option>";
                    }
                    $sel .= "</select>";
                    $row['order_status'] = $sel;
                  $row['action'] =$querydata->get();
                  $datas[] = $row;
              $i++;
              }
             // dd($datas);
              $return = [
                  "draw" => intval($draw),
                  "recordsFiltered" => intval($totaldata),
                  "recordsTotal" => intval($totaldata),
                  "data" => $datas
              ];
              return response()->json($return);
          }
    }
    public function custom_order_status_change(Request $request){
        
        if(auth()->user()->is_admin==4){
           $update= CustomOrders::where("id",$request->id)->update(['order_status'=>$request->status]);
            if($update)
            {
                return ['status'=>true,'type'=>'success','message'=>"Status Change Successfully"];
            }
            else{
                return ['status'=>true,'type'=>'success','message'=>"Status Change Successfully"];
         
            }
          
        }
    }
//>>>>>>> cc16d6d45065aaf089e56f63107ec1c6eebac0ca
}
