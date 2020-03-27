<?php


namespace App\Models;


class Contact
{
    public function getContact(){
        return \DB::table("contact")->first();
    }
    public function updatePhone($phone){
        \DB::table("contact")
            ->update([
               "phone" => $phone
            ]);
    }
    public function updateEmail($email){
        \DB::table("contact")
            ->update([
                "email" => $email
            ]);
    }
    public function updateAddress($address){
        \DB::table("contact")
            ->update([
                "address" => $address
            ]);
    }

}
