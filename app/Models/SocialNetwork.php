<?php


namespace App\Models;


class SocialNetwork
{
    public function getAllSocialNetworks(){
        return \DB::table("social_networks")->get();
    }
    public function store($name, $icon, $url){
        \DB::table("social_networks")
            ->insert([
                "name" => $name, "icon" => $icon, "url" => $url
            ]);
    }
    public function updateName($name, $id){
        \DB::table("social_networks")
            ->where("id", $id)
            ->update([
               "name" => $name
            ]);
    }
    public function updateIcon($icon, $id){
        \DB::table("social_networks")
            ->where("id", $id)
            ->update([
                "icon" => $icon
            ]);
    }
    public function updateUrl($url, $id){
        \DB::table("social_networks")
            ->where("id", $id)
            ->update([
                "url" => $url
            ]);
    }
    public function delete($id){
        return \DB::table("social_networks")
            ->where("id", $id)
            ->delete();
    }
}
