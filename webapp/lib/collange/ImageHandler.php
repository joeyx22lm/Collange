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

    /**
     * @author xtempore at stackoverflow
     * @param $src
     */
    public static function stripEXIFFromJPEG($src){
        $new = '/tmp/'.UUID::randomUUID() . '.jpg';
        $f1 = fopen($src, 'rb');
        $f2 = fopen($new, 'wb');

        // Find EXIF marker
        while (($s = fread($f1, 2))) {
            $word = unpack('ni', $s)['i'];
            if ($word == 0xFFE1) {
                // Read length (includes the word used for the length)
                $s = fread($f1, 2);
                $len = unpack('ni', $s)['i'];
                // Skip the EXIF info
                fread($f1, $len - 2);
                break;
            } else {
                fwrite($f2, $s, 2);
            }
        }

        // Write the rest of the file
        while (($s = fread($f1, 4096))) {
            fwrite($f2, $s, strlen($s));
        }

        fclose($f1);
        fclose($f2);
        unlink($src);
        return $new;
    }
}
?>