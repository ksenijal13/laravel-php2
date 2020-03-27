<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Category;

class HomeController extends FrontController
{
    private $model;
    public function index()
    {
        $this->model = new Collection();
        $collection_id = 2;
        $this->data['springSummerCollection'] = $this->model->getOneCollection($collection_id);

        $collection_id = 1;
        $this->data['valentinesCollection'] = $this->model->getOneCollection($collection_id);

        $this->model = new Category();
        $this->data['categories'] = $this->model->getAllCategories();

        return view("pages.home", $this->data);
    }
}
