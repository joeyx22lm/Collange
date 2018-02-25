package edu.ucf.cop4331.Collange.imagify;

public class RGBUtility {
    private static final int BITMASK_RED = 0xFF0000;
    private static final int BITMASK_GREEN = 0xFF00;
    private static final int BITMASK_BLUE = 0xFF;
    public static int getRed(int rgb){
        return (rgb & BITMASK_RED) >> 16;
    }
    public static int getGreen(int rgb){
        return (rgb & BITMASK_GREEN) >> 8;
    }
    public static int getBlue(int rgb){
        return (rgb & BITMASK_BLUE);
    }
    public static int getRGB(int r, int g, int b){
        return (r << 16) + (g << 8) + b;
    }
    public static int getOpaqueRGB(int rgb, double opacity){
        return (int)(((rgb-255)*opacity)+255);
    }
}