<?php
class ImageHandler {
    public static function convertImageToJPG($src, $ext, $quality=75){
        $output = '/tmp/'.UUID::randomUUID().'.jpg';
        if (preg_match('/jpg|jpeg/i',$ext))
            // don't convert if we don't need to.
            return $src;
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($src);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($src);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($src);
        else
            return null;
        imagejpeg($imageTmp, $output, $quality);
        imagedestroy($imageTmp);
        unlink($src);
        return $output;
    }
    public static function stripEXIFFromJPEG($src){
        try {
            $img = new Imagick($src);
            $img->stripImage();
            $img->writeImage($src);
            $img->clear();
            $img->destroy();
            return $src;
        } catch(Exception $e) {
            Log::error('stripEXIFFromJPEG('.$src.'): ' . $e->getMessage());
        }
        return null;
    }
}
?>