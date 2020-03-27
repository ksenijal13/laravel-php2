<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\CollectionStoreRequest;
use App\Http\Requests\CollectionUpdateRequest;
use App\Services\Upload;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionControler extends AdminBaseController
{
    private $model;
    public function index(){
        $this->model = new Collection();
        $this->data['collections'] = $this->model->getAllCollections();

        return view("pages.collections-admin", $this->data);
    }
   /* public function __construct()
    {
        $this->model = new Collection();
    }*/
    public function getAllCollections(){
        $this->model = new Collection();
        $collections = $this->model->getAllCollections();
        return response()->json($collections);
    }
    public function getSpringSummerCollection(){
        $this->model = new Collection();
        $collection = $this->model->getSpringSummerCollection();
    }
    public function getOneCollection($id){
        $this->model = new Collection();
        $collection = $this->model->getOneCollection($id);
        return response()->json($collection);
    }
    public function insert(CollectionStoreRequest $request){
        $name = $request->input('collection-name-insert');
        $upload = new Upload();
        $this->model = new Collection();
        try{
            $file_name = $_FILES["collection-image-insert"]["name"];
            $tmp_name = $_FILES["collection-image-insert"]["tmp_name"];
            $size = $_FILES["collection-image-insert"]["size"];
            $type = $_FILES["collection-image-insert"]["type"];
            $error = $_FILES["collection-image-insert"]["error"];

            list($width, $height) = getimagesize($tmp_name);

            $img = $upload->imageCreate($type, $tmp_name);
            $image = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 700, $img);
            $this->model->insertCollection($image, $name);
            return redirect()->back()->with("message", "You've successfully added new collection.");
        }catch(QueryException $e) {
            return redirect()->back()->with("message", "Something went wrong please try later.");
        }
    }
    public function update(CollectionUpdateRequest $request){
        $id = $request->input('collection-id');
        $name = $request->input('collection-name');
        $this->model = new Collection();
        try{
            if($name != ""){
                $this->model->updateName($id, $name);
            }
            if(!empty($_FILES['collection-image']['name'])){
                $upload = new Upload();
                $file_name = $_FILES["collection-image"]["name"];
                $tmp_name = $_FILES["collection-image"]["tmp_name"];
                $size = $_FILES["collection-image"]["size"];
                $type = $_FILES["collection-image"]["type"];
                $error = $_FILES["collection-image"]["error"];

                list($width, $height) = getimagesize($tmp_name);

                $img = $upload->imageCreate($type, $tmp_name);
                $image = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 700, $img);
                $this->model->updateImage($id, $image);
            }
            return redirect()->back()->with("message", "You've successfully updated collection.");
        }catch(QueryException $e){
            return redirect()->back()->with("message", "Something went wrong please try later.");
        }
    }
    public function delete($id){
        $this->model = new Collection();
        try{
            $this->model->delete($id);
            $collections = $this->model->getAllCollections();
            return response()->json($collections, 200);
        }catch(QueryException $e){
            return response(null, 500);
        }
    }
}
