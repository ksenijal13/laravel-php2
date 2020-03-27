<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends AdminBaseController
{
    private $model;
    public function index(){
        $this->model = new Activity();
        $this->data['activities'] = $this->model->getAllActivities(0);
        $this->data['activitiesNumber'] = $this->model->countActivities()->number;
        $this->model->updateActivity();
        $this->data['newActivities'] = $this->model->countNewActivities()->number;
        return view("pages.activity-admin", $this->data);
    }
    public function getActivities(Request $request){
        $this->model = new Activity();
        $limit = $request->get('limit');
        $sortActivity = $request->get('sortActivity');
        if(!$sortActivity){
            $activities = $this->model->getAllActivities($limit);
        }else{
            $activities = $this->model->sortActivities($limit, $sortActivity);
        }
        return response()->json($activities);
    }
}
