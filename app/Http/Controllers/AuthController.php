<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    private $model;
    private $activity;
    public function __construct()
    {
        $this->model = new User();
        $this->activity = new Activity();
    }

    public function login(LoginRequest $request){
        $username = $request->input("username_login");
        $password = $request->input("password_login");
        $user = $this->model->login($username, $password);
        if($user){
            $request->session()->put("user", $user);
            $activity = "\n".session('user')->user_id . " " ."login" . " " .$request->getClientIp();
            $this->activity->writeActivityInFile($activity);
            $this->activity->storeActivity(session('user')->user_id, $request->getClientIp(), "logged in.");
            if(session('user')->role_id == 2){
                return redirect("/");
            }else{
                return redirect("/admin");
            }
        }else{
            return redirect()->back()->with("error", "You are not registered.");
        }
    }
    public function register(RegisterRequest $request){
        $firstName = $request->input("first_name");
        $lastName = $request->input("last_name");
        $username = $request->input("username_signup");
        $password = $request->input("password_signup");
        $email = $request->input("user_email");
        $roleId = $request->input("role_id");
        try{
            $result = $this->model->register($firstName, $lastName, $username, $password, $email, $roleId);
            if($result){
                $activity = "\n had just registered with username: ".$username. " " .$request->getClientIp();
                $this->activity->writeActivityInFile($activity);
                if($roleId == 1){
                    return redirect()->back()->with("message", "You've successfully added new admin.");
                }
                return redirect()->back()->with("success", "You've successfully registered. Log in now..");
            }
        }catch(QueryException $e){
            if($roleId){
                return redirect()->back()->with("message", "User with these information already exists. Username and email must be unique.");
            }
            return redirect()->back()->with("error", "User with these information already exists. Username and email must be unique.");
        }
    }
    public function logout(Request $request){
        $activity = "\n".session('user')->user_id . " " ."logout" . " " .$request->getClientIp();
        $this->activity->writeActivityInFile($activity);
        $this->activity->storeActivity(session('user')->user_id, $request->getClientIp(), "logged out.");
        $request->session()->forget("user");
        $request->session()->flush();
        return redirect("/");
    }
    public function checkUser(){
        if(session()->has('user')){
            return response()->json(1);
        }
    }
}
