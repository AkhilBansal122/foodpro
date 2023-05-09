<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orders;
use App\Models\Branch;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Session;
use Helper;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Str;
use DB;
use DataTables;
use File;
class CustomerController extends Controller
{

  public function customer_list(){
        
    $user = auth()->user();
    if(!is_null($user) && $user->is_admin==1)
    {
        $query = User::where('is_admin',2);
        $data= $query->get();
        if(!empty($data)){
          $keyword_search="";
          $user_type="";
          $from_date ="";
          $to_date ="";
          $status ="";
            return view('admin/customer/index',compact('data','keyword_search','status','user_type','from_date','to_date'));
        }
    }
    else
    {
        return redirect('login');
    }
}
public function create(){
  $user = auth()->user();
  if(!is_null($user) && $user->is_admin==1)
  {
      return view('admin/customer/create');
  }
  else
  {
      return redirect('login');
  }
}
public function edit($id){
  $user = auth()->user();
  if(!is_null($user) && $user->is_admin==1)
  {
     $data= User::where("id",decrypt($id))->first();
   //  dd($data);
     return view('admin/customer/edit',compact('data'));
  }
  else
  {
      return redirect('login');
  }
}
public function show($id){
  $user = auth()->user();
  if(!is_null($user) && $user->is_admin==1)
  {
     $data= User::where("id",decrypt($id))->first();
      return view('admin/customer/view',compact('data'));
  }
  else
  {
      return redirect('login');
  }
}
public function update(Request $request){
  $user = auth()->user();
  $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      'aadhar_card' => 'required',
      'email' =>'required|email',
      'name' => 'required',
      'mobile_number' => 'required|numeric|digits:10',
      'other_mobile_number' => 'numeric|digits:10',
      'pen_card'=>'required'
  ],
  [
      'firstname.required' => 'Please Enter First Name.',
      'lastname.required' => 'Please Enter First Name.',
      'email.required' => 'Please Enter Mail.',
      'aadhar_card.required' => 'Please Aadhar Card.',
      'name.required' => 'Please Enter Restaurent Name',
      'mobile_number.required' => 'Please Enter Mobile Number'
  ]);

  $userData = User::find($request->id);
  if(!is_null($user) && $user->is_admin==1)
  {
    if(!empty($request->all())){
          $check= User::where('email',$request->email)->where('id',"!=",$request->id);
           $checkData = $check->count();
          if($checkData>0){
              return redirect()->back()->with('error',''.$request->email. 'Already Exists');
          }
          else
          {

              $path = public_path('upload/restaurent/FSSAI/');
              if(!File::isDirectory($path)){
                  File::makeDirectory($path, 0777, true, true);
              } 
              $image="";
              if($request->hasfile('FSSAI'))
              {
                if(!empty($userData->FSSAI))
                {
                  unlink("public/".$userData->FSSAI);
                  
                }
                  $imageName = time().'.'.$request->FSSAI->extension();
                  $request->FSSAI->move($path, $imageName);
                  $image.='/upload/restaurent/FSSAI/'.$imageName;
                  $userData->FSSAI = $image;
              }
            
              $userData->firstname = isset($request->firstname) ? $request->firstname :$userData->firstname;
              $userData->lastname = isset($request->lastname) ? $request->lastname : $userData->lastname;
              $userData->name = isset($request->name) ? $request->name : $userData->name;
              $userData->email = isset($request->email) ? $request->email : $userData->email;
              $userData->pen_card = isset($request->pen_card)  ? $request->pen_card :$userData->pen_card;
              $userData->aadhar_card = isset($request->aadhar_card)  ? $request->aadhar_card :$userData->aadhar_card;
              $userData->mobile_number = isset($request->mobile_number)  ? $request->mobile_number :$userData->mobile_number;
              $userData->GST = isset($request->GST)  ? $request->GST :$userData->GST;
              $userData->other_mobile_number = isset($request->other_mobile_number)  ? $request->other_mobile_number :$userData->other_mobile_number;
              $userData->local_address = isset($request->local_address) ?$request->local_address :$userData->local_address;
              $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :$userData->permanent_address;
              $userData->bill_gst = isset($request->bill_gst) ? 1 :0;
           //   dd($userData);
              if($userData->save()){ 
                  return redirect()->back()->with('success','Restaurnt Registration Successfully');
              }
              else{
                  return redirect()->back()->with('error','Restaurnt Registration Failed');
              }
          }
      }
      else{
          return redirect()->back()->with('error','Plese Fill All Required Fields');
      }
  }
}



public function store(Request $request){
  $user = auth()->user();
  $request->validate([
      'firstname' => 'required',
      'lastname' => 'required',
      'aadhar_card' => 'required',
      'email' =>'required|email|unique:users,email,'.$user->id,
      'name' => 'required|unique:users,id,' . $user->id,
      'mobile_number' => 'required|numeric|digits:10',
      'other_mobile_number' => 'numeric|digits:10',
      'pen_card'=>'required'
  ],
  [
      'firstname.required' => 'Please Enter First Name.',
      'lastname.required' => 'Please Enter First Name.',
   'email.required' => 'Please Enter Mail.',
      'aadhar_card.required' => 'Please Aadhar Card.',
      'name.required' => 'Please Enter Restaurent Name',
      'mobile_number.required' => 'Please Enter Mobile Number'
  ]);
  $userData = new User;
  if(!is_null($user) && $user->is_admin==1)
  {
      if(!empty($request->all())){
          $check= User::where('email',$request->email);
      
           $checkData = $check->count();
          if($checkData>0){
              return redirect()->back()->with('error',''.$request->email. 'Already Exists');
          }
          else
          {
              $path = public_path('upload/restaurent/FSSAI/');
              if(!File::isDirectory($path)){
                  File::makeDirectory($path, 0777, true, true);
              } 
              $image="";
              if($request->hasfile('FSSAI'))
              {
                  $imageName = time().'.'.$request->FSSAI->extension();
                  $request->FSSAI->move($path, $imageName);
                  $image.='/upload/restaurent/FSSAI/'.$imageName;
              }  
              $userData->firstname = $request->firstname;
              $userData->lastname = $request->lastname;
              $userData->name = $request->name;
            //  $userData->slug = \Str::slug($request->name);

              $userData->email = $request->email;
              $userData->pen_card = isset($request->pen_card)  ? $request->pen_card :'';
              $userData->aadhar_card = isset($request->aadhar_card)  ? $request->aadhar_card :'';
              $userData->mobile_number = isset($request->mobile_number)  ? $request->mobile_number :'';
              $userData->GST = isset($request->GST)  ? $request->GST :'';
              $userData->other_mobile_number = isset($request->other_mobile_number)  ? $request->other_mobile_number :'';
              $userData->FSSAI = $image;
              $userData->password = bcrypt('123456');
              $userData->upassword = '123456';
              $userData->is_admin = 2;
              $userData->bill_gst = isset($request->bill_gst) ? 1 :0;
              $userData->local_address = isset($request->local_address) ?$request->local_address :'';
              $userData->permanent_address = isset($request->permanent_address) ?$request->permanent_address :'';
              if($userData->save()){
                  $userData->unique_id = "RES-000".$userData->id;
                  $userData->save();
                  return redirect()->back()->with('success','Restaurnt Registration Successfully');
              }
              else{
                  return redirect()->back()->with('error','Restaurnt Registration Failed');
              }
          }
      }
      else{
          return redirect()->back()->with('error','Plese Fill All Required Fields');
      }
  }
}

    

    

    //Restaurent details show
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $query = User::where('is_admin',"=",2)->latest();

            ## Read value
                $draw = $request->get('draw');
                $offset = $request->get("start");
                $limit = $request->get("length"); // Rows display per page
                
                $columnIndex_arr = $request->get('order');
                $columnName_arr = $request->get('columns');
                $order_arr = $request->get('order');
                $search_arr = $request->get('search');
                
                $start_date = $request->get('searchStart_date');
                $end_date = $request->get('searchEndDate');
                
                $columnIndex = $columnIndex_arr[0]['column'];
                $columnName = $columnName_arr[$columnIndex]['data'];
                $columnSortOrder = $order_arr[0]['dir']; 

                $restaurent_name=  $request->get('restaurent_name');
                $firstname = $request->get('firstname');

                if(!empty($request->get('restaurent_name')))
                {
                    $query->where('name','like','%'.$restaurent_name.'%');
                }
                if(!empty($request->get('firstname')))
                {
                    $query->where('firstname','like','%'.$firstname.'%');
                }
                
                if(isset($start_date) && isset($end_date))
                {
                    $query->whereBetween('created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
                }
            
                if(isset($start_date))
                {
                    $query->whereBetween('created_at',[$start_date.' 00:00:01',date('Y-m-d H:i:s')]);
                }
                $totalRecords = $query->count();
              
                $data = $query->offset($offset)->limit($limit)->get();
              //  dd($query->toSql());
             //   $data=  $query->get();

          //  dd($data);
          $datas = array();
          if(!empty($data)){
            $i=1;
            foreach($data as $row){
                $row['id'] = $i;
                $edit = Helper::editAction(url('/admin/customer/edit/'),encrypt($row->id));
                $view = Helper::viewAction(url('/admin/customer/show/'),encrypt($row->id));
                $row['action'] =Helper::action($edit." ".$view);
                $row['branch']= Helper::viewAction(url('/admin/branch/'),encrypt($row->id));
              //  $row['created_at'] =  ;//Helper::dateFormat(date('y-m-d'),$row->created_at);
                $id = $row->id;
                $sel = "<select class='form-control form-select StatusChange' data-record_id='{{$id}}' data-url = '{{url('admin/customer/status_change')}}'>";
                $sel .= "<option value='Active' " . ((isset($row['status']) && $row['status'] == 'Active') ? 'Selected' : '') . ">Active</option>";
                $sel .= "<option value='Inactive' " . ((isset($row['status']) && $row['status'] == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                $sel .= "</select>";
                $row['status'] =$sel;
                $datas[] = $row;
                $i++;
            }
          }
          if(!is_null($datas))
          {
            $response= $datas;
          }  
          else{
            $response=null;
          }
   
         return response()->json(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $response
         ));
        }
      }


    public function chart(Request $request){
      if($request->all()){
        
         $type =$request->type;//1 for week 2 for month or 3 for year get all previous 6 month/week/year

        if($type ==1)
        {
          $users=   User::select(
            DB::raw("(COUNT(*)) as y"),
            DB::raw("DAYNAME(created_at) as label"))
            ->where('user_type',3)
          //  ->whereBetween('created_at', [today()->startOfWeek()->subWeeks(6), Carbon::now()->endOfWeek()])
          ->whereBetween('created_at', 
                            [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                        )  
         // ->whereYear('created_at', date('Y'))
            ->groupBy('label')
            ->orderBy('y','ASc')
            ->get();
       

           // dd($users->toArray());

          if(!is_null($users) && count($users)>0)
          {
            $status = true; 
            $datas = $users;
          }
          else{
            $datas = $users;
            $status = false;
          }
          return response()->json(['status'=>$status,"data"=>$datas]);
        }

        if($type ==2)
        {

          $users = User::select(
            DB::raw("(COUNT(*)) as y"),
            DB::raw("MONTHNAME(created_at) as label")
          
          )
          ->where('user_type',3)
          ->whereBetween('created_at',[Carbon::now()->subMonth(6), Carbon::now()])
          ->groupBy('label')
           // ->orderBy("MONTH(created_at)",'Asc')
          ->get();
            
          
            if(!is_null($users) && count($users)>0)
            {
              $status = true; 
              $datas = $users;
            }
            else{
              $datas = $users;
              $status = false;
            }
          //  dd($datas->toArray());
          return response()->json(['status'=>$status,"data"=>$datas]);
       }
        if($type ==3)
        {
          $users = User::select(
          DB::raw("(COUNT(*)) as y"),
          DB::raw("YEAR(created_at) as label")
          )
          ->where('user_type',3)
          ->whereBetween('created_at',[Carbon::now()->subYear(6), Carbon::now()])
          ->groupBy('label')
          ->get();
          if(!is_null($users) && count($users)>0)
          {
           $status = true; 
           $datas = $users;
          }
          else{
            $datas = $users;
            $status = false;
          }
          return response()->json(['status'=>$status,"data"=>$datas]);
        }
      }
    }

    public function orderChart(Request $request){
      if($request->all()){
        $type =$request->type;//1 for week 2 for month or 3 for year get all previous 6 month/week/year

        if($type ==1)
        {
          $orders=   Orders::select(
            DB::raw("(COUNT(*)) as y"),
            DB::raw("DAYNAME(created_at) as label"))
            ->whereBetween('created_at', [today()->startOfWeek()->subWeeks(6), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->groupBy('label')
            ->orderBy('y','ASc')
            ->get();
       

          if(!is_null($orders) && count($orders)>0)
          {
            $status = true; 
            $datas = $orders;
          }
          else{
            $datas = $orders;
            $status = false;
          }
          return response()->json(['status'=>$status,"data"=>$datas]);
        }
        if($type ==2)
        {

          $orders = Orders::select(
            DB::raw("(COUNT(*)) as y"),
            DB::raw("MONTHNAME(created_at) as label")
          )
          ->whereBetween('created_at',[Carbon::now()->subMonth(6), Carbon::now()])
          ->groupBy('label')
          ->get();
            
        
            if(!is_null($orders) && count($orders)>0)
            {
              $status = true; 
              $datas = $orders;
            }
            else{
              $datas = $orders;
              $status = false;
            }
          //  dd($datas->toArray());
          return response()->json(['status'=>$status,"data"=>$datas]);
       }
       if($type ==3)
       {
         $orders = Orders::select(
         DB::raw("(COUNT(*)) as y"),
         DB::raw("YEAR(created_at) as label")
         )
         ->whereBetween('created_at',[Carbon::now()->subYear(6), Carbon::now()])
         ->groupBy('label')
         ->get();
         if(!is_null($orders) && count($orders)>0)
         {
          $status = true; 
          $datas = $orders;
         }
         else{
           $datas = $orders;
           $status = false;
         }
         return response()->json(['status'=>$status,"data"=>$datas]);
       }
      }
    }


       //Restaurent More Details Show Like Branch
       public function branch_list($id){
        $user = auth()->user();
      if(!is_null($user) && $user->is_admin==1)
      {
         $RestaurentData =  User::where("id",decrypt($id))->first();
          $user_id = decrypt($id);
         $name = isset($RestaurentData->name) ? $RestaurentData->name :'';
          return view('admin/branch/index',compact('name','user_id'));
      }
      else
      {
          return redirect('/');
      }
  }

  public function branchdata(Request $request)
  {
      $user_id= $request->id; 
    
      if($request->ajax()) {

        $query = Branch::where("user_id",$user_id)->latest();
       // dd($query->get());
          ## Read value
            $draw = $request->get('draw');
            $offset = $request->get("start");
            $limit = $request->get("length"); // Rows display per page
            
            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');
            
            
            $columnIndex = $columnIndex_arr[0]['column'];
            $columnName = $columnName_arr[$columnIndex]['data'];
            $columnSortOrder = $order_arr[0]['dir']; 

            $restaurent_name=  $request->get('restaurent_name');
          //  $firstname = $request->get('firstname');

            if(!empty($request->get('restaurent_name')))
            {
                $query->where('name','like','%'.$restaurent_name.'%');
            }
            if(!empty($search_arr))
            {
                $query->where('name','like','%'.$search_arr.'%');
            }
            
            
            
            $totalRecords = $query->count();
          
            $data = $query->offset($offset)->limit($limit)->get();

            $datas = array();
         // dd($data);
            if(!empty($data)){
            $i=1;
            foreach($data as $row){
                $row['id'] = $i;
               $row['image'] = '<img src="'.asset('public/'.$row->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/admin/customer/edit/'),encrypt($row->id));
                $view = Helper::viewAction(url('/admin/customer/show/'),encrypt($row->id));
                $row['action'] =Helper::action($edit." ".$view);
              $row['unique_id'] = $row->unique_id;

              $row['name'] = $row->name;
               $row['contact1'] = $row->contact1;
               $row['contact2'] = $row->contact2;
               $row['opeing_time'] = $row->opeing_time;
               $row['close_time'] = $row->close_time;
                 $row['manager']= Helper::viewAction(url('/admin/manager/'),encrypt($row->id));
                 $row['address'] ="<textarea style='width: 200px;height:100' class='form-control' readonly>".$row->address."</textarea>";
                 $id = $row->id;
                 $sel = "<select class='form-control form-select StatusChange' data-record_id='{{$id}}' data-url = '{{url('admin/branch/status_change')}}'>";
                $sel .= "<option value='Active' " . ((isset($row['status']) && $row['status'] == 'Active') ? 'Selected' : '') . ">Active</option>";
                $sel .= "<option value='Inactive' " . ((isset($row['status']) && $row['status'] == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                $sel .= "</select>";

                $row['status'] =$sel;
                $datas[] = $row;
                $i++;
            }
          }
          if(!is_null($datas))
          {
            $response= $datas;
          }  
          else{
            $response=null;
          }
   
         return response()->json(array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $response
         ));
          
      }
  }   

  public function branch_status_change(Request $request){
      //  dd($request->all());
        $user = auth()->user();
        if(!is_null($user)){
           $update= Branch::where("id",$request->id)->update(array('status'=>$request->status));
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
