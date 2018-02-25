package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;
import edu.ucf.cop4331.Collange.imagify.RGBUtility;

public class ItalianFlagTransition extends RGBTransition {

    private int whiteLeftEdge = -1;
    private int redLeftEdge = -1;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            if(whiteLeftEdge == -1){
                whiteLeftEdge = (width / 3);
                redLeftEdge = 2*whiteLeftEdge;
            }

            // Check whether to apply green hue.
            if(pxl.getX() < whiteLeftEdge){
                pxl.setRed(0);
                pxl.setBlue(0);
            }

            // Check whether to apply white hue.
            // This is done by applying a 20% opacity value.
            else if(pxl.getX() < redLeftEdge){
                pxl.setRed(RGBUtility.getOpaqueRGB(pxl.getRed(), 0.2));
                pxl.setGreen(RGBUtility.getOpaqueRGB(pxl.getGreen(), 0.2));
                pxl.setBlue(RGBUtility.getOpaqueRGB(pxl.getBlue(), 0.2));
            }

            // Check whether to apply the red hue.
            else {
                pxl.setGreen(0);
                pxl.setBlue(0);
            }
        }
        return pxl;
    }
}