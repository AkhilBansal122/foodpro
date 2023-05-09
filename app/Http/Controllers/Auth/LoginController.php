<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    protected $redirectTo = '/';

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {   
        $input = $request->all();
     //   dd($input);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
//dd($input);
        if(auth()->attempt(['email'=>$input['email'],'password'=>$input['password']]))
        {
 
         //  dd(auth()->user()->status);
            if(!is_null(auth()->user()) && auth()->user()->status=='Active'){
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
                if(auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.dashboard')->with("success","Login Successfully");
                }
                else  if (auth()->user()->is_admin == 2) {
                    return redirect()->route('restaurent.dashboard')->with("success","Login Successfully");
                }
                else  if (auth()->user()->is_admin == 3) {
                    return redirect()->route('manager.dashboard')->with("success","Login Successfully");
                }
                else  if (auth()->user()->is_admin == 4) {// chef
                    return redirect()->route('chef.dashboard')->with("success","Login Successfully");;
                } 
                else  if (auth()->user()->is_admin == 6) {// werehouse
                    return redirect()->route('warehouse.dashboard')->with("success","Login Successfully");;
                } 
                else{
                return redirect()->back()
                    ->with('error','InAuthotize User');
                }
            }else{
               $this->logout();
                return redirect()->back()
                ->with('error','InActive Your account please contact support team.');
            }
        }else{
            return redirect()->back()
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
    public function settings(Request $request){
        if(session::has('userId'))
        {
            $userDetails=User::where("id",session::has('userId'))->first();


            if(!empty($request->all()))
            {
                $CheckEmail=User::where("id","!=",session::has('userId'))->where("email",$request->email)->first();
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
                        'userpassword'=> isset($request->password) ? $request->password :$userDetails->userpassword,

                        'facebook'=> isset($request->facebook) ? $request->facebook :$userDetails->facebook,
                        'youtube'=> isset($request->youtube) ? $request->youtube :$userDetails->youtube,
                        'twitter'=> isset($request->twitter) ? $request->twitter :$userDetails->twitter,
                        'instagram'=> isset($request->instagram) ? $request->instagram :$userDetails->instagram ,
                        'linkedin'=> isset($request->linkedin) ? $request->linkedin :$userDetails->linkedin,
                        'address1'=> isset($request->address1) ? $request->address1 :$userDetails->address1,
                        'address2'=> isset($request->address2) ? $request->address2 :$userDetails->address2,
                        'play_store'=> isset($request->play_store) ? $request->play_store :$userDetails->play_store,
                        'app_store'=> isset($request->app_store) ? $request->app_store :$userDetails->app_store,
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
    public function logout(){
      
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
