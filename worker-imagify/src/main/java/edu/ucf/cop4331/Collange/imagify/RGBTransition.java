package edu.ucf.cop4331.Collange.imagify;

import java.awt.image.*;

public abstract class RGBTransition {

    protected BufferedImage image;

    protected abstract Pixel filterPixel(Pixel pxl, int width, int height);

    public BufferedImage filter(BufferedImage image){
        this.image = image;
        if(image != null){
            int w = image.getWidth();
            int h = image.getHeight();
            for(int y = 0; y < h; y++){
                for(int x = 0; x < w; x++){
                    Pixel pxl = new Pixel(x, y, image.getRGB(x, y));
                    image.setRGB(x, y, filterPixel(pxl, w, h).getRGB());
                }
            }
        }
        return image;
    }
}
