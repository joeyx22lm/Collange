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
        int expectedRed = Math.min((int)(pxl.getRed()*0.25), 255);
        int expectedGreen = Math.min((int)(pxl.getGreen()*0.50), 255);
        int expectedBlue = Math.min((int)(pxl.getBlue()*0.75), 255);

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
                int red = Math.min((int)(0.25 * in.getRed()), 255);
                int green = Math.min((int)(0.50 * in.getGreen()), 255);
                int blue = Math.min((int)(0.75 * in.getBlue()), 255);
                in.setRed(red);
                in.setGreen(green);
                in.setBlue(blue);
                return in;
            }
            return null;
        }
    }
}