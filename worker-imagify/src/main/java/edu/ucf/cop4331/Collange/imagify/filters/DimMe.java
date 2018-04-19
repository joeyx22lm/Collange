package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;

public class DimMe extends RGBTransition {


    private int lessRed = 0;
    private int lessGreen = 0;
    private int lessBlue = 0;

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height){
        if(pxl != null) {
            
                
          
            	double red = pxl.getRed();
            	double green = pxl.getGreen();
            	double blue = pxl.getBlue();
            	if (red < 182) // Originally wanted pixels to 40% brigther? but eh with this restriction and dimming looks intersting
            		{
            		red = red * 0.2;
            		lessRed = (int)red;
            		pxl.setRed(lessRed);
            		}
            	if (green < 182)
        		{
            		green = green * 0.2;
            		lessGreen = (int)green;
            		pxl.setGreen(lessGreen);
        		}
            	if (blue < 182)
        		{
            		blue = blue * 0.2;
            		lessBlue = (int)blue;
        			pxl.setBlue(lessBlue);
        		}
               
                
            
        }
        return pxl;
    }
}
