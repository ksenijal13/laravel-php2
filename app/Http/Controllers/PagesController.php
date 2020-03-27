<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Contact;

class PagesController extends FrontController
{
    private $model;

    public function about(){
        $this->model = new About();
        $this->data['about'] = $this->model->about();
        return view('pages.about-me', $this->data);
    }
    public function contact(){
        return view('pages.contact', $this->data);
    }
}
