package edu.ucf.cop4331.Collange.imagify;

import edu.ucf.cop4331.Collange.Pixel;
import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;

public class PixelTest {
    private static final int RED_VALUE = 50;
    private static final int GREEN_VALUE = 50;
    private static final int BLUE_VALUE = 50;
    private Pixel pxl;

    @Before
    public void setUp(){
        this.pxl = new Pixel(RED_VALUE, GREEN_VALUE, BLUE_VALUE);
    }

    @Test
    public void testRed(){
        Assert.assertEquals(RED_VALUE, pxl.getRed());

        // Verify we can't go over 255.
        pxl.setRed(300);
        Assert.assertEquals(255, pxl.getRed());
    }

    @Test
    public void testGreen(){
        Assert.assertEquals(GREEN_VALUE, pxl.getGreen());

        // Verify we can't go over 255.
        pxl.setGreen(300);
        Assert.assertEquals(255, pxl.getGreen());
    }

    @Test
    public void testBlue(){
        Assert.assertEquals(BLUE_VALUE, pxl.getBlue());

        // Verify we can't go over 255.
        pxl.setBlue(300);
        Assert.assertEquals(255, pxl.getBlue());
    }
}
