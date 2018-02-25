package edu.ucf.cop4331.Collange.imagify;

import org.junit.Assert;
import org.junit.Test;

public class RGBTransitionsTest {
    @Test
    public void testGetInstance(){
        for(RGBTransitions filterHelper : RGBTransitions.values()){
            Assert.assertNotNull(filterHelper);
            Assert.assertNotNull(filterHelper.getInstance());
            Pixel pxl = new Pixel(0, 0, 0);
            Assert.assertEquals(pxl, filterHelper.getInstance().filterPixel(pxl, 0, 0));
        }
    }
}
