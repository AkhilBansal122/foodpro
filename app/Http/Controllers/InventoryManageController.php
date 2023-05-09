<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Inventory;
use App\Models\InventoryTracking;
use App\Models\Product;


use File;
use DataTables;
use Str;
use Validator;
use App\Exports\StockHistoryExport;
use Excel;
use Helper;
class InventoryManageController extends Controller
{
    public function index(){
        
        $user = auth()->user();
        if(!is_null($user)){
            $query =Inventory::where('id','!=',0);
            if($user->is_admin==2)
            {
                $query->where(['user_id'=>$user->id]);
            }
            $data =$query->get();
            return view('restaurent/inventory/index',compact('data'));
        }else{
            return redirect('login');
        }
    }

    public function create(){
        $user = auth()->user();
        $product = Product::where('status','Active')->get();

      //  dd($user);
        if(!is_null($user)){
            if($user->is_admin==2){
             //   $data= Inventory::where("user_id",auth()->user()->id)->get();
                return view('restaurent/inventory/create',compact('product'));
            }
        }else{
            return redirect('login');
        }
    }
    
    public function store(Request $request){
   
        //   dd($request->all());
        $user = auth()->user();
    //  dd($request->all());
        if(!is_null($user)){
            

            $request->validate([
                'product_id' => 'required',
                'qty_num' => 'required',
                'qty_opt' => 'required',
                'price' => 'required',
            ],
            [
                'product_id.required' => 'Please Enter Select Product',
                'qty_num.required' => 'Please Enter Qty in Number',
                'qty_opt.required' => 'Please Enter Qty in Kg/Quintal/Ton',
                'price.required' => 'Please Enter Qty in Number',
            ]);

     
            $inventoryData = new Inventory;
            if(!empty($request->all())){
            $check= User::where('id',"!=",0);
               //     dd($request->product_id);
                    $inventoryData->product_id = $request->product_id;
                    
                    
                        $inventoryData->user_id = $user->id;
                    
                        $inventoryData->qty_num = $request->qty_num;
                        $inventoryData->qty_opt = $request->qty_opt;   
                        $inventoryData->price = $request->price;        
                  //      dd($inventoryData);
                        if($inventoryData->save()){
                        $inventoryData->save();
                        $InventoryTracking = new InventoryTracking();
                        $InventoryTracking->inventory_id =$inventoryData->id; 
                        $InventoryTracking->product_id = $request->product_id;
                        $InventoryTracking->user_id = $user->id;
                        $InventoryTracking->cr_qty = $request->qty_num;
                        $InventoryTracking->dr_qty = 0;
                        $InventoryTracking->purchase_rate = $request->price;
                        $InventoryTracking->save();

                        $total_invCr=  InventoryTracking::where(['inventory_id'=>$inventoryData->id,'user_id'=>$user->id])->sum('cr_qty');
                        $total_invdr=  InventoryTracking::where(['inventory_id'=>$inventoryData->id,'user_id'=>$user->id])->sum('dr_qty');
   
                        $available = $total_invCr-$total_invdr;
                        $inventoryData->total_cr =$total_invCr;
                        $inventoryData->total_dr =$total_invdr;
                        $inventoryData->total_available =$available;
                        $inventoryData->save();
                            
                        return redirect('restaurent/inventory_manage')->with('success','Inventory Added Successfully');
                    }
                    else
                    {
                        return redirect('restaurent/inventory_manage')->with('error','Inventory Added Failed');
                    }
                }
        
    }else{
            return redirect('login');
        }
    }

    public function edit($id){
        $user = auth()->user();
        if(!is_null($user)){
           $data = Inventory::find(decrypt($id));
            if(!is_null($data)){
                $product = Product::where('status','Active')->get();

            if($user->is_admin==1){
                return view('admin/inventory/edit',compact('data','product'));
                }else if($user->is_admin==2){
                 return view('restaurent/inventory/edit',compact('data','product'));
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
                    'product_id' => 'required',
                    'qty_num' => 'required',
                    'qty_opt' => 'required',
                    'price' => 'required',
                ],
                [
                    'product_id.required' => 'Please Select Product',
                   
                    'qty_num.required' => 'Please Enter Qty in Number',
                    'qty_opt.required' => 'Please Enter Qty in Kg/Quintal/Ton',
                    'price.required' => 'Please Enter Qty in Number',
                ]);
         
        }

            if(!empty($request->all())){
                $inventoryData =  Inventory::find($request->id);
                $inventoryData->product_id = isset($request->product_id) ? $request->product_id :$inventoryData->product_id;
                $inventoryData->qty_num = isset($request->qty_num) ? $request->qty_num :$inventoryData->qty_num;
                $inventoryData->qty_opt = isset($request->qty_opt) ? $request->qty_opt :$inventoryData->qty_opt;
                $inventoryData->price = isset($request->price) ? $request->price :$inventoryData->price;

                if($inventoryData->save()){
                    $InventoryTracking = new InventoryTracking();
                    $InventoryTracking->inventory_id =$inventoryData->id; 
                    $InventoryTracking->product_id = $request->product_id;
                    $InventoryTracking->user_id = $user->id;
                    $InventoryTracking->cr_qty = $request->qty_num;
                    $InventoryTracking->purchase_rate = $request->price;
                    $InventoryTracking->dr_qty = 0;
                    $InventoryTracking->save();
                  
                  $total_invCr=  InventoryTracking::where(['inventory_id'=>$inventoryData->id,'user_id'=>$user->id])->sum('cr_qty');
                  $total_invdr=  InventoryTracking::where(['inventory_id'=>$inventoryData->id,'user_id'=>$user->id])->sum('dr_qty');
                  
                  $available = $total_invCr-$total_invdr;
                  $inventoryData->total_cr =$total_invCr;
                  $inventoryData->total_dr =$total_invdr;
                  $inventoryData->total_available =$available;
                  $inventoryData->save();
                  return redirect('restaurent/inventory_manage')->with('success','Data updated Successfully');
                }
                else{
                    return redirect('restaurent/inventory_manage')->with('error','Data updated Failed');
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
            $querydata = Inventory::where('user_id',auth()->user()->id)->latest();
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
                $row['product_name'] = isset($value->productDetails)? $value->productDetails->product_name:'-';
                
                $row['qty_num'] = isset($value->qty_num)? $value->qty_num:'-';
                $row['qty_opt'] = isset($value->qty_opt)? $value->qty_opt:'-';
                $row['price'] = isset($value->price)? $value->price:'-';
               
                $edit = Helper::editAction(url('/restaurent/inventory_manage/edit/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.inventory_manage.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
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
           $change     =   $this->changeStatus('Inventory',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
    }

    public function stockHistory(){
        if(auth()->user()->is_admin==2)
        {
            return view('restaurent/stock/stockHistory');
        }
    }
    public function stockHistoryRestaurent(Request $request){
        if ($request->ajax()) {
          $limit = $request->input('length');
          $start = $request->input('start');
         
          $search = $request['search'];
          $search_key = $request['search_key'];
         
          $start_date = $request['start_date'];
          $end_date = $request['end_date'];
         
          $orderby = $request['order']['0']['column'];
          $order = $orderby != "" ? $request['order']['0']['dir'] : "";
          $draw = $request['draw'];
          if(auth()->user()->is_admin==2)
          {
            $wereHouseId = User::where(["user_id"=>auth()->user()->id,'is_admin'=>6])->first();
            if(isset($wereHouseId))
            {
                $where_in=auth()->user()->id.",".$wereHouseId->id;
            }
            else{
                $where_in=auth()->user()->id.",";
            }

          $querydata = InventoryTracking::join('products',"products.id","=","inventory_trackings.product_id")->whereIn("inventory_trackings.user_id",explode(",",$where_in))->latest();
         
          if (!is_null($search_key) && !empty($search_key)) {
              $querydata->where(function($query) use ($search_key) {
                  $query->where('products.product_name', 'LIKE', '%' . $search_key . '%');
              });
          }

          if(isset($start_date) && isset($end_date))
          {
              $querydata->whereBetween('inventory_trackings.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
          }
          if(isset($start_date))
          {
              $querydata->whereBetween('inventory_trackings.created_at',[$start_date.' 00:00:01',date('Y-m-d H:i:s')]);
          }
          $totaldata = $querydata->count();
           $response = $querydata->offset($start)
                  ->limit($limit)
                  ->get(['inventory_trackings.*','products.product_name']);
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
              $row['product_name'] = isset($value->productDetails)? $value->productDetails->product_name:'-';
              $row['cr_qty'] = isset($value->cr_qty)? $value->cr_qty:'-';
              $row['dr_qty'] = isset($value->dr_qty)? $value->dr_qty:'-';
              $row['purchase_rate'] = isset($value->purchase_rate)? $value->purchase_rate:'-';
              $row['option'] = isset($value->inventoryDetails->qty_opt)? $value->inventoryDetails->qty_opt:'-';
              $row['created_at'] = isset($value->created_at)? date("d-m-Y", strtotime($value->created_at)) :'-';
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
    public function exportExcelstockHistory(Request $request){
        $search = $request['search'];
        $search_key = $request['search_key'];
       
        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
       
        if(auth()->user()->is_admin==2)
          {
            $wereHouseId = User::where(["user_id"=>auth()->user()->id,'is_admin'=>6])->first();
            if(isset($wereHouseId))
            {
                $where_in=auth()->user()->id.",".$wereHouseId->id;
            }
            else{
                $where_in=auth()->user()->id.",";
            }

          $querydata = InventoryTracking::join('products',"products.id","=","inventory_trackings.product_id")->whereIn("inventory_trackings.user_id",explode(",",$where_in))->latest();
         
          if (!is_null($search_key) && !empty($search_key)) {
              $querydata->where(function($query) use ($search_key) {
                  $query->where('products.product_name', 'LIKE', '%' . $search_key . '%');
              });
          }

          if(isset($start_date) && isset($end_date))
          {
              $querydata->whereBetween('inventory_trackings.created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
          }
          if(isset($start_date))
          {
              $querydata->whereBetween('inventory_trackings.created_at',[$start_date.' 00:00:01',date('Y-m-d H:i:s')]);
          }
           $response =$querydata->get(['inventory_trackings.*','products.product_name']);
          if (!$response) {
              $data = [];
              
          } else {
              $data = $response;
          }
          if(!empty($data) && count($data)>0)
          {
            $result= array();
            $i=1;
            foreach($data as $k=> $record){
    
                $result[] = array(
                   'Sr no'=>$i++,
                   'Product Name' => isset($record->productDetails) ?  $record->productDetails->product_name :'-',
                   'Purchase ' => isset($record->cr_qty) ?  $record->cr_qty : '0',
                   'Sell' => isset($record->dr_qty) ?  $record->dr_qty : '0',
                   'Purchase Price' => isset($record->purchase_rate) ?  $record->purchase_rate :0,
                   'option' => isset($record->inventoryDetails->qty_opt) ?  $record->inventoryDetails->qty_opt :0,
                   'created_at' => isset($record->created_at)? date("d-m-Y", strtotime($record->created_at)) :'-'
                );
             }
          }
        $file_name = 'StockHostory '.date('Y-m-d-s').'.xlsx'; 
        return Excel::download(new StockHistoryExport($result), $file_name);
    }
}
}
