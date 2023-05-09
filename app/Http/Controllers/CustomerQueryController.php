<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Contact;
use Auth;
use Mail;
use Helper;
class CustomerQueryController extends Controller
{
    public function index(){
        $users = Contact::where(['user_id'=>auth()->user()->id])->get();;
        return view('manager/customerquery/index',['users'=>$users]);
    }
    public function SendMail(Request $request){
        $contact = Contact::where(["id"=>$request->record_id])->first();
        $contact->reply =$request->reply ;
        $email = $contact->email;
        $subject = $contact->subject;
        $username = $contact->name;
         $data = array('subject'=>$contact->subject,'reply'=>$request->reply,"username"=>$username,"email"=>$email);
         Mail::send('email/demomail', $data, function($message) {
         $message->to($data[0]['email'], "")->subject
            ($subject);
         $message->from(config('setting.MAIL_FROM_ADDRESS'));
         return back()->with('success',"Mail send Successfully");
      });
    }

    public function data(Request $request){
      if ($request->ajax()) {
          $limit = $request->input('length');
          $start = $request->input('start');
  
          $search = $request['search'];
          
         
          $orderby = $request['order']['0']['column'];
          $order = $orderby != "" ? $request['order']['0']['dir'] : "";
          $draw = $request['draw'];
    
         $querydata = Contact::where('user_id',auth()->user()->id)->latest();
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
              $row['name'] = $value->name;
              $row['email'] = $value->email;
              $row['subject'] = $value->subject;
              $row['message'] = $value->message;
               $msg= "<a href='javascript:void(0);'  data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='".$value->subject."' data-bs-id='".$value->id."'class='btn btn-light  radius-0 shadow btn-xs sharp me-1'><i class='bx bx-reply'></i></a>";
              $row['action'] = $msg;
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
