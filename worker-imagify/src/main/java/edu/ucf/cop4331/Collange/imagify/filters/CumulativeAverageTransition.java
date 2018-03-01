package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class CumulativeAverageTransition extends RGBTransition {

    private long total = 0;
    private long count = 0;

    private long getAverage(){
        return(count == 0 ? 1 : (total/count));
    }

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            pxl.setRed((pxl.getRed()/(width*height))*255);
            pxl.setGreen((pxl.getGreen()/(width*height))*255);
            pxl.setBlue((pxl.getBlue()/(width*height))*255);
        }
        return pxl;
    }
}
