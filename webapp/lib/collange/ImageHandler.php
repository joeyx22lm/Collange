<?php
class ImageHandler {
    public static function convertImageToJPG($originalImage, $ext, $quality=75){
        $output = '/tmp/'.UUID::randomUUID().'.jpg';
        if (preg_match('/jpg|jpeg/i',$ext))
            // don't convert if we don't need to.
            return $originalImage;
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        else
            return null;
        imagejpeg($imageTmp, $output, $quality);
        imagedestroy($imageTmp);
        unlink($originalImage);
        return $output;
    }
}
?>