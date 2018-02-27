package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class EightBitColorTransition extends RGBTransition {

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            pxl.setRed(pxl.getRed()/(pxl.getGreen()==0?1:pxl.getGreen()) * 255);
            pxl.setGreen(pxl.getGreen()/(pxl.getRed()==0?1:pxl.getRed()) * 255);
            pxl.setBlue(pxl.getBlue());
        }
        return pxl;
    }
}
