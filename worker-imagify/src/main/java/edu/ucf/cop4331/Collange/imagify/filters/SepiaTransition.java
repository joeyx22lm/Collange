package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class SepiaTransition extends RGBTransition {
    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        int red = (int)(
            0.393*pxl.getRed()+
            0.769*pxl.getGreen()+
            0.189*pxl.getBlue()
        );
        int green = (int)(
            0.349*pxl.getRed()+
            0.686*pxl.getGreen()+
            0.168*pxl.getBlue()
        );
        int blue = (int)(
            0.272*pxl.getRed()+
            0.534*pxl.getGreen()+
            0.131*pxl.getBlue()
        );
        pxl.setRed(red);
        pxl.setGreen(green);
        pxl.setBlue(blue);
        return pxl;
    }
}


