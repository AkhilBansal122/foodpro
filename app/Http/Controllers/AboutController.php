<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\About;
use File;
use DataTables;
use Str;
use Validator;
use Helper;
class AboutController extends Controller
{
    public function index(){
        
        $user = auth()->user();
        if(!is_null($user)){
            $query =About::where('id','!=',0);
            if($user->is_admin==2)
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            return view('restaurent/about/index',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function create(){
        $user = auth()->user();
        if(!is_null($user)){
            if($user->is_admin==2){
                $data= About::where("user_id",auth()->user()->id)->first();
                return view('restaurent/about/create',compact('data'));
            }
        }else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
   
        //   dd($request->all());
        $user = auth()->user();
        //   dd($user);
        if(!is_null($user)){
            

            $request->validate([
                'title' => 'required',
                'image' => 'required',
                'description' => 'required'
            ],
            [
                'title.required' => 'Please Enter Title',
                'image.required' => 'Please Select image',
                'description.required' => 'Please Enter Description',
            ]);

     
            $aboutData = new About;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                 
                 $path = public_path('upload/restaurent/about/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $image="";
                    

                  if ($request->file('image')) {
                    $i=0;
                    foreach($request->file('image') as $file)
                    {
                        $imageName = time().$i.'.'.$file->extension();  
                        $file->move(public_path('upload/restaurent/about'), $imageName);  
                        $image .= "/upload/restaurent/about/".$imageName.","; 
                        $i++;
                    }
                    $aboutData->image = $image;
                    }
                    
                    
                    $aboutData->user_id = $user->id;
                    
                    $aboutData->title = $request->title;
                    $aboutData->image = $image;
                    $aboutData->description = isset($request->description) ?$request->description :'';
                    if($aboutData->save()){
                        return redirect('restaurent/aboutus')->with('success','about Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/aboutus')->with('error','about Added Failed');
                    }
                }
        
    }else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
           $data = About::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                return view('admin/about/edit',compact('data'));
                }else if($user->is_admin==2){
                 return view('restaurent/about/edit',compact('data'));
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
                    'image' => 'image',
                    'description' => 'required'
                ],
                [
                    'title.required' => 'Please Enter Title',
                    'image.required' => 'Please Select image',
                    'description.required' => 'Please Enter Description',
                ]);
         
        }

            if(!empty($request->all())){
                $aboutData =  About::where("user_id",auth()->user()->id)->first();
        
                $path = public_path('upload/restaurent/about/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $image="";
                if($request->hasfile('image'))
                {
                    if(!empty($aboutData->image))
                    {
                        foreach(explode(",", $aboutData->image) as $remove)
                        {
                           // unlink("public/".$remove);
                        }
                    }
                    $i=0;
                    foreach($request->file('image') as $file)
                    {
                        $imageName = time().$i.'.'.$file->extension();  
                        $file->move(public_path('upload/restaurent/about'), $imageName);  
                        $image .= "/upload/restaurent/about/".$imageName.","; 
                        $i++;
                    }
                    $aboutData->image = rtrim($image,",");
                }
                else{
                    $image = $aboutData->image;
                } 
    
                $aboutData->title = isset($request->title) ? $request->title :$aboutData->title;
                $aboutData->description = isset($request->description) ? $request->description :$aboutData->description;

                if($aboutData->save()){
                    return back()->with('success','Data updated Successfully');
                }
                else{
                    return back()->with('error','Data updated Failed');
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
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
        //    $status = $request['status'] ?? null;
          //  $start_date = $request['start_date'] ?? null ;
            //$end_date = $request['end_date'] ?? null; 
          //  echo auth()->user()->id;
           // die;
            $querydata = About::where('user_id',auth()->user()->id)->latest();
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
               
                $row['image']='<img src="'.asset('public/'.$value->image).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/aboutus/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.aboutus.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
           $change     =   $this->changeStatus('about',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
    }
}
