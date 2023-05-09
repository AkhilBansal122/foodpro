<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
//use App\Mail\DemoMail;

class MailController extends Controller
{
    public function index(){
       $data = array('subject'=>"Virat Gandhi",'reply'=>"test","username"=>"test");
          Mail::send('email/demomail', $data, function($message) {
         $message->to('priyanka.hub2@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from(config('setting.MAIL_FROM_ADDRESS'));
      });
    }
}
