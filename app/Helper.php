<?php
    use App\Models\Register;
    use App\Models\User;
use Illuminate\Support\Facades\Auth;

if ( !function_exists('uploadFile'))
    {
        function uploadFile($file, $dir)
        {
            if ($file) {
                
                $destinationPath =  storage_path('app\public'). DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;
                
                
                $media_image = $file->hashName();
                $file->move($destinationPath, $media_image);
   
                return $media_image;
            }
        }
    }
   
?>
