<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ContactController extends AdminBaseController
{
    private $contactModel;

    public function index(){
        $this->contactModel = new Contact();
        $this->data['contact'] = $this->contactModel->getContact();
        return view('pages.contact-admin', $this->data);
    }
    public function update(ContactRequest $request){
        $this->contactModel = new Contact();
        $id = $request->input("contact-id");
        $phone = $request->input("contact-phone");
        $email = $request->input("contact-email");
        $address = $request->input("contact-address");
        try{
            if($phone != ""){
                $this->contactModel->updatePhone($phone);
            }
            if($email != ""){
                $this->contactModel->updateEmail($email);
            }
            if($address != ""){
                $this->contactModel->updateAddress($address);
            }
            return redirect()->back()->with("message", "You've successfully updated contact.");
        }catch(QueryException $e){
            return redirect()->back()->with("message", "Something went wrong please try later.");
        }

    }
}
