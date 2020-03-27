<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Contact;

class FrontController extends Controller
{
    protected $data = [];
    private $model;

    public function __construct()
    {
        $this->model = new Menu();
        $this->data['menu'] = $this->model->getMenu();

        $this->model = new Contact();
        $this->data['contact'] = $this->model->getContact();

        $this->model = new SocialNetwork();
        $this->data['socialNetworks'] = $this->model->getAllSocialNetworks();
    }
}
