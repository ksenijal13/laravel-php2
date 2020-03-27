<?php


namespace App\Services;


class Upload
{
    public function upload($file_name, $tmp_name, $size, $type, $error, $width, $height, $new_width, $img){

        $file_name = time()."_".$file_name;
        $proc_change = $width / $new_width ;
        $new_height = $height * $proc_change;

        $empty_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($empty_image, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        $new_image = $empty_image;
        $path_new_image = public_path('assets/img/').$file_name;

        switch($type){
            case 'image/jpeg':
                imagejpeg($new_image, $path_new_image, 75);
                break;
            case 'image/png':
                imagepng($new_image, $path_new_image);
                break;
        }

        $path_original_image = public_path('assets/img/').$file_name;
        move_uploaded_file($tmp_name, $path_original_image);
            return $file_name;
    }
    public function imageCreate($type, $tmp_name){
        $img = null;
        if( $type == "image/gif" ) {
            $img = imagecreatefromgif($tmp_name);
        }
        if($type == "image/png"){
            $img = imagecreatefrompng($tmp_name);
        }
        if($type == "image/jpeg" || $type == "image/jpg"){
            $img = imagecreatefromjpeg($tmp_name);
        }
        return $img;
    }

}
