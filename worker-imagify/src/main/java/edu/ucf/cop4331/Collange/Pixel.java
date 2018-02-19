package edu.ucf.cop4331.Collange;

import java.util.Objects;

public class Pixel {
    private int red;
    private int green;
    private int blue;

    public Pixel(int red, int green, int blue){
        this.red = red;
        this.green = green;
        this.blue = blue;
    }

    public int minimum(int x, int y){
        return (x > y ? y : x);
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
}
