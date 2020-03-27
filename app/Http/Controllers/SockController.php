<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSocksRequest;
use Illuminate\Http\Request;
use App\Models\Sock;
use Illuminate\Database\QueryException;
use App\Http\Requests\InsertSocksRequest;
use App\Services\Upload;

class SockController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Sock();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit');
        $searchValue = $request->get('searchValue');
        $colorId = $request->get('colorId');
        $gender = $request->get('gender');
        $collection = $request->get('collection');
        $sortBy = $request->get('sortPrice');
        $socks = $this->model->getSocks($limit, $searchValue, $colorId, $gender, $collection, $sortBy);
        return response()->json($socks);
    }
    public function fetch_data(Request $request){
        if($request->ajax()) {
            $socks = $this->model->getAllSocks();
            return response()->json([$socks]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertSocksRequest $request)
    {
        $name = $request->input("insert-sock-name");
        $coll = $request->input("insert-sock-coll");
        if($coll == "0"){$coll = null;}
        $cat = $request->input("insert-sock-cat");
        $price = $request->input("insert-sock-price");
        $color = $request->input("insert-sock-color");
        $showFirst = 1;
        $file = $request->file("insert-sock-file");
        $upload = new Upload();

        $file_name = $_FILES["insert-sock-file"]["name"];
        $tmp_name = $_FILES["insert-sock-file"]["tmp_name"];
        $size = $_FILES["insert-sock-file"]["size"];
        $type = $_FILES["insert-sock-file"]["type"];
        $error = $_FILES["insert-sock-file"]["error"];

        list($width, $height) = getimagesize($tmp_name);

        $img = $upload->imageCreate($type, $tmp_name);

        $image = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 300, $img);
        $smallImage = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 120, $img);

        $mainSockId = $this->model->insertSock($name, $price);
        $id = $this->model->insertSockInfo($mainSockId, $cat, $coll, $image, $smallImage, $color, $showFirst);
        if(empty($id)){
            return redirect()->back()->with("message", "Something went wrong. Please try later.");
        }
        return redirect()->back()->with("message", "You've successfully added new product.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function getBigImage($id){
        $bigImage = $this->model->getBigImage($id);
        return response()->json(["bigImage" => $bigImage]);
    }
    public function getSmallImages($id){
        $socks = $this->model->getSmallImages($id);
        return response()->json($socks);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocksRequest $request)
    {
        $id = $request->input("sock_id");
        $mother_id = $request->input("mother_id");
        $coll = $request->input("coll-list-update");
        $cat = $request->input("cat-list-update");
        $price = $request->input("sock_price");
        $discount = $request->input("sock_discount");
        $result = 1;
        try {
            if ($coll != "0") {
                $this->model->updateCollection($coll, $id);
            }
            if ($price != "") {
                $this->model->updatePrice($mother_id, $price);
            }
            if ($discount != "") {
                $this->model->updateDiscount($mother_id, $discount);
            }
            if ($cat != "0") {
                $this->model->updateCategory($id, $cat);
            }
            if (!empty($_FILES['file']['name'])) {
                $upload = new Upload();

                $file_name = $_FILES["file"]["name"];
                $tmp_name = $_FILES["file"]["tmp_name"];
                $size = $_FILES["file"]["size"];
                $type = $_FILES["file"]["type"];
                $error = $_FILES["file"]["error"];

                list($width, $height) = getimagesize($tmp_name);

                $img = $upload->imageCreate($type, $tmp_name);

                $image = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 300, $img);
                $smallImage = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 120, $img);
                $this->model->updateImage($id, $image, $smallImage);
            }
            return redirect()->back()->with('message', "You've successfully updated product.");
        }catch(QueryException $e){}
        return redirect()->back()->with("message", "Something went wrong. Please try later.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $limit = $request->get('limit');
        $result = $this->model->deleteSock($id);
        if($result){
            $socks = $this->model->getAllSocks($limit);
            return response()->json($socks, 200);
        }
        return response(null, 500);
    }
    public function getAllSocks($limit){
        $socks = $this->model->getAllSocks($limit);
        return response()->json($socks);
    }
    public function getOneSockAllInfo($id){
        $sock = $this->model->getOneSockAllInfo($id);
        return response()->json($sock);
    }
}
