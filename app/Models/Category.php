<?php


namespace App\Models;


class Category
{
    public function getAllCategories(){
        return \DB::table("categories")->get();
    }
}
