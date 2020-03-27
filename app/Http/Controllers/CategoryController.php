<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $model;
    public function getAllCategories(Request $request){
        $this->model = new Category();
        $categories = $this->model->getAllCategories();
        if($request->ajax()){
            return response()->json($categories);
        }
    }
}
