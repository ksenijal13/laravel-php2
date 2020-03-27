<?php


namespace App\Models;


class About
{
    public function about(){
        return \DB::table("about_me")->first();
    }
    public function updateImage($image){
        \DB::table("about_me")
            ->update([
               "image" => $image
            ]);
    }
    public function updateBiography($biography){
        \DB::table("about_me")
            ->update([
                "biography" => $biography
            ]);
    }
}
