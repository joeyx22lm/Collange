package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class HorizontalSymmetricTransition extends RGBTransition {

    private int leftMidpoint = -1;
    private int rightMidpoint = -1;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            // Check to see whether we have calculated the midpoint yet.
            if(leftMidpoint == -1 && width % 2 == 0){
                leftMidpoint = (int)Math.floor(width/2);
            }
            if(rightMidpoint == -1){
                rightMidpoint = (int)Math.ceil(width/2);
            }

            // Check whether this should be a mirrored pixel.
            if(pxl.getX() > rightMidpoint){
                if(width % 2 == 0){
                    // Since the width is even, there is no definite midpoint.
                    // Hence we treat the midpoint as two pixels.
                    // TODO: We should probably just inject an extra column of pixels
                    // for all of these even-width images?
                    int dM = (2*(pxl.getX()-rightMidpoint))+1;
                    pxl.setRGB(this.image.getRGB(pxl.getX()-dM, pxl.getY()));
                }else{
                    int dM = (2*(pxl.getX()-rightMidpoint));
                    pxl.setRGB(this.image.getRGB(pxl.getX()-dM, pxl.getY()));
                }
            }

            // Check whether to let this pixel shine through.
            else if(pxl.getX() == leftMidpoint || pxl.getX() == rightMidpoint){
                // The midpoint should be a thin strip of black to serve
                // as a buffer between the two mirrored images.
                pxl.setRed(0);
                pxl.setGreen(0);
                pxl.setBlue(0);
            }
        }
        return pxl;
    }
}
