package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class DitheringTransition extends RGBTransition {

    private boolean lastPixelShown = false;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            pxl.setRed((int)(Math.ceil(pxl.getRed() / 255) * 255));
            pxl.setGreen((int)(Math.ceil(pxl.getGreen() / 255) * 255));
            pxl.setBlue((int)(Math.ceil(pxl.getBlue() / 255) * 255));
        }
        return pxl;
    }
}
