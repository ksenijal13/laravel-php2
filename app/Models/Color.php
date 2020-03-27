<?php


namespace App\Models;


class Color
{
    public function getColors(){
        return \DB::table("colors")->get();
    }

}
