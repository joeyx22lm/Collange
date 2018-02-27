package edu.ucf.cop4331.Collange.imagify;

import java.awt.*;
import java.awt.image.BufferedImage;

public abstract class RGBTransitionBundle {

    protected BufferedImage image;

    public BufferedImage filter(RGBTransition filter, BufferedImage image, int offset_x, int offset_y){
        this.image = image;
        if(image != null){
            int w = image.getWidth();
            int h = image.getHeight();
            for(int y = offset_x; y < h; y++){
                for(int x = offset_y; x < w; x++){
                    Pixel pxl = new Pixel(x, y, image.getRGB(x, y));
                    image.setRGB(x, y, filter.filterPixel(pxl, w, h).getRGB());
                }
            }
        }
        return image;
    }

    public BufferedImage filter(BufferedImage image, RGBTransition[] filters){
        this.image = image;
        // An even number of filters must be given.
        if(image != null && filters != null && filters.length > 0 && filters.length % 2 == 0){
            int width = 0;
            int height = 0;
            // If the number of filters is a perfect square, so too should be the new image.
            if(Math.pow(Math.sqrt(filters.length), 2) == Math.pow((int)Math.sqrt(filters.length), 2)){
                width = (int)Math.sqrt(filters.length);
            }else{
                width = filters.length/2;
            }
            height = width;

            BufferedImage newImage = new BufferedImage(width, height, BufferedImage.TYPE_INT_RGB);

        }
        return image;
    }

}
