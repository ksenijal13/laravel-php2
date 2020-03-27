<?php


namespace App\Models;


class Cart
{
    public function addToCart($socksArray){
        $userId = session('user')->user_id;
        $quantity = 1;
        $result = 0;
        foreach($socksArray as $sockId){
            $isInCart = \DB::table("cart")
                ->where([
                    ["user_id", $userId],
                    ["sock_id", $sockId]
                ])
                ->first();
            if(!$isInCart){
                $result = \DB::table("cart")
                    ->insert([
                        "user_id" => $userId,
                        "sock_id" => $sockId,
                        "quantity" => $quantity
                    ]);
            }
        }
        return $result;

    }
    public function deleteFromCart($id, $userId){
        $result = \DB::table("cart")->where([
            ["id", $id],
            ["user_id", $userId]
        ])->delete();
        $dataArray = [];
        $dataArray[] = $result;
        $dataArray[] = self::getCartData($userId);
        return $dataArray;
    }
    public function getCartData($userId){
        return \DB::table("cart as c")
            ->join("socks_info as si", "c.sock_id", "=", "si.id")
            ->join("socks as s", "s.sock_id", "=", "si.sock_id")
            ->select("*", "c.id as cart_id")
            ->where([
                ["user_id", $userId]
                ])
            ->get();
    }
    public function updateCart($id, $quantity, $userId){
        $result =  \DB::table("cart")
            ->where([
                ["id", $id],
                ["user_id", $userId]
            ])
            ->update([
                "quantity" => $quantity
            ]);
        $dataArray = [];
        $dataArray[] = $result;
        $dataArray[] = self::getCartData($userId);
        return $dataArray;
    }


}
