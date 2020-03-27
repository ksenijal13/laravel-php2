<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Sock;
use App\Models\Collection;
use App\Models\Color;

class AdminController extends AdminBaseController
{
    private $model;

    public function index(){
        $this->model = new Sock();
        $this->data['socks'] = $this->model->getAllSocks(0);
        $this->data['number_of_links'] = $this->model->countAllSocks()->number / 5;

        $this->model = new Category();
        $this->data['categories'] = $this->model->getAllCategories();

        $this->model = new Collection();
        $this->data['collections'] = $this->model->getAllCollections();

        $this->model = new Color();
        $this->data['colors'] = $this->model->getColors();

        return view("pages.admin", $this->data);
    }
}
