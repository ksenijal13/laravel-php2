<?php


namespace App\Models;


use http\Env\Request;

class Sock
{
    const SOCKS_LIMIT = 12;
    const SOCKS_LIMIT_ADMIN = 5;

    private $data = [];
    private $whereClause = [];
    private $whereIn;
    private $orderBy;
    public function getSocks($offset, $searchValue = 0, $colorId = 0, $gender = 0, $collection = 0, $sortBy = 0){
        $offset = ((int) $offset) * self::SOCKS_LIMIT;
        $this->makeContinueQuery($searchValue, $colorId, $gender, $collection, $sortBy);
        $socks =  $this->getFilteredSocks($offset);
        $numberOfSocks = $this->countSocks()->number / self::SOCKS_LIMIT;

        $this->data[] = $socks;
        $this->data[] = $numberOfSocks;

        return $this->data;
    }
    public function getOneSockAllInfo($id){
        return \DB::table("socks as s")
            ->leftJoin("socks_info as si", "s.sock_id", "=", "si.sock_id")
            ->leftJoin("colors as c", "c.color_id", "=", "si.color_id")
            ->leftJoin("categories as cat", "cat.cat_id", "=", "si.category_id")
            ->leftJoin("collections as coll", "coll.collection_id", "=", "si.collection_id")
            ->select("*", "s.name as sock_name", "id", "si.image as sock_image", "si.sock_id as id_sock", "c.color_id as id_color", "color_name", "cat_id", "cat_name", "coll.collection_id as coll_id", "collection_name", "price", "discount")
            ->where("id", $id)
            ->first();
    }
    public function getAllSocks($offset){
        $offset = ((int) $offset) * self::SOCKS_LIMIT_ADMIN;
        return \DB::table("socks as s")
            ->leftJoin("socks_info as si", "si.sock_id", "=", "s.sock_id")
            ->leftJoin("colors as c", "si.color_id", "=", "c.color_id")
            ->leftJoin("categories as cat", "cat.cat_id", "=", "si.category_id")
            ->leftJoin("collections as coll", "coll.collection_id", "=", "si.collection_id")
            ->select("*", "s.name as sock_name", "id", "si.image as sock_image", "si.sock_id as id_sock", "c.color_id as id_color, color_name, cat_id, cat_name, coll.collection_id as coll_id, collection_name, price, discount")
            ->whereNotNull("si.sock_id")
            ->limit(self::SOCKS_LIMIT_ADMIN)
            ->offset($offset)
            ->get();
    }
    public function countAllSocks(){
        return \DB::table("socks_info as si")
            ->join('socks as s', 's.sock_id', '=', 'si.sock_id')
            ->select(\DB::raw('COUNT(*) as number'))
            ->first();
    }
    public function makeContinueQuery($searchValue, $colorId, $gender, $collection, $sortBy){
            $this->whereClause[] = ['show_first', true];
            if($searchValue){
                $this->whereClause[] = ['s.name', 'LIKE', '%'.$searchValue.'%'];
           }
            if($colorId){
                $this->whereClause[] = ['color_id', $colorId];
            }
           if($gender){
                if($gender == 'woman'){
                    $this->whereIn = [2, 3];
                }else {
                    $this->whereIn = [1, 3];
                }
            }else{
                $this->whereIn = [1, 2, 3];
            }
            if($collection){
                $this->whereClause[] = ['collection_id', $collection];
            }
            if($sortBy){
                if($sortBy == "price-desc"){
                    $this->orderBy = "desc";
                }else{
                    $this->orderBy = "asc";
                }
            }else{

            }
    }
    public function getFilteredSocks($offset){
       $query =  \DB::table("socks as s")
            ->join("socks_info as si", "s.sock_id", "=", "si.sock_id")
           ->whereIn('category_id', $this->whereIn)
            ->where(
                $this->whereClause
            )
            ->select("show_first", "id", "s.name as sock_name", "si.image as big_image", "small_image", "si.sock_id as id_sock",
                \DB::raw('if(discount > 0, (price - (discount / 100 * price)), price) as  pricep'), "price", "discount");
           if($this->orderBy == "desc" || $this->orderBy == "asc"){
               return $query->orderBy('pricep', $this->orderBy)
                   ->limit(self::SOCKS_LIMIT)
                   ->offset($offset)
                   ->get();
           }
           return $query
            ->limit(self::SOCKS_LIMIT)
            ->offset($offset)
            ->get();
    }
    public function countSocks(){
        return \DB::table("socks_info as si")
                ->join('socks as s', 's.sock_id', '=', 'si.sock_id')
                ->select(\DB::raw('COUNT(*) as number'))
                ->whereIn('category_id', $this->whereIn)
                ->where(
                    $this->whereClause
                )->first();
    }
    public function getSmallImages($id){
        return \DB::table("socks_info")
            ->where("sock_id", $id)
            ->get();
    }
   /* public function countAllSocks(){
        return \DB::table("socks_info")
            ->whereRaw("show_first is true")
            ->select(\DB::raw('COUNT(*) as number'))
            ->first();

    }*/
    public function getBigImage($id){
        return \DB::table("socks_info")
            ->where("id", $id)
            ->select("image")
            ->first();
    }
    public function deleteSock($id){
        $result = \DB::table('socks_info')
            ->where('id', $id)
            ->delete();
        if($result){
           \DB::table('cart')
                ->where('sock_id', $id)
                ->delete();
        }
        return $result;
    }
    public function insertSock($name, $price){
        return \DB::table('socks')->insertGetId(
            ['name' => $name, 'price' => $price]
        );
    }
    public function insertSockInfo($sockId, $categoryId, $collectionId, $image, $smallImage, $colorId, $showFirst){
        return \DB::table("socks_info")
            ->insertGetId(
                ["sock_id" => $sockId, "category_id" => $categoryId, "collection_id" => $collectionId, "image" => $image, "small_image" => $smallImage, "color_id" => $colorId, "show_first" => $showFirst]
            );
    }
    public function updateCollection($collectionId, $id){
        return \DB::table("socks_info")
            ->where([
                ["id", $id]
            ])
            ->update([
                "collection_id" => $collectionId
            ]);
    }
    public function updatePrice($id, $price){
        return \DB::table("socks")
            ->where([
                ["sock_id", $id]
            ])
            ->update([
                "price" => $price
            ]);
    }
    public function updateDiscount($id, $discount){
        return \DB::table("socks")
            ->where([
                ["sock_id", $id]
            ])
            ->update([
                "discount" => $discount
            ]);
    }
    public function updateCategory($id, $categoryId){
        return \DB::table("socks_info")
            ->where([
                ["id", $id]
            ])
            ->update([
                "category_id" => $categoryId
            ]);
    }
    public function updateImage($id, $image, $smallImage){
        return \DB::table("socks_info")
            ->where([
                ["id", $id]
            ])
            ->update([
                "image" => $image,
                "small_image" => $smallImage
            ]);
    }

}
