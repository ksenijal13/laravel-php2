<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertSocialNetworksRequest;
use App\Models\SocialNetwork;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SocialNetworkController extends AdminBaseController
{
    private $model;

    public function index(){
        $this->model = new SocialNetwork();
        $this->data['socialNetworks'] = $this->model->getAllSocialNetworks();

        return view("pages.social-networks", $this->data);
    }
    public function store(InsertSocialNetworksRequest $request){
        $this->model = new SocialNetwork();
        $name = $request->input('soc-network-name-insert');
        $icon = $request->input('soc-network-icon-insert');
        $url = $request->input('soc-network-url-insert');
        try{
            $this->model->store($name, $icon, $url);
            return redirect()->back()->with('message', "You've successfully added new social network.");
        }catch(QueryException $e){
            return redirect()->back()->with('message', "Something went wrong. Please try later.");
        }

    }
    public function update(Request $request){
        $request->validate([
            'url' => 'url',
        ]);
        $this->model = new SocialNetwork();
        $id = $request->post('id');
        $name = $request->post('name');
        $icon = $request->post('icon');
        $url = $request->post('url');
        try{
            if($name != ""){
                $this->model->updateName($name, $id);
            }
            if($icon != ""){
                $this->model->updateIcon($icon, $id);
            }
            if($url != ""){
                $this->model->updateUrl($url, $id);
            }
            $updatedData = $this->model->getAllSocialNetworks();
            return response()->json($updatedData, 200);
        }catch(QueryException $e){
            return response(null, 500);
        }
    }
    public function delete($id){
        $this->model = new SocialNetwork();
        try{
            $this->model->delete($id);
            $data = $this->model->getAllSocialNetworks();
            return response()->json($data, 200);
        }catch(QueryException $e){
            return response(null, 500);
        }
    }
}
