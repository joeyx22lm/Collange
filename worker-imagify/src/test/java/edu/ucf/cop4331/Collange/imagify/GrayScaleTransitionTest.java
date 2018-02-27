package edu.ucf.cop4331.Collange.imagify;

import edu.ucf.cop4331.Collange.imagify.filters.GrayScaleTransition;
import org.junit.Assert;
import org.junit.Test;

public class GrayScaleTransitionTest {
    @Test
    public void runTest(){
        Pixel pxl = new Pixel(0, 0, 150, 150, 150);
        GrayScaleTransition filter = new GrayScaleTransition();

        Pixel filteredPxl = filter.filterPixel(pxl, 0, 0);
        Assert.assertEquals(pxl.getBlue(), filteredPxl.getBlue());
        Assert.assertEquals(pxl.getRed(), filteredPxl.getRed());
        Assert.assertEquals(pxl.getGreen(), filteredPxl.getGreen());
    }

    @Test
    public void runTestTwo(){
        Pixel pxl = new Pixel(0, 0, 50, 100, 150);
        GrayScaleTransition filter = new GrayScaleTransition();

        Pixel filteredPxl = filter.filterPixel(pxl, 0, 0);
        Assert.assertEquals(100, filteredPxl.getBlue());
        Assert.assertEquals(100, filteredPxl.getRed());
        Assert.assertEquals(100, filteredPxl.getGreen());
    }

    @Test
    public void runBigTest(){
        int width = 1000;
        int height = 1000;
        // Build an image of size (width x height).
        Pixel[][] image = new Pixel[width][height];
        long count = 0;
        for(int x = 0; x < width; x++){
            for(int y = 0; y < height; y++){
                // We don't want to artificially inflate our
                // time calculations, hence we use constant
                // RGB values. No need to waste time calculating
                // random values, etc.
                image[x][y] = new Pixel(0, 0, 50, 100, 150);
                count++;
            }
        }

        // Build a filter that applies a random but knowns
        // transformation unto a pixel.
        GrayScaleTransition filter = new GrayScaleTransition();

        long startMs = System.currentTimeMillis();
        for(int x = 0; x < width; x++){
            for(int y = 0; y < height; y++){
                filter.filterPixel(image[x][y], width, height);
            }
        }
        long endMs = (System.currentTimeMillis() - startMs);
        System.out.println("RGBTransitionTest.testMockImageRGBTransition("+width+", "+height+"): "+count+" Pixels were filtered in " + endMs + " ms.");
    }
}

