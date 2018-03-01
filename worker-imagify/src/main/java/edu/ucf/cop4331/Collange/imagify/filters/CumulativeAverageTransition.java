package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class CumulativeAverageTransition extends RGBTransition {

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null && width != 0 && height != 0) {
            pxl.setRed((pxl.getRed()/(width*height))*255);
            pxl.setGreen((pxl.getGreen()/(width*height))*255);
            pxl.setBlue((pxl.getBlue()/(width*height))*255);
        }
        return pxl;
    }
}
