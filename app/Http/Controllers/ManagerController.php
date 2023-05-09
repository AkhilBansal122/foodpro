<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use App\Models\CustomOrders;
use File;
use DataTables;
use Str;
use Session;
use Helper;

use App\Models\Category;
use App\Models\SubCategories;

class ManagerController extends Controller
{
    public function index($id=null){
        $user = auth()->user();
        $page = "Manager";
        if(!is_null($user)){
            $query =User::where('id','!=',0);
            if($user->is_admin==1)
            {
                $query->get();
            }
            else
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
           if($user->is_admin==1){
           $branch_id = decrypt($id);
           $manager =  User::where("branch_id",decrypt($id))->first();
            $name = isset($manager->branchDetails->name) ? $manager->branchDetails->name :'';
          
            return view('admin/manager/index',compact('name','branch_id'));
            }else if($user->is_admin==2){
                $data = Branch::where("user_id",$user->id)->where('status','Active')->get();
                return view('restaurent/manager/index',compact('page','data'));
            }
        }
        else{
            return redirect('login');
        }
    }

    
    public function create(){
        $user = auth()->user();
        $page = "Menu Create";
        $data="";
        $branchqry = Branch::where(['status'=>"Active"]);
        $getChecked = User::where(['user_id'=>$user->id,'is_admin'=>3])->where('branch_id',"!=",0)->get(['branch_id']);
      //    dd(count($getChecked));
        $checkbranchs =  $branchqry->where('user_id',$user->id)->count();
        if(count($getChecked)==$checkbranchs){
            return redirect('restaurent/manager')->with('info',"Please Add New Branch and Add New Manager");
        }
        if(count($getChecked)>0){
            
            $branchqry->whereNotIn('id',$getChecked);
        }
        if(!is_null($user)){
            if($user->is_admin==1){
                $restaurentlist= User::where("status",'Active')->where("is_admin",3)->get();
               $gerBranch= $branchqry->get();
                return view('admin/manager/create',compact('page','restaurentlist','data','gerBranch'));
            }else if($user->is_admin==2){
                $gerBranch= $branchqry->where('user_id',$user->id)->get();
              //   $branchqry->toSql();
                return view('restaurent/manager/create',compact('page','data','gerBranch'));
            }
        }
        else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
   
        //   dd($request->all());
        $user = auth()->user();
        if(!is_null($user)){
        if($user->id_admin==2)
        {
         $validator=   $request->validate([
                'branch_id' => 'required',
                'firstname' => 'required',
                'lname'=>'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'aadhar_card' => 'required|max:20|min:16',
                'mobile_number' => 'required|max:12|min:10',
                'local_address' => 'required',
                'permanent_address' => 'required',
                'password'=>'required',
                'other_mobile_number'=>'required|max:12|min:10'
            ],
            [
                'branch_id.required'=>"Please Select Branch",
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
                if($user->is_admin==1){
                    $check->where('user_id',$request->user_id)->where('category_id',$request->category_id);
                }else if($user->is_admin==2){
                    $check->where('user_id',$user->id)->where('is_admin',3)->where('email',$request->email);
                }
           $checkData= $check->count();
            if($checkData>0){
                    return redirect()->back()->with('error',''.$request->email. 'Email Already Exists');
                }
                else
                {
                    $path = public_path('upload/restaurent/manager/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    } 
                    $image="";
                    if($request->hasfile('image'))
                    {
                        $imageName = time().rand(1,50).'.'.$request->image->extension();
                        $request->image->move($path, $imageName);
                        $image.='/upload/restaurent/manager/'.$imageName;
                    }
                    
                    $userData->user_id = $user->id;
                    
                    $userData->image = $image;
                    
                    if($user->is_admin==1)
                    {
                        $userData->user_id = $request->user_id;
                    }
                    else
                    {
                        $userData->user_id = $user->id;
                    }
                    $userData->branch_id = $request->branch_id;
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
                    $userData->is_admin = 3;
                    $userData->local_address = isset($request->local_address) ?$request->local_address :'';
                    $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :'';
              
                    if($userData->save()){
                        $userData->unique_id = "MAN-000".$user->id.$userData->id;
                        $userData->save();
                        return redirect('restaurent/manager')->with('success','Manager Register Successfully');
                    }
                    else{
                        return redirect('restaurent/manager')->with('error','Manager Register Failed');
                    }
                }
                
            }
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        $branchqry = Branch::where(['status'=>"Active"]);
    
        if(!is_null($user)){
           $data = User::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                $gerBranch= $branchqry->get();
                return view('admin/manager/edit',compact('data'));
                }else if($user->is_admin==2){
                    $gerBranch= $branchqry->where('user_id',$user->id)->get();
                 return view('restaurent/manager/edit',compact('data','gerBranch'));
                }
            }
        }
        else{
            return redirect('login');
        }
    }
    public function show($id){
        $user = auth()->user();
        if(!is_null($user)){
            $data = User::find(decrypt($id));
           // dd($data);
            if(!is_null($data)){
                if($user->is_admin==1){
                    return view('admin/manager/show',compact('data'));
                }else if($user->is_admin==2){
                    return view('restaurent/manager/show',compact('data'));
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
            if($user->id_admin==2)
            {
                $validator=   $request->validate([
                    'branch_id' => 'required',
                    'firstname' => 'required',
                    'lname'=>'required',
                    'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                    'aadhar_card' => 'required|max:20|min:16',
                    'mobile_number' => 'required|max:12|min:10',
                    'local_address' => 'required',
                    'permanent_address' => 'required',
                    'password'=>'required',
                    'other_mobile_number'=>'required|max:12|min:10'
                ],
                [
                    'branch_id.required'=>"Please Select Branch",
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

            if(!empty($request->all())){
                $userData =  User::find($request->id);
        
                $path = public_path('upload/restaurent/manager/');
                
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
                    $image.='/upload/restaurent/manager/'.$imageName;
                    $userData->image = $image;
                }
                else{
                    $image = $userData->image;
                } 
          
            $userData->branch_id = isset($request->branch_id) ? $request->branch_id : $userData->branch_id;
            $userData->firstname = isset($request->firstname) ? $request->firstname : $userData->firstname;
            $userData->lastname = isset($request->lastname) ? $request->lastname : $userData->lastname;
            $userData->email = isset($request->email) ? $request->email : $userData->email;
            $userData->pen_card = isset($request->pen_card)  ? $request->pen_card :$userData->pen_card;
            $userData->aadhar_card = isset($request->aadhar_card)  ? $request->aadhar_card :$userData->aadhar_card;
            $userData->mobile_number = isset($request->mobile_number)  ? $request->mobile_number :$userData->mobile_number;
            $userData->other_mobile_number = isset($request->other_mobile_number)  ? $request->other_mobile_number :$userData->other_mobile_number;
            
            $userData->name =isset( $user->name) ? $user->name: $userData->name;
            $userData->image = $image;
            $userData->password = bcrypt($request->password);
            $userData->upassword = $request->password;
            $userData->is_admin = 3;
            $userData->local_address = isset($request->local_address) ?$request->local_address :$userData->local_address;
            $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :$userData->permanent_address;
        
              if($user->is_admin==1)
                    {
                        $userData->user_id = $request->user_id;
                    }
                    else
                    {
                        $userData->user_id = $user->id;
                    }
                if($userData->save()){
                    return redirect('restaurent/manager')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/manager')->with('error','Data updated Failed');
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

    public function get_menu_by_restaurent_id(Request $request){
        $user = auth()->user();
        if(!is_null($user)){
            $get_menu =Category::where("user_id",$request->id)->where('status','Active')->get();
            $options="<option value=''>Select Menu</option>";
            if(!empty($get_menu)){
                foreach($get_menu as $row){
                    $options.="<option value='".$row->id."'>".$row->name."</option>";
                }
            }
            if(!empty($options)){
                return response()->json(['status'=>true,"data"=>$options]);
            }else{
                return response()->json(['status'=>false,"data"=>$options]);
            }
        }
        else{
            return redirect('login');
        }
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            if(!empty($data)){
                foreach($data as $row){
                    $row->restaurent_name = $row->restaurentDetails->name;
                   $row->menu_name = $row->menuDetails->name;
                }
            }
          //  dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('restaurent_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['restaurent_name'], $request->get('restaurent_name')) ? true : false;
                        });
                    }
                    if (!empty($request->get('name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['name'], $request->get('name')) ? true : false;
                    });
                    }
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.asset('public/'.$row->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                })
                ->addColumn('status', function($row){
                    $id = $row->id;
                        $sel = "<select class='form-control' onChange=\"select_changes2('$id',this.value);return false;\">";
                        $sel .= "<option value='Active' " . ((isset($row['status']) && $row['status'] == 'Active') ? 'Selected' : '') . ">Active</option>";
                        $sel .= "<option value='Inactive' " . ((isset($row['status']) && $row['status'] == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                        $sel .= "</select>";
                    return $sel;
            })
             ->addColumn('action', function($row){
                $btn = '<a href="'.url('/admin/manager/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                $btn = $btn.='<a href="'.url('/admin/manager/show/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-arrow-right"></i></a>';
                 return $btn;
                })->rawColumns(['status','image','action'])
                ->make(true);
            }
    }
    


    public function managerdata(Request $request){
        if ($request->ajax()) {
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
          $branch_id = $request['branch_id'] ?? null; 
          $unique_id = $request['unique_id'] ?? null;

          $querydata = User::where('id',"!=",0);
         
           // die;
           if(auth()->user()->is_admin==1)
            {
                $querydata->where('branch_id',$request->id);
            }
            else{
                $querydata->where('user_id',auth()->user()->id);
            }

            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }
            if (!is_null($unique_id) && !empty($unique_id)) {
                $querydata->where(function($query) use ($unique_id) {
                    $query->where('unique_id', 'LIKE', '%' . $unique_id . '%');
                });
            }
            if (!is_null($branch_id) && !empty($branch_id)) {
                $querydata->where(function($query) use ($branch_id) {
                    $query->where('branch_id',  $branch_id );
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
                $row['branch_name'] = isset($value->branchDetails) ? $value->branchDetails->name:'-';
                $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
                $row['firstname'] = isset($value->firstname)? $value->firstname:'-';
                $row['lastname'] = isset($value->lastname)? $value->lastname:'-';
                $row['email'] = isset($value->email)? $value->email:'-';
                $row['pen_card'] = isset($value->pen_card)? $value->pen_card:'-';
                $row['aadhar_card'] = isset($value->aadhar_card)? $value->aadhar_card:'-';
                $row['mobile_number'] = isset($value->mobile_number)? $value->mobile_number:'-';
                $row['other_mobile_number'] = isset($value->other_mobile_number)? $value->other_mobile_number:'-';
               
                $edit = Helper::editAction(url('/restaurent/manager/edit/'),encrypt($value->id));
                $view = Helper::viewAction(url('/restaurent/manager/show/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.manager.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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

    public function custom_order(){
        if(auth()->user()->is_admin==3)
        {
            $category = Category::where(['user_id'=>auth()->user()->user_id,'status'=>'Active'] )->get();
            return view('manager/custom_order/create',compact('category'));
        }
    }

    public function get_sub_menu(Request $request){
        if(auth()->user()->is_admin==3)
        {
            $category = SubCategories::select('name','price','id')->where(['category_id'=>$request->category_id,'status'=>'Active'] )->get();
            if(!empty($category)){
                echo json_encode(array('status'=>true,"data"=>$category));
            }
            else{
                echo json_encode(array('status'=>false,"data"=>$category));
            }
        }
        
    }

    public function custom_order_store(Request $request){
        if(auth()->user()->is_admin==3){
            $CustomOrders = new CustomOrders();
            $CustomOrders->user_id= auth()->user()->id;
            $CustomOrders->category_id= $request->category_id;
            $CustomOrders->sub_category_id= $request->sub_category_id; 
            $CustomOrders->qty= $request->qty;
            $CustomOrders->payment_mode= $request->payment_mode;
            $CustomOrders->price= $request->price;
            $CustomOrders->total_price= $request->total_price;
            if($CustomOrders->save())
            {
                $CustomOrders->unique_id = "CUSODR-000".$CustomOrders->id;
                $CustomOrders->save();
                return redirect()->back()->with('success','Order Place Successfully');
            }
            else{
                return redirect()->back()->with('success','Order Place Successfully');
            }
        }
        
    }
    
}
