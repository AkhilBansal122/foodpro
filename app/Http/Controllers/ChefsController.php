<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use File;
use DataTables;
use Str;
use Validator;
use Redirect;
use DB;
use Helper;
class ChefsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if(!is_null($user)){
            $query =User::where('id','!=',0);
            if($user->is_admin==2)
            {
             $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            if($user->is_admin==3){
                return view('manager/chefs/index',compact('data'));
            }
            else if($user->is_admin==1){
            $restaurentList = User::where('is_admin',2)->get();
            return view('admin/chefs/index',compact('restaurentList'));
            }
            else if($user->is_admin==2){
                $restaurentList = User::where('is_admin',2)->get();
                return view('restaurent/chefs/index',compact('restaurentList','data'));
                }
        }else{
            return redirect('login');
        }
    }

    public function create(){

        $user = auth()->user();
        $page = "";
        $data="";
        $getChecked = User::where(['user_id'=>$user->id,'is_admin'=>3])->where('branch_id',"!=",0)->get(['branch_id']);
        if(!is_null($user)){
            if($user->is_admin==3){
                return view('manager/chefs/create',compact('data'));
            }
        }else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
   
        //   dd($request->all());
        $user = auth()->user();
        if(!is_null($user)){
        if($user->id_admin==3)
        {
         $validator=   $request->validate([
                'firstname' => 'required',
                'lastname'=>'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'aadhar_card' => 'required|max:20|min:16',
                'mobile_number' => 'required|max:12|min:10',
                'local_address' => 'required',
                'permanent_address' => 'required',
                'password'=>'required',
                'other_mobile_number'=>'required|max:12|min:10'
            ],
            [
                'firstname.required' => 'Please Enter First Name',
                'lastname.required' => 'Please Enter LastName',
                'image.required' => 'Please Select Image',
                'password.required' => 'Please Enter Password',
                'aadhar_card.required'=>"Please Enter Aadhar Card",

                'local_address.required'=>"Please Enter Local Address",
                'permanent_address.required'=>"Please Enter Personal Address",
                'mobile_number.required'=>"Please Enter Mobile Number",
                'other_mobile_number.required'=>"Please Enter Other Mobile Number"
            ]);
            if($validator->fails()) {
                return Redirect::back()->with('error',$validator);
            }
        }
            $userData = new User;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                 if($user->is_admin==3){
                    $check->where('user_id',$user->id)->where('is_admin',4)->where('email',$request->email);
                }
           $checkData= $check->count();
            if($checkData>0){
                    return redirect()->back()->with('error',''.$request->email. 'Email Already Exists');
                }
                else
                {
                    $path = public_path('upload/restaurent/chefs/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    } 
                    $image="";
                    if($request->hasfile('image'))
                    {
                        $imageName = time().rand(1,50).'.'.$request->image->extension();
                        $request->image->move($path, $imageName);
                        $image.='/upload/restaurent/chefs/'.$imageName;
                    }
                    
                    $userData->user_id = $user->id;
                   
                    $userData->branch_id = $user->branch_id;
                   
                    $userData->firstname = $request->firstname;
                    $userData->lastname = $request->lastname;
                    $userData->email = $request->email;
                    $userData->pen_card = isset($request->pen_card)  ? $request->pen_card :'';
                    $userData->aadhar_card = isset($request->aadhar_card)  ? $request->aadhar_card :'';
                    $userData->mobile_number = isset($request->mobile_number)  ? $request->mobile_number :'';
                    $userData->other_mobile_number = isset($request->other_mobile_number)  ? $request->other_mobile_number :'';
          
                    $userData->name = $user->name;
                    $userData->image = $image;
                    $userData->password = bcrypt($request->password);
                    $userData->upassword = $request->password;
                    $userData->is_admin = 4;
                    $userData->local_address = isset($request->local_address) ?$request->local_address :'';
                    $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :'';
              
                    if($userData->save()){
                        $userData->unique_id = "CHEFS-000".$user->id.$userData->id;
                        $userData->save();
                        return redirect('manager/chefs')->with('success','Chefs Register Successfully');
                    }
                    else{
                        return redirect('manager/chefs')->with('error','Manager Register Failed');
                    }
                }
                
            }
        }
        else{
            return redirect('login');
        }
    }
    

    public function data(Request $request){
        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
    
            $search = $request['search'];
            
            $unique_id = $request['unique_id'];

            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
        //    $status = $request['status'] ?? null;
          //  $start_date = $request['start_date'] ?? null ;
            //$end_date = $request['end_date'] ?? null; 
          //  echo auth()->user()->id;
           // die;
           $querydata = User::where('id',"!=",0)->latest();
           
           if(auth()->user()->is_admin==2)
            {
                $querydata->where("user_id",auth()->user()->id);
            }
            if(auth()->user()->is_admin==3)
            {
                $querydata->where("user_id",auth()->user()->id);
            }

            if (!is_null($unique_id) && !empty($unique_id)) {
                $querydata->where(function($query) use ($unique_id) {
                    $query->orwhere('unique_id',$unique_id);
                    $query->orwhere('firstname', 'LIKE', '%' . $unique_id . '%');
                });
            }

            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('firstname', 'LIKE', '%' . $search . '%');
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
                $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                $row['firstname'] = isset($value->firstname)? $value->firstname:'-';
                $row['lastname'] = isset($value->lastname)? $value->lastname:'-';
                $row['email'] = isset($value->email)? $value->email:'-';
                $row['pen_card'] = isset($value->pen_card)? $value->pen_card:'-';
                $row['aadhar_card'] = isset($value->aadhar_card)? $value->aadhar_card:'-';
                $row['mobile_number'] = isset($value->mobile_number)? $value->mobile_number:'-';
                $row['other_mobile_number'] = isset($value->other_mobile_number)? $value->other_mobile_number:'-';
                $row['image'] = '<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';                  
                $edit = Helper::editAction(url('/manager/chefs/edit/'),encrypt($value->id));
                $view = Helper::viewAction(url('/manager/chefs/show/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('manager.chefs.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
                $sel .= "<option value='Active' " . ((isset($value->status) && $value->status == 'Active') ? 'Selected' : '') . ">Active</option>";
                $sel .= "<option value='Inactive' " . ((isset($value->status) && $value->status == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                $sel .= "</select>";

            $row['status'] =$sel;
                $row['action'] = Helper::action($edit." ".$view);
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
    public function adminData(Request $request)
    {
        if ($request->ajax()) {
            
            if(auth()->user()->is_admin==1 || auth()->user()->is_admin==2)
            {
                $limit = $request->input('length');
                $start = $request->input('start');
               
                $search = $request['search'];
                $orderby = $request['order']['0']['column'];
                $order = $orderby != "" ? $request['order']['0']['dir'] : "";
                $draw = $request['draw'];
            //    $status = $request['status'] ?? null;
              //  $start_date = $request['start_date'] ?? null ;
                //$end_date = $request['end_date'] ?? null; 
              //  echo auth()->user()->id;
              $unique_id = $request['unique_id'] ?? null;
    
                $sql = "SELECT 
                    restaurent.id as restaurent_id,
                    restaurent.name  as restaurnt_name,
                    manager.id as manager_id,
                    manager.firstname as manager_name,
                    chef.*
                    FROM `users` as restaurent 
                    inner join users as manager on manager.user_id = restaurent.id
                    INNER join users as chef on chef.user_id = manager.id
                    WHERE restaurent.is_admin =2";
                     if(!empty($search)){
                        $sql.="  and  chef.firstname="."LIKE '%".$search."%'";
                    }

                    if(!empty($unique_id)){
                        $sql.="  and  chef.unique_id="."'".$unique_id."'";
                    }

                    $sql.=" LIMIT ".$limit ." OFFSET ".$start;
                   // $data= DB::select($sql);
        
                $querydata=   DB::select($sql);
             //       dd($querydata);
                 $totaldata = count($querydata);
               
                $response = $querydata;
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
                   $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                   $row['firstname'] = isset($value->firstname)? $value->firstname:'-';
                   $row['lastname'] = isset($value->lastname)? $value->lastname:'-';
                   $row['email'] = isset($value->email)? $value->email:'-';
                   $row['pen_card'] = isset($value->pen_card)? $value->pen_card:'-';
                   $row['aadhar_card'] = isset($value->aadhar_card)? $value->aadhar_card:'-';
                   $row['mobile_number'] = isset($value->mobile_number)? $value->mobile_number:'-';
                   $row['other_mobile_number'] = isset($value->other_mobile_number)? $value->other_mobile_number:'-';
                   $row['image'] = '<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';                  
                   $edit = Helper::editAction(url('/restaurent/chefs/edit/'),encrypt($value->id));
                   $view = Helper::viewAction(url('/restaurent/chefs/show/'),encrypt($value->id));
                   
                   $sel = "<select class='form-control statusAction' data-path=".route('restaurent.chefs.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
                   $sel .= "<option value='Active' " . ((isset($value->status) && $value->status == 'Active') ? 'Selected' : '') . ">Active</option>";
                   $sel .= "<option value='Inactive' " . ((isset($value->status) && $value->status == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                   $sel .= "</select>";
   
               $row['status'] =$sel;
                   $row['action'] = Helper::action($edit." ".$view);
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
    }
    

    public function edit($id){
        $user = auth()->user();
        $branchqry = Branch::where(['status'=>"Active"]);
    
        if(!is_null($user)){
           $data = User::find(decrypt($id));
         //  dd($data);
           if(!is_null($data)){
            if($user->is_admin==3){
                    $gerBranch= $branchqry->where('user_id',$user->id)->get();
                 return view('manager.chefs.edit',compact('data','gerBranch'));
            
                }
            }
        }
        else{
            return redirect('login');
        }
    }
    public function show($id){
       // dd(decrypt($id));
        $user = auth()->user();
        if(!is_null($user)){
            $data = User::find(decrypt($id));
           // dd($data);
            if(!is_null($data)){
               if($user->is_admin==3){
                return view('manager.chefs.show',compact('data'));
                 }
            }
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $request){
        $user = auth()->user();
        if(!is_null($user)){
            $this->validate($request,[
                'firstname' => 'required',
                'lastname'=>'required',
                'password'=>'required',
                'aadhar_card' => 'required|max:20|min:16',
                'mobile_number' => 'required|max:12|min:10',
                'local_address' => 'required',
                'permanent_address' => 'required',
                'other_mobile_number'=>'required|max:12|min:10'
            ],
            [
                'firstname.required' => 'Please Enter First Name',
                'lastname.required' => 'Please Enter LastName',
                'password.required' => 'Please Enter Password',
                'aadhar_card.required'=>"Please Enter Aadhar Card",
                'local_address.required'=>"Please Enter Local Address",
                'permanent_address.required'=>"Please Enter Personal Address",
                'mobile_number.required'=>"Please Enter Mobile Number",
                'other_mobile_number.required'=>"Please Enter Other Mobile Number"
            ]);
           
            if(!empty($request->all())){
                $userData =  User::find($request->id);
        
                $path = public_path('upload/restaurent/chefs/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    if(!empty($userData->image))
                    {
                        unlink("public/".$userData->image);
                    }
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.='/upload/restaurent/chefs/'.$imageName;
                    $userData->image = $image;
                }
                else{
                    $image = $userData->image;
                } 
            $userData->branch_id =  $userData->branch_id;
            $userData->firstname = isset($request->firstname) ? $request->firstname : $userData->firstname;
            $userData->lastname = isset($request->lastname) ? $request->lastname : $userData->lastname;
            $userData->email = isset($request->email) ? $request->email : $userData->email;
            $userData->pen_card = isset($request->pen_card)  ? $request->pen_card :$userData->pen_card;
            $userData->aadhar_card = isset($request->aadhar_card)  ? $request->aadhar_card :$userData->aadhar_card;
            $userData->mobile_number = isset($request->mobile_number)  ? $request->mobile_number :$userData->mobile_number;
            $userData->other_mobile_number = isset($request->other_mobile_number)  ? $request->other_mobile_number :$userData->other_mobile_number;
            
            $userData->name =isset($user->name) ? $user->name: $userData->name;
            $userData->image = $image;
            $userData->password = bcrypt($request->password);
            $userData->upassword = $request->password;
            $userData->is_admin = 4;
            $userData->local_address = isset($request->local_address) ?$request->local_address :$userData->local_address;
            $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :$userData->permanent_address;
            $userData->user_id = $user->id;
            if($userData->save()){
                return redirect('manager/chefs')->with('success','Data updated Successfully');
            }
            else{
                return redirect('manager/chefs')->with('error','Data updated Failed');
            }
        }
        }
        else{
            return redirect('login');
        }
    }

    
    public function status_change(Request $request){
        $change     =   $this->changeStatus('User',$request);
        if($change){
            return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
        }else{
            return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
        }
    }
}
