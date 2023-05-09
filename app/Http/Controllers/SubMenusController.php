<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategories;
use App\Models\User;
use File;

use DataTables;
use Str;
use Helper;
class SubMenusController extends Controller
{
    public function index(){
        $user = auth()->user();
        $page = "Menu";
        if(!is_null($user)){
            $query =SubCategories::where('id','!=',0);
            if($user->is_admin==1)
            {
                $query->get();
            }
            else
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();

            //$data = SubCategories::where(['user_id'=>$user->id])->get();
            if($user->is_admin==1){
                return view('admin/sub_menu/index',compact('page','data'));
            }else if($user->is_admin==2){
                return view('restaurent/sub_menu/index',compact('page','data'));
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
            $menu= Category::where("status",'Active')->get();
            if($user->is_admin==1){
                $restaurentlist= User::where("status",'Active')->where("is_admin",2)->get();
                return view('admin/sub_menu/create',compact('page','menu','restaurentlist','data'));
            }else if($user->is_admin==2){
                return view('restaurent/sub_menu/create',compact('page','menu','data'));
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
                'category_id'=>"required",
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'price' => 'required',
                'discount'=>'required',
                'description' => 'required',
            ],
            [
                'category_id.required' => 'Please Select Menu.',
                'name.required' => 'Please Enter Name',
                'image.required' => 'Please Select Image',
                'price.required' => 'Please Enter price',
                'discount.required' => 'Please Enter discount',
                'description.required' => 'Please Select Description',
            ]);
        }
        else if($user->id_admin==1)
        {
            $request->validate([
                'category_id'=>"required",
                'name' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'price' => 'required',
                'discount'=>'required',
                'description' => 'required',
            ],
            [
                'category_id.required' => 'Please Select Menu.',
                'name.required' => 'Please Enter Name',
                'image.required' => 'Please Select Image',
                'price.required' => 'Please Enter price',
                'discount.required' => 'Please Enter discount',
                'description.required' => 'Please Select Description',
            ]);
        }
        //  dd($request->all());
            $categories = new SubCategories;
            if(!empty($request->all())){
            $check= SubCategories::where('name',$request->name);
                if($user->is_admin==1){
                    $check->where('user_id',$request->user_id)->where('category_id',$request->category_id);
                }else if($user->is_admin==2){
                    $check->where('user_id',$user->id)->where('category_id',$request->category_id);
                }
           $checkData= $check->count();
            //   dd($check);
            if($checkData>0){
                    return redirect()->back()->with('error',''.$request->name. 'Menu Already Exists');
                }
                else
                {
                    $path = public_path('upload/restaurent/sub_menus/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    } 
                    $image="";
                    if($request->hasfile('image'))
                    {
                        $imageName = time().rand(1,50).'.'.$request->image->extension();
                        $request->image->move($path, $imageName);
                        $image.='/upload/restaurent/sub_menus/'.$imageName;
                    }
                    //multiple image
                    $images="";
                    if($request->hasfile('images'))
                    {
                        foreach($request->file('images') as $file)
                        {
                            $name = time().rand(1,50).'.'.$file->extension();
                            $file->move($path, $name);  
                            $images.='/upload/restaurent/sub_menus/'.$name.",";
                        }
                    } 

                    $categories->category_id = $request->category_id;
                    $categories->name = $request->name;
                    
                    $categories->image = $image;
                    $categories->images = $images;
                    
                    if($user->is_admin==1)
                    {
                        $categories->user_id = $request->user_id;
                    }
                    else
                    {
                        $categories->user_id = $user->id;
                    }
                    $categories->description =$request->description;
                    $categories->price =$request->price;
                    $categories->discount =$request->discount;
                    if($categories->save()){
                        $categories->unique_id = "SM-000".$categories->id;
                        $categories->save();
                        return redirect()->back()->with('success','Data added Successfully');
                    }
                    else{
                        return redirect()->back()->with('error','Data added Failed');
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
           $data = SubCategories::find(decrypt($id));
         //   dd($data);
            if(!is_null($data)){
                $restaurentlist= User::where("status",'Active')->where("is_admin",2)->get();
                if($user->is_admin==1){
                    $menu= Category::where("status",'Active')->where('user_id',$data->user_id)->get();
                    return view('admin/sub_menu/edit',compact('data','menu','restaurentlist'));
                }else if($user->is_admin==2){
                    $menu= Category::where("status",'Active')->get();
                    return view('restaurent/sub_menu/edit',compact('data','menu'));
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
            $menu= Category::where("status",'Active')->get();
            $data = SubCategories::find(decrypt($id));
           // dd($data);
            if(!is_null($data)){
                $data->menu_name = $data->menuDetails->name;
                if($user->is_admin==1){
                    return view('admin/sub_menu/show',compact('data','menu'));
                }else if($user->is_admin==2){
                    return view('restaurent/sub_menu/show',compact('data','menu'));
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
            $request->validate([
                'category_id'=>"required",
                'name' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg|max:2048',
                'price' => 'required',
                'discount'=>'required',
                'description' => 'required',
            ],
            [
                'category_id.required' => 'Please Select Menu.',
                'name.required' => 'Please Enter Name',
                'image.mimes' => 'Please Select Image',
                'price.required' => 'Please Enter price',
                'discount.required' => 'Please Enter discount',
                'description.required' => 'Please Select Description',
            ]);

            if(!empty($request->all())){
                $sub_categories =  SubCategories::find($request->id);
        
                $path = public_path('upload/restaurent/sub_menus/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                   // unlink("public/".$sub_categories->image);
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.= '/upload/restaurent/sub_menus/'.$imageName;
                    $sub_categories->image = $image;
                } 
                //multiple image
                $images="";
                if($request->hasfile('images'))
                {
                    foreach($request->file('images') as $file)
                    {
                        $name = time().rand(1,50).'.'.$file->extension();
                        $file->move($path, $name);  
                        $images.='/upload/restaurent/sub_menus/'.$name.",";
                    }
                    $sub_categories->images = $sub_categories->images.$images;
                } 
                $sub_categories->category_id = isset($request->category_id) ? $request->category_id : $sub_categories->category_id;
                $sub_categories->name = isset($request->name) ? $request->name : $sub_categories->name;
                $sub_categories->price = isset($request->price) ? $request->price : $sub_categories->price;
                $sub_categories->discount = isset($request->discount) ? $request->discount : $sub_categories->discount;
                $sub_categories->description = isset($request->description) ? $request->description : $sub_categories->description;
              //  $sub_categories->user_id = $user->id;
                    if($user->is_admin==1)
                    {
                        $sub_categories->user_id = $request->user_id;
                    }
                    else
                    {
                        $sub_categories->user_id = $user->id;
                    }
                if($sub_categories->save()){
                    return redirect()->back()->with('success','Data updated Successfully');
                }
                else{
                    return redirect()->back()->with('error','Data updated Failed');
                }
            }
        }
        else{
            return redirect('login');
        }
    }

    
    public function status_change(Request $request){
        $change     =   $this->changeStatus('SubCategories',$request);
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
            $data = SubCategories::latest()->get();
            if(!empty($data)){
                foreach($data as $row){
                    $row->restaurent_name = $row->restaurentDetails->name;
                   $row->menu_name = $row->menuDetails->name;
                }
            }
          // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('restaurent_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['restaurent_name'], $request->get('restaurent_name')) ? true : false;
                        });
                    }
                    if (!empty($request->get('menu_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['menu_name'], $request->get('menu_name')) ? true : false;
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
                $btn = '<a href="'.url('/admin/sub_menu/edit/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                $btn = $btn.='<a href="'.url('/admin/sub_menu/show/').'/'.encrypt($row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-arrow-right"></i></a>';
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
           $unique_id = $request['unique_id'];
            $querydata = SubCategories::latest();
            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }
            if (!is_null($unique_id) && !empty($unique_id)) {
                $querydata->where(function($query) use ($unique_id) {
                    $query->orwhere('name', 'LIKE', '%' . $unique_id . '%');
                    $query->orwhere('unique_id', 'LIKE', '%' . $unique_id . '%');
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
              
                $row['restaurent_name'] = $value->restaurentDetails->name;
                $row['menu_name'] = $value->menuDetails->name;

                
                $row['unique_id'] = isset($value->unique_id)? $value->unique_id:'-';
               
                $row['name'] = isset($value->name)? $value->name:'-';
               
                $row['image']='<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/sub_menu/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.sub_menu.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
