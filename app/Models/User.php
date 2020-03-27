<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class User
{
    public function getUsers(){
        return \DB::table('users')
            ->where("role_id", 2)
            ->paginate(5);
    }
    public function login($username, $password){
        return \DB::table("users")
            ->select("*")
            ->where([
                ['username', $username],
                ['password', md5($password)]
            ])->first();
    }
    public function register($firstName, $lastName, $username, $password, $email, $role_id){
           return \DB::table("users")
                ->insert([
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "username" => $username,
                    "password" => md5($password),
                    "email" => $email,
                    "role_id" => $role_id,
                ]);

    }
    public function getAdmins(){
        return \DB::table('users')
            ->where("role_id", 1)
            ->paginate(5);
    }
    public function deleteUser($id){
        \DB::table('users')
            ->where("user_id", $id)
            ->delete();
    }
    public function deleteUserFromCart($userId){
        \DB::table("cart")->where([
            ["user_id", $userId]
        ])->delete();
    }


}
