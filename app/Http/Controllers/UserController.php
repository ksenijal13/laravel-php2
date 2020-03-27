<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends AdminBaseController
{
    private $model;
    public function index(){
        $this->model = new User();
        $this->data['users'] = $this->model->getUsers();
        $this->data['admins'] = $this->model->getAdmins();
        return view('pages.users', $this->data);
    }
    public function deleteUser($id){
        $this->model = new User();
        try{
            $this->model->deleteUserFromCart($id);
            $this->model->deleteUser($id);
            $users = $this->model->getUsers();
            return response()->json($users, 200);
        }catch(QueryException $e){
            return response(null, 500);
        }


    }
}
