package edu.ucf.cop4331.Collange.imagify;

import org.junit.Assert;
import org.junit.Test;

public class RGBTransitionTest {
/*
    @Test
    public void testRGBTransition(){
        // Generate the original image.
        int RED = 5, GREEN = 10, BLUE = 20;
        Pixel original = new Pixel(0, 0, RED, GREEN, BLUE);

        // Build a filter that applies a random but known
        // transformation unto a pixel.
        MockRGBTransition filter = new MockRGBTransition((int)(Math.random()%200));

        // Transform the original image.
        Pixel filtered = new Pixel(0, 0, filter.filterPixel(original));

        int randomOffset = filter.getRandomSeed();
        Assert.assertNotNull(filtered);
        Assert.assertEquals(RED, filtered.getRed()-randomOffset);
        Assert.assertEquals(GREEN, filtered.getGreen()-randomOffset);
        Assert.assertEquals(BLUE, filtered.getBlue()-randomOffset);
    }

    /**
     * Test to see how long it takes to process a
     * large image of pixels (1000x1000).
     * @param width
     * @param height
     *
    private void testMockImageRGBTransition(int width, int height){
        // Build an image of size (width x height).
        Pixel[][] image = new Pixel[width][height];
        long count = 0;
        for(int x = 0; x < width; x++){
            for(int y = 0; y < height; y++){
                // We don't want to artificially inflate our
                // time calculations, hence we use constant
                // RGB values. No need to waste time calculating
                // random values, etc.
                image[x][y] = new Pixel(0, 0, 10, 10, 10);
                count++;
            }
        }

        // Build a filter that applies a random but known
        // transformation unto a pixel.
        MockRGBTransition filter = new MockRGBTransition((int)(Math.random()%200));

        long startMs = System.currentTimeMillis();
        for(int x = 0; x < width; x++){
            for(int y = 0; y < height; y++){
                filter.filterPixel(image[x][y]);
            }
        }
        long endMs = (System.currentTimeMillis() - startMs);
        System.out.println("RGBTransitionTest.testMockImageRGBTransition("+width+", "+height+"): "+count+" Pixels were filtered in " + endMs + " ms.");
    }

    @Test
    public void testSmallImageRGBTransition(){
        testMockImageRGBTransition(50, 50);
    }

    @Test
    public void testMediumImageRGBTransition(){
        testMockImageRGBTransition(350, 350);
    }

    @Test
    public void testLargeImageRGBTransition(){
        testMockImageRGBTransition(1000, 1000);
    }

    @Test
    public void test25MPImageRGBTransition(){
        testMockImageRGBTransition(5000, 5000);
    }

    /**
     * Mock RGB Transition that modifies a pixel's
     * RGB value by some known value that is
     * generally randomly generated.
     *
    public class MockRGBTransition extends RGBTransition {
        private int randomSeed;

        public MockRGBTransition(int randomSeed){
            this.randomSeed = randomSeed;
        }

        public int getRandomSeed(){
            return randomSeed;
        }

        @Override
        protected int filterPixel(Pixel pxl){
            pxl.setRed(pxl.getRed()+this.randomSeed);
            pxl.setGreen(pxl.getGreen()+this.randomSeed);
            pxl.setGreen(pxl.getGreen()+this.randomSeed);
            return pxl.getRGB();
        }
    }*/
}
