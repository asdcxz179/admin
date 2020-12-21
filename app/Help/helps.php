<?php
	use Illuminate\Support\Facades\Storage;

	function createImage($base64,$name){
        if (preg_match('/^data:image\/(.*);base64,/', $base64, $type)) {
            $uploadimage = substr($base64, strpos($base64, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
            switch ($type) {
            	case 'x-icon':
            		$type = 'ico';
            		break;
            }
            $file 	=	$name.'.'.$type;
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ,'ico'])) {
                throw new Exception(trans('error.FileNotAllow'));
            }
            $uploadimage = base64_decode($uploadimage);
            if ($uploadimage === false) {
                throw new Exception(trans('error.ImageFormatError'));
            }
            if(!Storage::disk('public')->put($file, $uploadimage)){
            	throw new Exception(trans('error.ImageUploadFail'));
            }
        }
        return '/storage/'.$file;
    }