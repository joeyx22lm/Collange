package edu.ucf.cop4331.Collange.imagify.filters.color.blend;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class ColorMidpointTransition extends RGBTransition {

    protected int blendRed;
    protected int blendGreen;
    protected int blendBlue;

    public ColorMidpointTransition(int blendRed, int blendGreen, int blendBlue){
        this.blendRed = blendRed;
        this.blendBlue = blendBlue;
        this.blendGreen = blendGreen;
    }

    public ColorMidpointTransition(){
        this(0xFF, 0xFF, 0xFF);
    }

    protected Pixel filterPixel(Pixel pxl, int width, int height, int blendRed, int blendGreen, int blendBlue){
        if(pxl != null) {
            pxl.setRed((pxl.getRed()+blendRed)/2);
            pxl.setGreen((pxl.getGreen()+blendGreen)/2);
            pxl.setBlue((pxl.getBlue()+blendBlue)/2);
        }
        return pxl;
    }

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        return filterPixel(pxl, width, height, blendRed, blendGreen, blendBlue);
    }
}
