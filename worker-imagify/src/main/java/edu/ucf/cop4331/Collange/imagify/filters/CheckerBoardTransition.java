package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class CheckerBoardTransition extends RGBTransition {

    private boolean lastPixelShown = false;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            if(!lastPixelShown){
                // Reset the counter at the end of a row of pixels.
                if(pxl.getX() != width-1) {
                    lastPixelShown = true;
                }
            }else{
                pxl.setRed(0);
                pxl.setGreen(0);
                pxl.setBlue(0);
                // Reset the counter at the end of a row of pixels.
                if(pxl.getX() != width-1){
                    lastPixelShown = false;
                }
            }
        }
        return pxl;
    }
}
