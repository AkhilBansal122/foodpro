<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tables;
use App\Models\Category;
use App\Models\SubCategories;
use App\Models\Contact;
use App\Models\CartItem;
use App\Models\Banners;
use App\Models\Service;
use App\Models\Cart;

use Auth;
use Session;
class WebsiteController extends Controller
{
    public function indexold($id){
        
        if(substr($id, 0, 4)==="TBL-")
        {
            // dd($id);
            Session::put("table_id",$id);
            if(is_null(auth()->user()))
            {
                return view('website.sign_up_in',compact('id'));
            }
            else if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;
                $getChefData="";
                if(!empty($id)){
                 $getMenu = Tables::where('unique_id',$id)->first();
              // dd( $getMenu);
                 $getBanner = Banners::select('title','images','description')->where('user_id',$getMenu->restaurent_id)->first(); 
                $getservices = Service::select('title','icon','description')->where(['user_id'=>$getMenu->restaurent_id,'status'=>'Active'])->get(); 
                
                  if(!is_null($getMenu)){
                        $manager_id = $getMenu->user_id;
                        $getChefData = User::where(['user_id'=>$manager_id,'is_admin'=>4,'status'=>"Active"])->get();
                        Session::put("restaurent_id",$getMenu->restaurent_id);
                        $getmenu= Category::where("user_id",$getMenu->restaurent_id)->where('status','Active')->take(3)->get(['id','name','image']);
                        if(!empty($getmenu)){
                            foreach($getmenu as $row){
                                $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                                $row->sub_menu = $getSub;
                            }
                        }
                        $getMenu->menu  = $getmenu;
                    }
                    $restaurentName="";
                    return view('website.layout.main',compact('getMenu','getChefData','restaurentName','getBanner','getservices'));
                }
            }
        }
        else{
           $restaurentName= $id;
           $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();


           $manager_id = [];
           $getMenu =[];
           $getBanner=null;
           $getservices = null;
           if(!is_null($getRestaurent)){
           $getAllManager= User::where("user_id",$getRestaurent->id)->where("is_admin",3)->where("status",'Active')->get(['id']);
            $getBanner = Banners::select('title','images','description')->where('user_id',$getRestaurent->id)->first(); 
            if(!empty($getAllManager)){
                foreach($getAllManager as $m){
                    array_push($manager_id,$m->id);
                }
            }
              $getservices = Service::select('title','icon','description')->where(['user_id'=>$getRestaurent->id,'status'=>'Active'])->get(); 
              
            
            $getmenus= Category::where("user_id",$getRestaurent->id)->where('status','Active')->take(3)->get(['id','name','image']);
            if(!empty($getmenus)){
                foreach($getmenus as $row){
                    $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                    $row->sub_menu = $getSub;
                    array_push($getMenu,$row);
                }
            }
           } 
           $getChefData = User::whereIn('user_id',$manager_id)->where(['is_admin'=>4,'status'=>"Active"])->get();
            return view('website.layout.main',compact('getMenu','getChefData','restaurentName','getBanner','getservices'));
        }
    }

    public function index($id){
        
        if(substr($id, 0, 4)==="TBL-")
        {
            // dd($id);
            Session::put("table_id",$id);
            if(is_null(auth()->user()))
            {
                return view('website.sign_up_in',compact('id'));
            }
            else if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;
                $getChefData="";
                if(!empty($id)){
                 $getMenu = Tables::where('unique_id',$id)->first();
              // dd( $getMenu);
                 $getBanner = Banners::select('title','images','description')->where('user_id',$getMenu->restaurent_id)->first(); 
                $getservices = Service::select('title','icon','description')->where(['user_id'=>$getMenu->restaurent_id,'status'=>'Active'])->get(); 
                
                  if(!is_null($getMenu)){
                        $manager_id = $getMenu->user_id;
                        $getChefData = User::where(['user_id'=>$manager_id,'is_admin'=>4,'status'=>"Active"])->get();
                        Session::put("restaurent_id",$getMenu->restaurent_id);
                        $getmenu= Category::where("user_id",$getMenu->restaurent_id)->where('status','Active')->take(3)->get(['id','name','image']);
                        if(!empty($getmenu)){
                            foreach($getmenu as $row){
                                $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                                $row->sub_menu = $getSub;
                            }
                        }
                        $getMenu->menu  = $getmenu;
                    }
                    $restaurentName="";
                    return view('website.layout.main',compact('getMenu','getChefData','restaurentName','getBanner','getservices'));
                }
            }
        }
        else{
           $restaurentName= $id;
           $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();
         
           Session::put("table_id",$id);
          

           $manager_id = [];
           $getMenu =[];
           $getBanner=null;
           $getservices = null;
           if(!is_null($getRestaurent)){
           $getAllManager= User::where("user_id",$getRestaurent->id)->where("is_admin",3)->where("status",'Active')->get(['id']);
            $getBanner = Banners::select('title','images','description')->where('user_id',$getRestaurent->id)->first(); 
            if(!empty($getAllManager)){
                foreach($getAllManager as $m){
                    array_push($manager_id,$m->id);
                }
            }
              $getservices = Service::select('title','icon','description')->where(['user_id'=>$getRestaurent->id,'status'=>'Active'])->get(); 
              
            
            $getmenus= Category::where("user_id",$getRestaurent->id)->where('status','Active')->take(3)->get(['id','name','image']);
            if(!empty($getmenus)){
                foreach($getmenus as $row){
                    $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                    $row->sub_menu = $getSub;
                    array_push($getMenu,$row);
                }
            }
           } 
           $getChefData = User::whereIn('user_id',$manager_id)->where(['is_admin'=>4,'status'=>"Active"])->get();
            return view('website.layout.main',compact('getMenu','getChefData','restaurentName','getBanner','getservices'));
        }
    }

    public function about($id = null){//restaurent Id

        $restaurentName="";
        if(substr($id, 0, 4)==="TBL-")
        {
            if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;
            }
           Session::get('restaurent_id');
            $getMenu = Tables::where('unique_id',Session::get('table_id'))->first();
            $getChefData = User::where(['user_id'=>$getMenu->user_id,'is_admin'=>4,'status'=>"Active"])->get();
        }
        else{
            $restaurentName= $id;
            $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();
            $manager_id = [];
            $getMenu =[];
            if(!is_null($getRestaurent)){
            $getAllManager= User::where("user_id",$getRestaurent->id)->where("is_admin",3)->where("status",'Active')->get(['id']);
             if(!empty($getAllManager)){
                 foreach($getAllManager as $m){
                     array_push($manager_id,$m->id);
                 }
             }
 
             
             $getmenus= Category::where("user_id",$getRestaurent->id)->where('status','Active')->take(3)->get(['id','name','image']);
             if(!empty($getmenus)){
                 foreach($getmenus as $row){
                     $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                     $row->sub_menu = $getSub;
                     array_push($getMenu,$row);
                 }
             }
            } 
            $getChefData = User::whereIn('user_id',$manager_id)->where(['is_admin'=>4,'status'=>"Active"])->get();
        }
        return view('website.about',compact('getChefData','restaurentName'));
  
    }

    public function service($id = null){
        $restaurentName="";
        if(substr($id, 0, 4)==="TBL-")
        {
            $getMenu = Tables::where('unique_id',$id)->first();
            $getservices = Service::select('title','icon','description')->where(['user_id'=>$getMenu->restaurent_id,'status'=>'Active'])->get();   
            if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;
            }
        }
        else
        {
            $restaurentName = $id;
            $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();

            $getservices = Service::select('title','icon','description')->where(['user_id'=>$getRestaurent->id,'status'=>'Active'])->get(); 

        }
       return view('website.service',compact('restaurentName','getservices'));
    }
    

    public function menu($id = null){
       
        $restaurentName="";
        if(substr($id, 0, 4)==="TBL-")
        {
            if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;
            }
            $getMenus = Tables::where('unique_id',auth()->user()->table_id)->first();
        //    dd($getMenus);  
            $getMenu= Category::where("user_id",$getMenus->restaurent_id)->where('status','Active')->get(['id','name','image']);
            $getChefData = User::where(['user_id'=>$getMenus->manager_id,'is_admin'=>4,'status'=>"Active"])->get();
      
           if(!empty($getMenu)){
                foreach($getMenu as $row){
                   $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                   $row->sub_menu = $getSub;
                }
            }
        }
        else
        {
            $restaurentName= $id;
           $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();
           $manager_id = [];
           $getMenu =[];
           if(!is_null($getRestaurent)){
           $getAllManager= User::where("user_id",$getRestaurent->id)->where("is_admin",3)->where("status",'Active')->get(['id']);
            if(!empty($getAllManager)){
                foreach($getAllManager as $m){
                    array_push($manager_id,$m->id);
                }
            }

            $getmenus= Category::where("user_id",$getRestaurent->id)->where('status','Active')->take(3)->get(['id','name','image']);
            if(!empty($getmenus)){
                foreach($getmenus as $row){
                    $getSub = SubCategories::where("category_id",$row->id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
                    $row->sub_menu = $getSub;
                    array_push($getMenu,$row);
                }
            }
           } 
           $getChefData = User::whereIn('user_id',$manager_id)->where(['is_admin'=>4,'status'=>"Active"])->get();
            
        }
        return view('website.menu',compact('getMenu','getChefData','restaurentName','id'));
    }

    public function booking($id = null){
        if(auth()->user()->is_admin==5){
            auth()->user()->table_id = $id;
        }
        Session::get('table_id');
        Session::get('restaurent_id');
    
        return view('website.booking');
    }

    public function team($id = null){
        if(auth()->user()->is_admin==5){
            auth()->user()->table_id = $id;
        }
        Session::get('table_id');
        Session::get('restaurent_id');
        return view('website.team');
    }
    public function testimonial($id = null){
        if(auth()->user()->is_admin==5){
            auth()->user()->table_id = $id;
        }
    	return view('website.testimonial');
    }

    public function contact($id, Request $request){
        $post = new Contact;
       $user_id="";

      $restaurentName="";
      if(substr($id, 0, 4)==="TBL-")
      {
          $gettables = Tables::where("unique_id",$id)->first();
          $user_id = $gettables->user_id;

          // Create a new instance of the model
        
          // Set the properties with the data from the form
          $post->name = $request->input('name');
          // dd($post->name);
          $post ->user_id=$user_id;
          $post->email = $request->input('email');
          $post->subject = $request->input('subject');
          $post->message = $request->input('message');

          // Save the data in the database
          $post->save();

          if(auth()->user()->is_admin==5){
              auth()->user()->table_id = $id;

          }
          // Session::get('table_id');
          // Session::get('restaurent_id');
      }
      else{
            $restaurentName = $id;
          $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();

          // $getservices = Service::select('title','icon','description')->where(['user_id'=>$getRestaurent->id,'status'=>'Active'])->get();
          // Create a new instance of the model
        
          // Set the properties with the data from the form
          $post->name = $request->input('name');
          // dd($post->name);
          $post ->user_id=$getRestaurent->user_id;
          $post->email = $request->input('email');
          $post->subject = $request->input('subject');
          $post->message = $request->input('message');

          // Save the data in the database
          $post->save();

      }

      return view('website.contact',compact('restaurentName','post'));
  }

    public function contactold($id, Request $request){
          $post = new Contact;
         $user_id="";

        $restaurentName="";
        if(substr($id, 0, 4)==="TBL-")
        {
            $gettables = Tables::where("unique_id",$id)->first();
            $user_id = $gettables->user_id;

            // Create a new instance of the model
          
            // Set the properties with the data from the form
            $post->name = $request->input('name');
            // dd($post->name);
            $post ->user_id=$user_id;
            $post->email = $request->input('email');
            $post->subject = $request->input('subject');
            $post->message = $request->input('message');

            // Save the data in the database
            $post->save();

            if(auth()->user()->is_admin==5){
                auth()->user()->table_id = $id;

            }
            // Session::get('table_id');
            // Session::get('restaurent_id');
        }
        else{
              $restaurentName = $id;
            $getRestaurent = User::where("name",$restaurentName)->where('is_admin',2)->first();

            // $getservices = Service::select('title','icon','description')->where(['user_id'=>$getRestaurent->id,'status'=>'Active'])->get();
            // Create a new instance of the model
          
            // Set the properties with the data from the form
            $post->name = $request->input('name');
            // dd($post->name);
            $post ->user_id=$getRestaurent->user_id;
            $post->email = $request->input('email');
            $post->subject = $request->input('subject');
            $post->message = $request->input('message');

            // Save the data in the database
            $post->save();

        }

        return view('website.contact',compact('restaurentName','post'));
    }

    public function getsub_menu_by_menu_id(Request $request,$id){
        
        if(!empty($request->all())){
            $menu_id = $request->menu_id;
            $tab_id = $request->tab_id;
             $getSub = SubCategories::where("category_id",$menu_id)->where('status','Active')->get(['id','name','category_id','discount','image','price','description']);
          $respose="";
            if(!empty($getSub)){
                $respose.='<div id="tab-'.$tab_id.'"  class="tab-pane fade show p-0 active " >
                <div class="row g-4">';
                foreach($getSub as $i =>$row){
                    $respose.='<div class="col-lg-6">
                                    <div class="card shadow-sm">
                                    <img class="bd-placeholder-img card-img-top" width="100%" height="165px" src="'.asset('public/').$row->image.'" alt="" srcset="">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                           <div class="btn-group">
                                              <p>'.$row->name.'</p>
                                           </div>
                                           <small class="text-body-secondary">'.$row->price.'</small>
                                        </div>

                                            <small class="fst-italic">'.$row->description.'</small><br></br>
                                             <button type="button"
                                                data-table_id="'.$tab_id.'"
                                                data-id="'.$row->id.'"
                                               data-price="'.$row->price.'"
                                               data-seleted ="1"
                                                
                                              class="addtocart btn btn-sm btn-outline-secondary" ><b>Add to cart</b></button>
                                    </div>
                                 </div>
                                </div>';
                   }
            }

            //onClick="add_to_cart("'.auth()->user()->table_id.'",'.$row->id.','.$row->price.',1);return false;"
            if(!empty($respose)){
                return response()->json(['status'=>true,"data"=>$respose]);
            }
            else{
                return response()->json(['status'=>false,"data"=>$respose]);

            }
        }
    }

    public function login(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'emaillogin' => 'required|email',
            'loginpassword' => 'required',
        ],[
            'emaillogin.required'=>"Please enter email address",
            'loginpassword.required'=>"Please enter password"
        ]);
    
        $url = url('/')."/".$request->table_id;

        
        if(auth()->attempt(array('email' => $input['emaillogin'], 'password' => $input['loginpassword'])))
        {
            auth()->user()->table_id = $request->table_id;
          //  dd(auth()->user());
          //  Session::put('table_id',1111111);
            $url = url('/')."/".$request->table_id;

            if(!is_null(auth()->user()) && auth()->user()->status=='Active'){
                if (auth()->user()->is_admin == 5) {// customer
              
                    return redirect($url);
                }else{
                    return redirect()->back()
                    ->with('error','InAuthotize User');
                }}else{
               $this->logout($url);
               return redirect($url)
                ->with('error','InActive Your account please contact support team.');
            }
        }
        else
        { 
            return redirect($url)->with('error','Email-Address And Password Are Wrong.');
        }
        
    }
    //user signup data store in database
    public function user_signup_store(Request $request){
       
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile_number' => 'required|min:10|max:12',
            'email' =>'required|email|unique:users',
            'password' => 'required'
        ],[
            'firstname.required'=>"Please enter first name",
            'lastname.required'=>"Please enter last name",
            'mobile_number.required'=>"Please enter mobile number",
            'email.required'=>"Please enter email address",
            'password.required'=>"Please enter password"
        ]);
        
        $table_id = $request->table_id;
        $TablesData = Tables::where("unique_id",$table_id)->first();
       $branch_id=  $TablesData->get_manager->branch_id;

        $signup_store = new User;
        $signup_store->firstname = $request['firstname'];
        $signup_store->lastname = $request['lastname'];
        $signup_store->mobile_number = $request['mobile_number'];
        $signup_store->email = $request['email'];
        $signup_store->password = bcrypt($request['password']);
        $signup_store->upassword = $request['password'];
        $signup_store->is_admin = 5;
        $signup_store->name = $request->firstname .$request->lastname;
        $signup_store->branch_id = $branch_id;
      
        $signup_store->user_id = $TablesData->restaurent_id;
        $signup_store->save();
        $signup_store->unique_id = "CUS-000".$signup_store->id;
        $signup_store->save();
        return redirect()->back();
    }

    //thenkYou
    public function thenkYou(){
        $restaurentName="";
        return view('website.thanks',compact('restaurentName'));
      
    }
    public function logout(){
         Auth::Logout();
        return redirect('thenkYou');
    }

    //CartItem
    public function cartItem($id){
        
        if(auth()->user()->is_admin==5){
            auth()->user()->table_id = $id;
        }
        
        return view('website.cartItem',compact('id'));

    }   
    
    public function cartItemList(Request $request,$id){
        $result =[];
        if(auth()->user()->is_admin==5){
           $getCart = Cart::where("user_id",auth()->user()->id)->first();
           if($getCart){
            $getCartDetails = CartItem::where("user_id",auth()->user()->id,"cart_id",$getCart->cart_id)->get();
            
            foreach($getCartDetails as $r){
                $r->product_name = $r->productDetails->name;
                $r->catagory_name = $r->productDetails->menuDetails->name;
                $r->product_image =asset('public'). $r->productDetails->image;
            }
            //dd($getCartDetails);
            $result['status'] = true;
            $result['data'] = $getCartDetails;
            $result['cart'] = $getCart;
            }   
            else
            {
            $result['status'] = false;
            $result['data'] = [];
            $result['cart'] = [];
           }
         ///  dd($result);
           return response()->json($result);

        }
    }

    public function shipping_address(){
            return view('website.shipping');
        }
}