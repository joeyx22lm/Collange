package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class EmptyTransition extends RGBTransition {
    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        return pxl;
    }
}
