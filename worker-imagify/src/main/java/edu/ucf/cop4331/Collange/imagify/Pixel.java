package edu.ucf.cop4331.Collange.imagify;

import java.util.Objects;

public class Pixel {
    private int x;
    private int y;
    private int red;
    private int green;
    private int blue;

    public Pixel(int x, int y, int red, int green, int blue){
        this.x = x;
        this.y = y;
        this.red = red;
        this.green = green;
        this.blue = blue;
    }

    public Pixel(int x, int y, int rgb){
        this(x, y, RGBUtility.getRed(rgb), RGBUtility.getGreen(rgb), RGBUtility.getBlue(rgb));
    }

    public int getRed() {
        return red;
    }

    public void setRed(int red) {
        this.red = minimum(red, 255);
    }

    public int getGreen() {
        return green;
    }

    public void setGreen(int green) {
        this.green = minimum(green, 255);
    }

    public int getBlue() {
        return blue;
    }

    public void setBlue(int blue) {
        this.blue = minimum(blue, 255);
    }

    public int getRGB(){
        return RGBUtility.getRGB(this.red, this.green, this.blue);
    }

    public void setRGB(int rgb){
        this.red = RGBUtility.getRed(rgb);
        this.green = RGBUtility.getGreen(rgb);
        this.blue = RGBUtility.getBlue(rgb);
    }
    public int getX(){
        return x;
    }

    public int getY(){
        return y;
    }

    @Override
    public int hashCode(){
        return Objects.hash(this.red, this.green, this.blue);
    }

    @Override
    public boolean equals(Object o){
        if(this == o) return true;
        if(o == null) return false;
        if(!(o instanceof Pixel)){
            return false;
        }
        Pixel obj = (Pixel)o;
        if(!Objects.equals(this.red, obj.red)){
            return false;
        }
        if(!Objects.equals(this.green, obj.green)){
            return false;
        }
        if(!Objects.equals(this.blue, obj.blue)){
            return false;
        }
        return true;
    }

    public static int minimum(int x, int y){
        return (x > y ? y : x);
    }
}
