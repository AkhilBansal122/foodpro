<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProductCatalogues;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Session;

use App\Models\Orders;
use App\Models\Orders_product_item;
use Helper;
use Str;
use DB;
use App\Models\Transations;

class LoginController extends Controller
{
    public function index(){
     return view("admin/login");
    }
    public function test(){
        return view('test');
    }

    public function checkLogin(Request $request){
        if(!empty($request->All()))
        {
            $input = $request->all();
            //Select user data form database
            $user = User::where('email', $request->email)->first();
          
            //Check password hash
            if(!$user || !Hash::check($request->password, $user->password)){
                   return redirect()->back()->with('error','Invalid Login Details');
                
            } else {
           
                if(isset($input["remember_me"]))
                {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('admin_email', $input['email'], $hour);
                    setcookie('admin_password', $input['password'], $hour);
                    setcookie('admin_remember_me', $input['remember_me'], $hour);
                }else{
                    setcookie("admin_email","");
                    setcookie("admin_password","");
                    setcookie("admin_remember_me","");
                }

                session(['userId' => $user->id]);
                return redirect('admin/dashboard');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        $total_register_customer = User::where(['user_type'=>3])->count();
        $no_of_seller = User::where(['user_type'=>1])->count();
        $no_of_manufacture = User::where(['user_type'=>2])->count();
        $no_of_product = ProductCatalogues::count();

        $most_order = DB::table('orders')
                 ->orderby('id','desc')
                 ->limit(10)
                 ->get();
        if(!empty($most_order))
        {
            foreach($most_order as $row){
                $get_order_product_item= Orders_product_item::where("order_id",$row->id)->sum('quantity');
                $row->total_qty = isset($get_order_product_item) ? $get_order_product_item :0;
            }
        }
        
        $most_product = DB::table('orders_product_items')
        ->select('orders_product_items.product_id',
        DB::raw('count(orders_product_items.product_id) as total'))
        ->groupBy('orders_product_items.product_id')
        ->orderby('total','desc')
        ->limit(10)
        ->get();
        $most_product_count  =0;
        if(!empty($most_product)){
            foreach($most_product as $row){
                  if(!empty($row->product_id)){
                    $most_product_count++;
                    $getProduct =ProductCatalogues::where("id",$row->product_id)->first();
                    $row->product_name = isset($getProduct->product_name) ? $getProduct->product_name :'';
                }
            }
        }
        
        $transation = Transations::OrderByDesc("id")->limit(10)->get();
        $total_transtion =0;
        if(!empty($transation)){
            foreach($transation as $row)
            {
                $total_transtion=$total_transtion+$row->amount;
            }
        }
        return view("admin/dashboard",compact('total_register_customer','most_product','no_of_product','most_order','most_product_count','total_transtion','no_of_seller','no_of_manufacture'));
    }

    public function forgotPassword(Request $request){

        if(!empty($request->all()))
        {
            $userDetails = User::where('email',$request->email)->first();
            if(!empty($userDetails))
            {
                $message="";
               $token = Helper::random_token();
               $userDetails->remember_token = $token;
               $userDetails->save();
               $url =url('resetpassword')."/".$token;
                $message.="<a href=".$url.">Click Here</a>";
                 $email_tmplate_send=   Helper::setEmailTemplate(1,$userDetails,$message);//Id 1 for Forget Password Email Template
                $response = Helper::composeEmail($email_tmplate_send,"Forgot Password",$request->email);
                if($response)
                {
                    return redirect()->back()->with("msg","Please Check Your Email For Forgot Password");
                }
                else{
                    return redirect()->back()->with("error","Mail Send Fail");
                }
            }
            else{
                return redirect()->back()->with("error","Invalid Email Address");
            }
        }
        else{
            return view('admin/forgotPassword');

        }
    }
    //reset password for Forget 
    public function resetpassword(Request $request,$token = null)
    {
        if(!empty($request->all()))
        {
            $user_token = $request->user_token;
            $userCheck = User::where('remember_token',$user_token)->first();
        
            if(is_null($userCheck))
            {
                return redirect('forgot-password')->with('error',"Ivalid Token Please Try Again");
            }
            else
            {   
                if(!empty($request->all()))
                {
                    $validatedData = $request->validate([
                        'password' =>'required|min:8',
                        'cpassword' => 'required|min:8|same:cpassword'
                    ]);

                    $password = $request->password;
                    $cpassword = $request->cpassword;
                    if($password != $cpassword)
                    {
                        return redirect()->back()->with('error',"New Password And Confirm Password are Not Match");
                    }
                    else
                    {
                        $userCheck->password=Hash::Make($password); 
                        $userCheck->userpassword = $password;
                        $userCheck->save();
                        return redirect('/')->with('msg',"Reset Password Successfully");
                    }
                }
            }
        }
        else{
            $userCheck = User::where('remember_token',$token)->first();
            if(!empty($userCheck))
            {
                return view('admin/resetpassword',compact('token'));
            }
            return view('admin/resetpassword',compact('token'));
        }
    }

    public function settings(Request $request){
        if(auth()->user())
        {
            $userDetails=User::where("id",auth()->user()->id)->first();
            if(!empty($request->all()))
            {
                $CheckEmail=User::where("id","!=",auth()->user()->id)->where("email",$request->email)->first();
                if(is_null($CheckEmail))
                {
                    $validatedData = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email',
                        'password' =>'required|min:8',
                      ]);
                      
                    $data= array(
                        'name'=> isset($request->name) ? $request->name :$userDetails->name,
                        'email'=> isset($request->email) ? $request->email :$userDetails->email,
                        'password'=> isset($request->password) ? Hash::Make($request->password) :$userDetails->password,
                        'upassword'=> isset($request->password) ? $request->password :$userDetails->userpassword,

                        'facebook'=> isset($request->facebook) ? $request->facebook :$userDetails->facebook,
                        'youtube'=> isset($request->youtube) ? $request->youtube :$userDetails->youtube,
                        'twitter'=> isset($request->twitter) ? $request->twitter :$userDetails->twitter,
                        'instagram'=> isset($request->instagram) ? $request->instagram :$userDetails->instagram ,
                        'linkedin'=> isset($request->linkedin) ? $request->linkedin :$userDetails->linkedin,
                        'shipping_price'=> isset($request->shipping_price) ? $request->shipping_price :$userDetails->shipping_price
                    );

                   $response =  User::where("id",$userDetails->id)->update($data);
                    if($response)
                    {
                        return redirect()->back()->with('msg',"Setting Changes Successfully"); 

                    }
                    else{
                        return redirect()->back()->with('error',"Setting Changes Failed"); 
                    }
                }
                else
                {
                    return redirect()->back()->with('error',"Email Address Already Register"); 
                }
            }
            else{
                return view('admin/settings',compact('userDetails'));
    
            }
        }
        else{
            return redirect('/')->where('error',"Please Login Then Access Page");
        }
    }

    //change_password for admin
    public function change_password(Request $request)
    {
        if($request->all())
         {
            $getUser = User::where("id",auth()->user()->id)->first();
            $validatedData = $request->validate([
                'password' => 'required',
                'new_password' =>'required|min:8',
                'confirm_password' => 'required|same:new_password'
              ]);
             if(!\Hash::check($request->password, $getUser->password)){
                return back()->with('error','You have entered wrong password');
           }
        if (Hash::check($request->new_password, $getUser->password)) { 
            return back()->with('error','new password should not be same as old password');
         }
        if (Hash::check($request->password, $getUser->password)) { 
           $getUser->fill([
            'password' => Hash::make($request->new_password),
            'upassword' =>$request->new_password
            ])->save();
            return back()->with('msg','Password changed successfully');
        } else {
            return back()->with('error','Password does not match');
        }
    }
    else{
        if(auth()->user()->is_admin==1)
        {
            return view('admin/change_password');
        }
        else if(auth()->user()->is_admin==2)
        {
            return view('restaurent/change_password');
        }
    }    
}

    public function logout(){
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
