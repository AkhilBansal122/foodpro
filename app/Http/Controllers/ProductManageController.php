<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use File;
use DataTables;
use Str;
use Helper;
class ProductManageController extends Controller
{
    public function index(){
        
        $user = auth()->user();
        if(!is_null($user)){
            $query =Product::where('id','!=',0);
            if($user->is_admin==2)
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            return view('restaurent/product/index',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function create(){
        $user = auth()->user();

      //  dd($user);
        if(!is_null($user)){
            if($user->is_admin==2){
                $data= Product::where("user_id",auth()->user()->id)->get();
                return view('restaurent/product/create',compact('data'));
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
                'product_name' => 'required'
            ],
            [
                'Product Name.required' => 'Please Enter Product Name',
            ]);

     
            $productData = new Product;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
                    
                    // $ProductData->user_id = $user->id;
                    
                        $productData->user_id = $user->id;
                    
                        $productData->product_name = $request->product_name;     
                        if($productData->save()){
                        $productData->save();
                        return redirect('restaurent/product_manage')->with('success','Product Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/product_manage')->with('error','Product Added Failed');
                    }
                }
        
    }else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
           $data = Product::find(decrypt($id));
            if(!is_null($data)){
            if($user->is_admin==1){
                return view('admin/product/edit',compact('data'));
                }else if($user->is_admin==2){
                 return view('restaurent/product/edit',compact('data'));
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
                    'product_name' => 'required'
                ],
                [
                    'product_name.required' => 'Please Enter Product Name'
                ]);
         
        }

            if(!empty($request->all())){
                $productData =  Product::find($request->id);
                 
                $productData->product_name = isset($request->product_name) ? $request->product_name :$ProductData->product_name;
                
                if($productData->save()){
                    return redirect('restaurent/product_manage')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/product_manage')->with('error','Data updated Failed');
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
            $querydata = Product::where('user_id',auth()->user()->id)->latest();
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
                $row['product_name'] = isset($value->product_name)? $value->product_name:'-';
               
                $edit = Helper::editAction(url('/restaurent/product_manage/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.product_manage.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
           $change     =   $this->changeStatus('Product',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
       }
}
