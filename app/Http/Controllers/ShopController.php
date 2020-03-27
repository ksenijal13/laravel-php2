<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Collection;
use App\Models\Sock;

class ShopController extends FrontController
{
    private $model;

    public function index(){
        $this->model = new Color();
        $this->data["colors"] = $this->model->getColors();

        $this->model = new Collection();
        $this->data["collections"] = $this->model->getAllCollections();

        $this->data['sort_array'] = [
            "0" => "sort by",
            "price-asc" => "price, low to high",
            "price-desc" => "price, high to low",
        ];
        $this->model = new Sock();
        $socks = $this->model->getSocks(0)[0];
        foreach ($socks as $sock){
            $sock->smallImages = $this->model->getSmallImages($sock->id_sock);
        }
        $this->data['socks'] = $socks;

        $this->data['numberOfSocks'] = $this->model->countSocks();
        return view('pages.shop', $this->data);
    }
}
