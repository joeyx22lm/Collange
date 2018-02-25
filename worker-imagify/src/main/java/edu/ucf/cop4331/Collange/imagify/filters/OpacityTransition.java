package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;
import edu.ucf.cop4331.Collange.imagify.RGBUtility;

public class OpacityTransition extends RGBTransition {

    protected Pixel filterPixel(Pixel pxl, int width, int height, float opacity){
        if(pxl != null) {
            pxl.setRed(RGBUtility.getOpaqueRGB(pxl.getRed(), opacity));
            pxl.setGreen(RGBUtility.getOpaqueRGB(pxl.getGreen(), opacity));
            pxl.setBlue(RGBUtility.getOpaqueRGB(pxl.getBlue(), opacity));
        }
        return pxl;
    }

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        return filterPixel(pxl, width, height, (float)0.5);
    }
}
