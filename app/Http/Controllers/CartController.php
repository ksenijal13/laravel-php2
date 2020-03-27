<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    private $model;
    private $code;
    private $activity;
    public function __construct()
    {
        $this->model = new Cart();
        $this->activity = new Activity();
    }
    public function getCartData(Request $request){
        $userId = $request->session()->get('user')->user_id;
        $cartData = $this->model->getCartData($userId);
        return response()->json($cartData);
    }
    public function addToCart(Request $request){
        $socksArray = $request->get("socksArray");
        $result = $this->model->addToCart($socksArray);
        if($result){
            $this->code = 201;
            $activity = "\n".session('user')->user_id . " " ."Added product in cart." . " " .$request->getClientIp();
            $this->activity->writeActivityInFile($activity);
            $this->activity->storeActivity(session('user')->user_id, $request->getClientIp(), "added product in cart.");
        }else{
            $this->code = 409;
        }
        return response(null, $this->code);
    }
    public function deleteFromCart($id, Request $request){
        $userId = $request->session()->get('user')->user_id;
        $result = $this->model->deleteFromCart($id, $userId);
        if($result[0]){
            $this->code = 200;
            $activity = "\n".session('user')->user_id . " " ."Deleted product from cart with id ".$id . " " .$request->getClientIp();
            $this->activity->writeActivityInFile($activity);
            $this->activity->storeActivity(session('user')->user_id, $request->getClientIp(), "Deleted product from cart with id: ".$id);
        }else{
            $this->code = 500;
        }
        return response()->json($result[1], $this->code);
    }
    public function updateCart(Request $request){
        $userId = $request->session()->get('user')->user_id;
        $id = $request->get("id");
        $quantity = $request->get("quantity");
        $dataArray = $this->model->updateCart($id, $quantity, $userId);
        if($dataArray[0]){
            $this->code = 200;
            $activity = "\n".session('user')->user_id . " " ."Updated cart data for product with id ".$id . " " .$request->getClientIp();
            $this->activity->writeActivityInFile($activity);
            $this->activity->storeActivity(session('user')->user_id, $request->getClientIp(), "Updated Cart data for product with id: ".$id);
        }else{
            $this->code = 500;
        }
        $data = $dataArray[1];
        //return \response($dataArray[1], $this->code)->header('Content-Type', 'application/json');
        return response()->json($dataArray[1], $this->code);
    }

}
