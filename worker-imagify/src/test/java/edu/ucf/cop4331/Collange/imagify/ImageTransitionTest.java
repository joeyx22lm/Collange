package edu.ucf.cop4331.Collange.imagify;

import edu.ucf.cop4331.Collange.Pixel;
import org.junit.Assert;
import org.junit.Test;

public class ImageTransitionTest {
    @Test
    public void testTransformPixel(){
        // Build image filter factory.
        ImageTransition filter = new MockImageTransition();

        // Build the unfiltered pixel.
        Pixel pxl = new Pixel(150, 200, 500);

        // The expected new pixel RBG values.
        int expectedRed = (int)(pxl.getRed()*0.25);
        int expectedGreen = (int)(pxl.getGreen()*0.50);
        int expectedBlue = 255;

        // Apply the filter unto the original pixel.
        filter.transform(pxl);
        Assert.assertEquals(expectedRed, pxl.getRed());
        Assert.assertEquals(expectedGreen, pxl.getGreen());
        Assert.assertEquals(expectedBlue, pxl.getBlue());
    }

    class MockImageTransition extends ImageTransition {
        @Override
        public Pixel transform(Pixel in) {
            if (in != null) {
                // Perform transformations while ensuring
                // that the RGB values don't exceed 255.
                int red = (int)(0.25 * in.getRed());
                int green = (int)(0.50 * in.getGreen());
                int blue = (int)(0.75 * in.getBlue());
                in.setRed(red);
                in.setGreen(green);
                in.setBlue(blue);
                return in;
            }
            return null;
        }
    }
}