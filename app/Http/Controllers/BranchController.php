<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use File;
use DataTables;
use Str;
use Helper;


class BranchController extends Controller
{
    
    public function index(){
        $user = auth()->user();
        $page = "Manager"; //----------->>
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
                return view('admin/branch/index',compact('page','data'));
            }else if($user->is_admin==2){
                return view('restaurent/branch/index',compact('page','data'));
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
        if(!is_null($user)){
            if($user->is_admin==1){
                $restaurentlist= User::where("status",'Active')->where("is_admin",3)->get();
                return view('admin/branch/create',compact('page','restaurentlist','data'));
            }else if($user->is_admin==2){
                return view('restaurent/branch/create',compact('page','data'));
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
            $request->validate([
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'contact1' => 'required',
                'contact2' => 'required',
                'address' => 'required',
                'opeing_time' => 'required',
                'close_time'=>'required',
            ],
            [
                'name.required' => 'Please Enter Branch Name',
                'image.required' => 'Please Select Image',
                'contact1.required' => 'Please Enter Contact Number',
                'contact2.required'=>"Please Enter Contact Number",

                'address.required'=>"Please Enter Address",
                'opeing_time.required'=>"Please Enter Opening Time",
                '.required'=>"Please Enter Closing Time"
            ]);
        }
        
            $branchData = new Branch;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                if($user->is_admin==1){
                    $check->where('user_id',$request->user_id)->where('category_id',$request->category_id);
                }else if($user->is_admin==2){
                    $check->where('user_id',$user->id)->where('is_admin',3)->where('email',$request->email);
                }
           $checkData= $check->count();
            //   dd($check);
            if($checkData>0){
                    return redirect()->back()->with('error',''.$request->email. 'Email Already Exists');
                }
                else
                {
                    $path = public_path('upload/restaurent/branch/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $image="";
                    if($request->hasfile('image'))
                    {
                        $imageName = time().rand(1,50).'.'.$request->image->extension();
                        $request->image->move($path, $imageName);
                        $image.='/upload/restaurent/branch/'.$imageName;
                    }
                    
                    $branchData->user_id = $user->id;
                    
                    $branchData->image = $image;
                    
                    if($user->is_admin==1)
                    {
                        $branchData->user_id = $request->user_id;
                    }
                    else
                    {
                        $branchData->user_id = $user->id;
                    }
                    $branchData->name = $request->name;
                    $branchData->contact1 = $request->contact1;
                    $branchData->contact2 = $request->contact2;
                    $branchData->image = $image;
                    $branchData->opeing_time = $request->opeing_time;
                    $branchData->close_time = $request->close_time;
                    $branchData->address = isset($request->address) ?$request->address :'';
                    if($branchData->save()){
                        $branchData->unique_id = "BRN-000".$user->id.$branchData->id;
                        $branchData->save();
                        return redirect('restaurent/branch')->with('success','Branch Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/branch')->with('error','Branch Added Failed');
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
        if(!is_null($user)){
           $data = Branch::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                return view('admin/branch/edit',compact('data'));
                }else if($user->is_admin==2){
                 return view('restaurent/branch/edit',compact('data'));
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
            $data = Branch::find(decrypt($id));
           //dd($data);
            if(!is_null($data)){
                if($user->is_admin==1){
                    return view('admin/branch/show',compact('data'));
                }else if($user->is_admin==2){
                    return view('restaurent/branch/show',compact('data'));
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
                $request->validate([
                    'name' => 'required',
              //      'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                    'contact1' => 'required',
                    'contact2' => 'required',
                    'address' => 'required',
                    'opeing_time' => 'required',
                    'close_time'=>'required',
                ],
                [
                    'name.required' => 'Please Enter Branch Name',
                   // 'image.required' => 'Please Select Image',
                    'contact1.required' => 'Please Enter Contact Number',
                    'contact2.required'=>"Please Enter Contact Number",
    
                    'address.required'=>"Please Enter Address",
                    'opeing_time.required'=>"Please Enter Opening Time",
                    '.required'=>"Please Enter Closing Time"
                ]);
        }

            if(!empty($request->all())){
                $branchData =  Branch::find($request->id);
        
                $path = public_path('upload/restaurent/branch/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    if(!empty($branchData->image))
                    {

                        unlink("public/".$branchData->image);
                    }
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.='/upload/restaurent/branch/'.$imageName;
                    $branchData->image = $image;
                }
                else{
                    $image = $branchData->image;
                } 
                 
                $branchData->name = isset($request->name) ? $request->name :$branchData->name;
                $branchData->contact1 = isset($request->contact1) ? $request->contact1 :$branchData->contact1;
                $branchData->contact2 = isset($request->contact2) ? $request->contact2 :$branchData->contact2;
                $branchData->image = $image;
                $branchData->opeing_time = isset($request->opeing_time) ? $request->opeing_time :$branchData->opeing_time;;
                $branchData->close_time = isset($request->close_time) ? $request->close_time :$branchData->close_time;;
                $branchData->address = isset($request->address) ?$request->address :$branchData->address;
              
                if($branchData->save()){
                    return redirect('restaurent/branch')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/branch')->with('error','Data updated Failed');
                }
            }
        }
        else{
            return redirect('login');
        }
    }

    
    public function status_change(Request $request){
           $change     =   $this->changeStatus('Branch',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
    }

    
    public function branchdata(Request $request){
        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
           
            $search = $request['search'];
            $search_key = $request['search_key'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
        //    $status = $request['status'] ?? null;
          //  $start_date = $request['start_date'] ?? null ;
            //$end_date = $request['end_date'] ?? null; 
          //  echo auth()->user()->id;
          $unique_id = $request['unique_id'] ?? null;

           // die;
            $querydata = Branch::where('user_id',auth()->user()->id)->latest();
            
            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }

            if (!is_null($search_key) && !empty($search_key)) {
                $querydata->where(function($query) use ($search_key) {
                    $query->where('unique_id', 'LIKE', '%' . $search_key . '%');
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
                $row['name'] = isset($value->name)? $value->name:'-';
                $row['contact1'] = isset($value->contact1)? $value->contact1:'-';
                $row['contact2'] = isset($value->contact2)? $value->contact2:'-';
               
                $row['icon']='<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/branch/edit/'),encrypt($value->id));
                $view = Helper::viewAction(url('/restaurent/branch/show/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.branch.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
