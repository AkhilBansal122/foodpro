<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;
use File;
use DataTables;
use Str;
use Validator;
use Helper;
class ServicesController extends Controller
{
    public function index(){
        
        $user = auth()->user();
        if(!is_null($user)){
            $query =Service::where('id','!=',0);
            if($user->is_admin==2)
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            return view('restaurent/services/index',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function create(){
        $user = auth()->user();

      //  dd($user);
        if(!is_null($user)){
            if($user->is_admin==2){
                $data= Service::where("user_id",auth()->user()->id)->get();
                return view('restaurent/services/create',compact('data'));
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
                'icon' => 'required|mimes:png,ico,fav,jpg,jpeg|max:2048',
                'description' => 'required'
            ],
            [
                'title.required' => 'Please Enter Title',
                'icon.required' => 'Please Select icon',
                'description.required' => 'Please Enter Description',
            ]);

     
            $serviceData = new Service;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                 
                    $path = public_path('upload/restaurent/service/');
                    if(!File::isDirectory($path)){
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $icon="";
                    if($request->hasfile('icon'))
                    {
                        $iconName = time().rand(1,50).'.'.$request->icon->extension();
                        $request->icon->move($path, $iconName);
                        $icon.='/upload/restaurent/service/'.$iconName;
                    }
                    
                    $serviceData->user_id = $user->id;
                    
                  //  $serviceData->icon = $icon;
                    
                        $serviceData->user_id = $user->id;
                    
                    $serviceData->title = $request->title;
                    $serviceData->icon = $icon;
                    $serviceData->description = isset($request->description) ?$request->description :'';
                    if($serviceData->save()){
                        $serviceData->unique_id = "BNR-000".$user->id.$serviceData->id;
                        $serviceData->save();
                        return redirect('restaurent/services')->with('success','Service Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/services')->with('error','Service Added Failed');
                    }
                }
        
    }else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
           $data = Service::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                return view('admin/services/edit',compact('data'));
                }else if($user->is_admin==2){
                 return view('restaurent/services/edit',compact('data'));
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
                    'icon' => 'icon|mimes:png,jpg,jpeg|max:2048',
                    'description' => 'required'
                ],
                [
                    'title.required' => 'Please Enter Title',
                    'icon.required' => 'Please Select icon',
                    'description.required' => 'Please Enter Description',
                ]);
         
        }

            if(!empty($request->all())){
                $serviceData =  Service::find($request->id);
        
                $path = public_path('upload/restaurent/service/');
                
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                } 
                $icon="";
                if($request->hasfile('icon'))
                {
                    if(!empty($serviceData->icon))
                    {

                        unlink("public/".$serviceData->icon);
                    }
                    $iconName = time().'.'.$request->icon->extension();
                    $request->icon->move($path, $iconName);
                    $icon.='/upload/restaurent/service/'.$iconName;
                    $serviceData->icon = $icon;
                }
                else{
                    $icon = $serviceData->icon;
                } 
                 
                $serviceData->title = isset($request->title) ? $request->title :$serviceData->title;
                $serviceData->description = isset($request->description) ? $request->description :$serviceData->description;
                
                $serviceData->icon = $icon;
                if($serviceData->save()){
                    return redirect('restaurent/services')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/services')->with('error','Data updated Failed');
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
            $querydata = Service::where('user_id',auth()->user()->id)->latest();
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
               
                $row['icon']='<img src="'.asset('public/'.$value->icon).'" border="0" class="rounded-circle" width="35" align="center" />';
                $edit = Helper::editAction(url('/restaurent/services/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.services.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
           $change     =   $this->changeStatus('Service',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
    }
}
