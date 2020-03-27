<?php


namespace App\Models;


class Collection
{
    public function getOneCollection($collection_id){
        return \DB::table("collections")->where("collection_id", $collection_id)->first();
    }
    public function getAllCollections(){
        return \DB::table("collections")->get();
    }
    public function insertCollection($image, $name){
        \DB::table("collections")
            ->insert([
                "collection_name" => $name,
                "image" => $image
            ]);
    }
    public function updateName($id, $name){
        \DB::table("collections")
            ->where("collection_id", $id)
            ->update([
                "collection_name" => $name
            ]);
    }
    public function updateImage($id, $image){
        \DB::table("collections")
            ->where("collection_id", $id)
            ->update([
                "image" => $image
            ]);
    }
    public function delete($id){
        \DB::table("socks_info")
            ->where("collection_id", $id)
            ->update([
                "collection_id" => null
            ]);
        \DB::table("collections")
            ->where("collection_id", $id)
            ->delete();

    }
}
