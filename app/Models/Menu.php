<?php


namespace App\Models;


class Menu
{
    public function getMenu(){
        return \DB::table("menu")->orderBy("link_order", "asc")->get();
    }
}
