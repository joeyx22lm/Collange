package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class GrayScaleTransition extends RGBTransition {
    @Override
    public Pixel filterPixel(Pixel pxl, int width, int height){
        int gray = ((pxl.getRed() + pxl.getGreen() + pxl.getBlue()) / 3);
        pxl.setRed(gray);
        pxl.setGreen(gray);
        pxl.setBlue(gray);
        return pxl;
    }
}


