<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Str;
use DataTables;
use Helper;
class ContentController extends Controller
{
    public function index()
    {
        $data = Content::latest()->get();
        if(!empty($data))
        {
            foreach($data  as $value)
            {
                $value->description  = decrypt($value->description);
            }
        }
       
        return view('restaurent/content/index',compact('data'));
    }
    
    public function edit($id)
    {
       $data= Content::where("id",decrypt($id))->first();
       if(!empty($data))
       {
        $data->description  = decrypt($data->description);

       }
       return view('restaurent/content/edit',compact('data'));
    }

    public function update(Request $request){
       
        $content = Content::findOrFail($request->id);
        $content->user_id = $user = auth()->user()->id;
        $content->title =  isset($request->title)  ? $request->title : $content->title;
        $content->description =  isset($request->description)  ? encrypt($request->description)  : $content->description;
        $content->slug= isset($request->title) ?  Str::Slug($request->title) : $content->slug; 

        
        if($content->save()){
            return redirect('restaurent/content')->with("msg","Content Updated Successfully");
        }
        else{
            return redirect('restaurent/content')->with("msg","Content Updated Failed");
        }
    }

    public function view($id)
    {
       $data= Content::where("id",decrypt($id))->first();
       if(!empty($data))
       {
        $data->description  = decrypt($data->description);
       }
       return view('restaurent/content/view',compact('data'));
    }
    
    public function data(Request $request){
        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
           
            $search = $request['search'];
            $orderby = $request['order']['0']['column'];
            $order = $orderby != "" ? $request['order']['0']['dir'] : "";
            $draw = $request['draw'];
     
            $querydata = Content::where('user_id',auth()->user()->id)->latest();
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
                $row['slug'] = isset($value->slug)? $value->slug:'-';
               
                $edit = Helper::editAction(url('/restaurent/content/edit/'),encrypt($value->id));
                $view = Helper::viewAction(url('/restaurent/content/view/'),encrypt($value->id));
                
                $sel = "<select class='form-control statusAction' data-path=".route('restaurent.content.status_change')."  data-value=".$value->status." data-id = ".$value->id."  >";
                $sel .= "<option value='Active' " . ((isset($value->status) && $value->status == 'Active') ? 'Selected' : '') . ">Active</option>";
                $sel .= "<option value='Inactive' " . ((isset($value->status) && $value->status == 'Inactive') ? 'Selected' : '') . ">Inactive</option>";
                $sel .= "</select>";

            $row['status'] =$sel;
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

    public function status_change(Request $request){
        //   dd($request->all());
           $change     =   $this->changeStatus('Content',$request);
           if($change){
   
               return ['status'=>1,'type'=>'success','message'=>"Status Change Successfully"];
           }else{
               return ['status'=>0,'type'=>'danger','message'=>"Status Change Failed"];
           }
    }

    
}
