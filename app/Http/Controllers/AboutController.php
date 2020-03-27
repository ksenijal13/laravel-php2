<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Services\Upload;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AboutController extends AdminBaseController
{
    private $about;
    public function index(){
        $about = new About();
        $this->data['about'] = $about->about();

        return view('pages.about-me-admin', $this->data);
    }
    public function update(AboutRequest $request){
        $about = new About();
        $biography = $request->input('about-biography');
        try{
            if($biography != ""){
                $about->updateBiography($biography);
            }
            if (!empty($_FILES['about-image']['name'])) {
                $upload = new Upload();
                $file_name = $_FILES["about-image"]["name"];
                $tmp_name = $_FILES["about-image"]["tmp_name"];
                $size = $_FILES["about-image"]["size"];
                $type = $_FILES["about-image"]["type"];
                $error = $_FILES["about-image"]["error"];

                list($width, $height) = getimagesize($tmp_name);

                $img = $upload->imageCreate($type, $tmp_name);

                $image = $upload->upload($file_name, $tmp_name, $size, $type, $error, $width, $height, 400, $img);
                $about->updateImage($image);

            }
            return redirect()->back()->with("message", "You've successfully updated About Me Info.");
        }catch(QueryException $e){
            return redirect()->back()->with("message", "Something went wrong. Please try later.");
        }
    }
}
