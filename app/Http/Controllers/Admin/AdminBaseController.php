<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Menu;

class AdminBaseController extends Controller
{
    private $model;
    private $activity;
    protected $data = [];
    public function __construct()
    {
        $this->model = new Menu();
        $this->data["menu"] = $this->model->getMenu();

        $this->activity = new Activity();
        $this->data['newActivities'] = $this->activity->countNewActivities()->number;
    }


}
