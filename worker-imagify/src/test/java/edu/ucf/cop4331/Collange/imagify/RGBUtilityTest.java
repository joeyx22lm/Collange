package edu.ucf.cop4331.Collange.imagify;

import org.junit.Assert;
import org.junit.Test;

public class RGBUtilityTest {
    /**
     * Test some known HEX<->Decimal conversions to ensure
     * our bitwise calculations for Red are correct.
     */
    @Test
    public void testRedGetter(){
        Assert.assertEquals(255, RGBUtility.getRed(0xFFFFFF));
        Assert.assertEquals(170, RGBUtility.getRed(0xAAFFFF));
        Assert.assertEquals(205, RGBUtility.getRed(0xCDFFFF));
    }

    /**
     * Test some known HEX<->Decimal conversions to ensure
     * our bitwise calculations for Green are correct.
     */
    @Test
    public void testGreenGetter(){
        Assert.assertEquals(255, RGBUtility.getGreen(0xFFFFFF));
        Assert.assertEquals(170, RGBUtility.getGreen(0xFFAAFF));
        Assert.assertEquals(205, RGBUtility.getGreen(0xFFCDFF));
    }

    /**
     * Test some known HEX<->Decimal conversions to ensure
     * our bitwise calculations for Blue are correct.
     */
    @Test
    public void testBlueGetter(){
        Assert.assertEquals(255, RGBUtility.getBlue(0xFFFFFF));
        Assert.assertEquals(170, RGBUtility.getBlue(0xFFFFAA));
        Assert.assertEquals(205, RGBUtility.getBlue(0xFFFFCD));
    }

    /**
     * Test some known HEX<->Decimal conversions to ensure
     * our bitwise calculations for RGB are correct.
     */
    @Test
    public void testRGBGetter(){
        Assert.assertEquals(16755405, RGBUtility.getRGB(0xFF, 0xAA, 0xCD));
    }
}