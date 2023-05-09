<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tables;
use File;
use DataTables;
use Str;
use Helper;

class TablesController extends Controller
{
    public function index(){
        $user = auth()->user();
        $page = "tables";
        if(!is_null($user)){
            $query =Tables::where('id','!=',0);
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
                return view('admin/tables/index',compact('page','data'));
            }else if($user->is_admin==3){
                return view('manager/tables/index',compact('page','data'));
            }
        }
        else{
            return redirect('login');
        }
    }
   
    public function create(){
        $user = auth()->user();
        if(!is_null($user)){
            if($user->is_admin==1){
                return view('admin/tables/create');
            }else if($user->is_admin==3){
                return view('manager/tables/create');
            }
        }
        else{
            return redirect('login');
        }
    }
   

    public function store(Request $request){
   
        $user = auth()->user();
        if(!is_null($user)){

           $manager_code = $user->unique_id;
           $rest_code = User::where("id",$user->user_id)->first()->unique_id;
            $getlastData = Tables::where('user_id',$user->id)->latest()->first();
            $notble =0;
            if(!empty($request->all())){
                $no_of_table = $user->no_of_table;
                if(  $user->no_of_table!=0) {
                    $no_of_table+$request->no_of_table;
                }
                else
                {
                    $no_of_table = $request->no_of_table;   
                }
                $notble= $no_of_table;
                if($getlastData==null){
                    $lastunique_id= "TBL-00".$user->user_id.$user->id;
                    $helperfunction1_res = Helper::QrcodeGenerate(0,$lastunique_id,$user->user_id,$user->id,$manager_code,$rest_code,$request->no_of_table);
                }else{
                    $lastunique_id= "TBL-00".$user->user_id.$user->id.$getlastData->id;
                    $helperfunction1_res = Helper::QrcodeGenerate($getlastData->id,$lastunique_id,$user->user_id,$user->id,$manager_code,$rest_code,$request->no_of_table);
                }
                
                    User::where("id",$user->id)->update(array("no_of_table"=>($user->no_of_table+ $request->no_of_table)));
                    return redirect('manager/table')->with('success',"Table added Successfully");
                
            }
            else{
                return redirect('login');
            }
        }
    }
    public function edit(){

    }
    public function show(){

    }
    public function update(){
        
    }
    public function status_change(){

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
      
           $querydata = Tables::where('user_id',auth()->user()->id)->latest();
           
           

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
                $row['qrcode'] = '<img src="'.asset('public/'.$value->qrcode).'" border="0" class="" width="35" align="center" />';
                $edit = Helper::editAction(url('/manager/tables/edit/'),encrypt($value->id));
                $view = Helper::viewAction(url('/manager/tables/show/'),encrypt($value->id));
                $row['action'] = Helper::action($edit." ".$view);
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
