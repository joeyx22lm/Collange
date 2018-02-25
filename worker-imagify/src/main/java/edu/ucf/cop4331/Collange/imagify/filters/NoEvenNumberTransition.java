package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class NoEvenNumberTransition extends RGBTransition {

    private boolean lastPixelShown = false;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            if(pxl.getY() % 2 == 0 && pxl.getX() % 2 == 0){
                pxl.setRed(0);
                pxl.setGreen(0);
                pxl.setBlue(0);
            }
        }
        return pxl;
    }
}
