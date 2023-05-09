<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Banners;
use File;
use DataTables;
use Str;
use Helper;

class BannersController extends Controller
{
    protected  $page = 'banners';
   
    public function index(){
        $user = auth()->user();
        if(!is_null($user)){
            $query =Banners::where('id','!=',0);
            if($user->is_admin==2)
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            return view('restaurent/banners/index',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function create(){
        $user = auth()->user();

      //  dd($user);
        if(!is_null($user)){
            if($user->is_admin==2){
                $data= Banners::where("user_id",auth()->user()->id)->get();
                return view('restaurent/banners/create',compact('data'));
            }
        }else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
   
//           dd($request->all());
        $user = auth()->user();
    //   dd($user);
        if(!is_null($user)){
            
            $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
                'description' => 'required'
            ],
            [
                'title.required' => 'Please Enter Title',
                'image.required' => 'Please Select Image',
                'description.required' => 'Please Enter Description',
            ]);
     
            $bannerDate = new Banners;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                 
                    $path = public_path('upload/restaurent/banners/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $image="";
                    if($request->hasfile('image'))
                    {
                        $imageName = time().rand(1,50).'.'.$request->image->extension();
                        $request->image->move($path, $imageName);
                        $image.='/upload/restaurent/banners/'.$imageName;
                    }
                    
                    $bannerDate->user_id = $user->id;
                    
                  //  $bannerDate->image = $image;
                    $bannerDate->user_id = $user->id;
                    
                    $bannerDate->title = $request->title;
                    $bannerDate->images = $image;
                    $bannerDate->description = isset($request->description) ?$request->description :'';
                    if($bannerDate->save()){
                        $bannerDate->unique_id = "BNR-000".$user->id.$bannerDate->id;
                        $bannerDate->save();
                        return redirect('restaurent/banner')->with('success','Banners Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/banner')->with('error','Banners Added Failed');
                    }
                }
        
    }else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
           $data = Banners::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                return view('admin/banners/edit',compact('data'));
                }else if($user->is_admin==2){
                 return view('restaurent/banners/edit',compact('data'));
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
                    'title' => 'required',
                    'image' => 'image|mimes:png,jpg,jpeg|max:2048',
                    'description' => 'required'
                ],
                [
                    'title.required' => 'Please Enter Title',
                    'image.required' => 'Please Select Image',
                    'description.required' => 'Please Enter Description',
                ]);
         
        }

            if(!empty($request->all())){
                $bannerData =  Banners::find($request->id);
        
                $path = public_path('upload/restaurent/banner/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    if(!empty($bannerData->images))
                    {

                        unlink("public/".$bannerData->images);
                    }
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move($path, $imageName);
                    $image.='/upload/restaurent/banner/'.$imageName;
                    $bannerData->images = $image;
                }
                else{
                    $image = $bannerData->images;
                } 
                 
                $bannerData->title = isset($request->title) ? $request->title :$bannerData->title;
                $bannerData->description = isset($request->description) ? $request->description :$bannerData->description;
                
                $bannerData->images = $image;
                if($bannerData->save()){
                    return redirect('restaurent/banner')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/banner')->with('error','Data updated Failed');
                }
            }
        }
        else{
            return redirect('login');
        }
    }

    public function data(Request $request){
        if ($request->ajax()) {
            $limit =$request->input('length');
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
            $querydata = Banners::where('user_id',auth()->user()->id)->latest();
            if (!is_null($search) && !empty($search)) {
                $querydata->where(function($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%');
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
                
                $row['title'] = isset($value->title)? $value->title:'-';
                $row['description'] = isset($value->description)? $value->description:'-';
              
                $row['image']='<img src="'.asset('public/'.$value->images).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/banner/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.banner.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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

    public function status_change(Request $request){
     //   dd($request->all());
        $change     =   $this->changeStatus('Banners',$request);
        if($change){

            return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
        }else{
            return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
        }
    }
}
