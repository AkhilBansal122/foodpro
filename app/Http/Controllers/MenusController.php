<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use File;
use DataTables;
use Str;
use Helper;
class MenusController extends Controller
{
    
    public function index(){
        $user = auth()->user();
        $page = "Menu";
      
        if(!is_null($user)){
            $query = Category::where('id',"!=",0);
            if($user->is_admin==1){
                $data = $query->get();
                return view('admin/menu/index',compact('page','data'));
            }else if($user->is_admin==2){
                $data = $query->where(['user_id'=>$user->id])->get();
                return view('restaurent/menu/index',compact('page','data'));
            }
        }
        else{
            return redirect('login');
        }
    }
    public function create(){
        $user = auth()->user();
        $page = "Menu Create";
        if(!is_null($user)){
            if($user->is_admin==1){
                $restaurentList = User::where('is_admin',2)->get();
                return view('admin/menu/create',compact('page','restaurentList'));
            }else if($user->is_admin==2){
                return view('restaurent/menu/create',compact('page'));
            }
        }
        else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
     //   dd($request->all());
        $user = auth()->user();
        $request->validate([
           // 'user_id' => 'required',
            'type' => 'required',
            'name' => 'required|unique:categories,user_id,' . $user->id,
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ],
        [
            //'user_id.required' => 'Please Select Restaurent.',
            'type.required' => 'Please Select Type.',
            'name.required' => 'Please Enter Name',
            'image.required' => 'Please Select Image'
        ]);
        $categories = new Category;
        if(!empty($request->all())){
        //  dd($request->all());
            $check= Category::where('name',$request->name);
           if(!empty($user) && $user->is_admin==1){
            $check->where('user_id',$request->user_id);
           }
           else{
            $check->where('user_id',$user->id);
           }
           $checkData = $check->count();
          // dd($checkData);
            if($checkData>0){
                return redirect()->back()->with('error',''.$request->name. 'Menu Already Exists');
            }
            else
            {
                $path = public_path('upload/restaurent/menus/');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.='/upload/restaurent/menus/'.$imageName;
                }  
                $categories->type = $request->type;
                $categories->name = $request->name;
                $categories->image = $image;
                if($user->is_admin==1)
                {
                    $categories->user_id = $request->user_id;
                }
                else
                {
                    $categories->user_id = $user->id;
                }
                if($categories->save()){
                    return redirect()->back()->with('success','Data added Successfully');
                }
                else{
                    return redirect()->back()->with('error','Data added Failed');
                }
            }
            
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
            $data = Category::find(decrypt($id));
            $restaurentList = User::where('is_admin',2)->get();
            if(!is_null($data)){
                if($user->is_admin==1){
                    return view('admin/menu/edit',compact('data','restaurentList'));
                }else if($user->is_admin==2){
                    return view('restaurent/menu/edit',compact('data'));
                }
            }
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $request){
        $user = auth()->user();
        //      dd($request->type);
        $request->validate([
            'type' => 'required',
            'name' => 'required|unique:categories,user_id,' . $user->id,
        ],
        [
            'type.required' => 'Please Select Type.',
            'name.required' => 'Please Enter Name',
        ]);

        if(!empty($request->all())){
            $categories =  Category::find($request->id);
       
            $path = public_path('upload/restaurent/menus/');
            
            $check= Category::where('name',$request->name);
           if(!empty($user) && $user->is_admin==1){
            $check->where('id',"!=",$request->id);
            $check->where('user_id',$request->user_id);
           }
           else{
            $check->where('id',"!=",$request->id);
            $check->where('user_id',$user->id);
           }
           $checkData = $check->count();
          // dd($checkData);
            if($checkData>0){
                return redirect()->back()->with('error',''.$request->name. 'Menu Already Exists');
            }
            else{
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    unlink("public/".$categories->image);
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.='/upload/restaurent/menus/'.$imageName;
                    $categories->image = $image;
                } 
                $categories->type = isset($request->type) ? $request->type : $categories->type;
                $categories->name = isset($request->name) ? $request->name : $categories->name;
                if($user->is_admin==1)
                {    
                    $categories->user_id = $request->user_id;
                }
                else if($user->is_admin==2){
                    $categories->user_id = $user->id;
                }
                if($categories->save()){
                    return redirect()->back()->with('success','Data updated Successfully');
                }
                else{
                    return redirect()->back()->with('error','Data updated Failed');
                }
            }
        }
    }
    
    

    public function status_change(Request $request){
        $change     =   $this->changeStatus('Category',$request);
        if($change){

            return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
        }else{
            return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
        }
 }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            if(!empty($data)){
                foreach($data as $row){
                    $row->restaurent_name = $row->restaurentDetails->name;
                }
            }
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
                $btn = '<a href="'.url('admin/menu/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                 return $btn;
                })->rawColumns(['status','image','action'])
                ->make(true);
        }
    }

    public function restaurentdata(Request $request){
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
           // die;
           $type = $request['name'];

            $querydata = Category::latest();
            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }
            if (!is_null($type) && !empty($type)) {
                $querydata->where(function($query) use ($type) {
                    $query->where('name', 'LIKE', '%' . $type . '%');
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
                $row['restaurent_name'] = $value->restaurentDetails->name;
                $row['id'] = $i;
                $row['name'] = isset($value->name)? $value->name:'-';
                $row['description'] = isset($value->description)? $value->description:'-';
                $row['type'] = isset($value->type) ?$value->type :"-";
                $row['image']='<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/menu/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.menu.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
                $sel .= "<option value='Active' " . ((isset($value->status) && $value->status == 'Active') ? 'Selected' : '') . ">Active</option>";
                $sel .= "<option value='Inactive' " . ((isset($value->status) && $value->status == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                $sel .= "</select>";

            $row['status'] =$sel;
                $row['action'] = Helper::action($edit);
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
}
