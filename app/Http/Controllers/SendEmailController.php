<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    public function index(){

    }
    public function send(Request $request){
        $this->validate($request, [
            'contact-name' => 'required',
            'contact-email' => 'required|email',
            'contact-message' => 'required'
        ]);

        $data = array(
            'name' => $request->input('contact-name'),
            'message' => $request->input('contact-message'),
            'email' => $request->input('contact-email')
        );

        Mail::to('ksenijalazic13@gmail.com')->send(new SendMail($data));

        return redirect()->back()->with("message", "Thanks for contacting us.");
    }

}
