package edu.ucf.cop4331.Collange.imagify.filters.color;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class WhiteTransition extends RGBTransition {
    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            pxl.setRed(255);
            pxl.setGreen(255);
            pxl.setBlue(255);
        }
        return pxl;
    }
}
