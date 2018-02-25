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
    public static int getBrightness(int red, int green, int blue){
        int r = (red/255);
        int g = (green/255);
        int b = (blue/255);
        return (int)Math.ceil((((Math.max(r, Math.max(g, b)) + Math.min(r, Math.min(g, b))) / 2) * 100));
    }
    public static int getBrightness(int rgb){
        return getBrightness(getRed(rgb), getGreen(rgb), getBlue(rgb));
    }
}