<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use App\Models\Orders;
use App\Models\Inventory;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!is_null(auth()->user())){
            $is_admin  =auth()->user()->is_admin;
            if($is_admin==1){
            $total_restaurent = User::where('is_admin',2)->count();
             $total_order= Orders::whereIn("branch_id",Branch::whereIn("user_id",User::where('is_admin',2)->get('id'))->get(['id']))->count();  
             $total_revenue= Orders::whereIn("branch_id",Branch::whereIn("user_id",User::where('is_admin',2)->get('id'))->get(['id']))->sum('final_amount');
             $data =[];

               foreach(User::where('is_admin',2)->get() as $row)
               {
                $row->total_order= Orders::whereIn("branch_id",Branch::where("user_id",$row->id)->get(['id']))->count();  
                     $row->total_revenue  =Orders::whereIn("branch_id",Branch::where("user_id",$row->id)->get(['id']))->sum('final_amount');
                    array_push($data,$row);
                }
              //  dd($data);
            //   $total_order=0;
                return view('admin/dashboard',compact('total_restaurent','total_order','total_revenue'));
            }
            else if($is_admin==2){
              $total_branch = Branch::where('user_id',auth()->user()->id)->count();
              $total_manager = User::where('user_id',auth()->user()->id)->where('is_admin',3)->count();
              $total_chef=  User::whereIn('user_id', User::select(['id'])->where(['is_admin'=> 3,'user_id'=>auth()->user()->id]))->where('is_admin', 4)->count();
              $total_order=Orders::whereIn("branch_id",Branch::where('user_id',auth()->user()->id)->pluck('id'))->count();
              $total_order_amount=Orders::whereIn("branch_id",Branch::where('user_id',auth()->user()->id)->pluck('id'))->sum('final_amount');
              
              $total_stock_purchase=Inventory::where("user_id",auth()->user()->id)->sum('total_cr');
              $total_stock_sellout=Inventory::where("user_id",auth()->user()->id)->sum('total_dr');
              $total_stock_available=Inventory::where("user_id",auth()->user()->id)->sum('total_available');
              
              return view('restaurent/dashboard',compact('total_branch','total_manager','total_chef','total_order','total_order_amount','total_stock_purchase','total_stock_sellout','total_stock_available'));
          }
          else if($is_admin==3){
               
            $total_chef = User::where('user_id',auth()->user()->id)->where('is_admin',4)->count();
            $total_order = Orders::where('branch_id',auth()->user()->branch_id)->count();
            $total_customer = User::where('is_admin',5)->count();
            return view('manager/dashboard',compact('total_chef','total_customer','total_order'));
        }else if($is_admin==4){
          $total_order=  Orders::where(['assign_chef_id'=>auth()->user()->id])->count();
          $total_order_pending=  Orders::where(['assign_chef_id'=>auth()->user()->id,'order_in_process'=>0])->count();
          $total_order_assign=  Orders::where(['assign_chef_id'=>auth()->user()->id,'order_in_process'=>1])->count();
          $total_order_accepted=  Orders::where(['assign_chef_id'=>auth()->user()->id,'order_in_process'=>2])->count();
          $total_order_prepared=  Orders::where(['assign_chef_id'=>auth()->user()->id,'order_in_process'=>3])->count();
          $total_order_pelivered=  Orders::where(['assign_chef_id'=>auth()->user()->id,'order_in_process'=>4])->count();
          return view('chef/dashboard',compact('total_order_pelivered','total_order_prepared','total_order','total_order_pending','total_order_assign','total_order_accepted'));
      }
    }
}
public function restaurentGraphs(){
    if(!is_null(auth()->user())){
        $is_admin  =auth()->user()->is_admin;
        $result=[];
        if($is_admin==1){
             $data=  User::select(
                DB::raw("(COUNT(*)) as count"),
                DB::raw("MONTHNAME(created_at) as monthname")
                )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get();
            $countData ="";
            if(!empty($data)){
                return response()->json(['status'=>true,"data"=>$data]);
            }
            else
            {
                return response()->json(['status'=>false,"data"=>$result]);
            }
        }
    }

}
  public function restaurentGraph(Request $request){
    if($request->all()){
      
        $is_admin  =auth()->user()->is_admin;
        $result=[];
        if($is_admin==1){
            $type =$request->type;//1 for week 2 for month or 3 for year get all previous 6 month/week/year
            if($type ==1)
            {
                $users=   User::select(
                    DB::raw("(COUNT(*)) as y"),
                    DB::raw("MONTHNAME(created_at) as label"))
                    ->where('is_admin',2)
                    ->whereBetween('created_at', 
                        [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                    )  
                    ->groupBy('label')
                    ->orderBy('y','ASc')
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

      if($type ==2)
      {

        $users = User::select(
          DB::raw("(COUNT(*)) as y"),
          DB::raw("MONTHNAME(created_at) as label")
        
        )
        ->where('is_admin',2)
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
        ->where('is_admin',2)
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
  }
  public function restaurentOrderGraph(Request $request){
    if($request->all()){
      
      $is_admin  =auth()->user()->is_admin;
    //  dd($is_admin);
      $result=[];
      if($is_admin==2){
          $type =$request->type;//1 for week 2 for month or 3 for year get all previous 6 month/week/year
          $all_Branch = Branch::where("user_id",auth()->user()->id)->pluck('id');

          if($type ==1)
          {
              $users=   Orders::select(
                  DB::raw("(COUNT(*)) as y"),
                  DB::raw("MONTHNAME(created_at) as label"))
                  ->whereIn("branch_id",$all_Branch)
                  ->whereBetween('created_at', 
                      [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
                  )  
                  ->groupBy('label')
                  ->orderBy('y','ASc')
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

    if($type ==2)
    {

      $users = Orders::select(
        DB::raw("(COUNT(*)) as y"),
        DB::raw("MONTHNAME(created_at) as label")
      
      )
      ->whereIn("branch_id",$all_Branch)
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
      $users = Orders::select(
      DB::raw("(COUNT(*)) as y"),
      DB::raw("YEAR(created_at) as label")
      )
      ->whereIn("branch_id",$all_Branch)
      
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
  }

  public function stockDisplay(){
    if(auth()->user()->is_admin==2)
    {
     return view('restaurent/stock/stockDisplay');
    }
  }
  public function stockDisplayRestaurent(Request $request){
    if ($request->ajax()) {
      $limit = $request->input('length');
      $start = $request->input('start');
     
      $search = $request['search'];
      $search_key = $request['search_key'];
      $orderby = $request['order']['0']['column'];
      $order = $orderby != "" ? $request['order']['0']['dir'] : "";
      $draw = $request['draw'];
      if(auth()->user()->is_admin==2)
      {

        $querydata = Inventory::where('user_id',auth()->user()->id)->with('productDetails')->latest();
      
        if (!is_null($search) && !empty($search)) {
            $querydata->where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
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
          $row['total_cr'] = isset($value->total_cr)? $value->total_cr:'-';
          $row['total_dr'] = isset($value->total_dr)? $value->total_dr:'-';
          $row['qty_opt']= isset($value->qty_opt) ? $value->qty_opt:'-';
          $row['total_available'] = isset($value->total_available)? $value->total_available:'-';
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

  public function data(Request $request){
    if ($request->ajax()) {
        $limit = $request->input('length');
        $start = $request->input('start');

        $search = $request['search'];
        
        $unique_id = $request['unique_id'];

        $orderby = $request['order']['0']['column'];
        $order = $orderby != "" ? $request['order']['0']['dir'] : "";
        $draw = $request['draw'];
  
       $querydata = User::where('user_id',auth()->user()->id)->latest();
       
        if (!is_null($unique_id) && !empty($unique_id)) {
            $querydata->where(function($query) use ($unique_id) {
                $query->orwhere('unique_id',$unique_id);
            });
        }
        if (!is_null($search) && !empty($search)) {
            $querydata->where(function($query) use ($search) {
                $query->orwhere('unique_id',$search);
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
            $row['name'] = $value->name ?? '-';
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