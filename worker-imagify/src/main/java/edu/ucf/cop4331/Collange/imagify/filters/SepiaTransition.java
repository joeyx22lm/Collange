package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.Pixel;
import edu.ucf.cop4331.Collange.imagify.ImageTransition;

/**
 * Sepia Transition:
 * tr = 0.393R + 0.769G + 0.189B
 * tg = 0.349R + 0.686G + 0.168B
 * tb = 0.272R + 0.534G + 0.131B
 */
public class SepiaTransition extends ImageTransition {
    @Override
    public Pixel transform(Pixel in){
        if(in != null){
            // Calculate color transformations.
            int red = (int)(
                0.393*in.getRed()+
                0.769*in.getGreen()+
                0.189*in.getBlue()
            );
            int green = (int)(
                0.349*in.getRed()+
                0.686*in.getGreen()+
                0.168*in.getBlue()
            );
            int blue = (int)(
                0.272*in.getRed()+
                0.534*in.getGreen()+
                0.131*in.getBlue()
            );

            // Apply color transformations.
            in.setRed(red);
            in.setGreen(green);
            in.setBlue(blue);
            return in;
        }
        return null;
    }
}
