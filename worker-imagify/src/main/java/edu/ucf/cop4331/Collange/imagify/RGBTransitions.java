package edu.ucf.cop4331.Collange.imagify;

import edu.ucf.cop4331.Collange.imagify.filters.*;
import edu.ucf.cop4331.Collange.imagify.filters.color.WhiteTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.RedTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.GreenTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.BlueTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.blend.ColorMidpointTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.blend.ZombieRedTransition;
import edu.ucf.cop4331.Collange.imagify.filters.color.blend.GoldTransition;

public enum RGBTransitions {
    SepiaTransition("Sepia Filter", SepiaTransition.class),
    GrayScaleTransition("Grayscale Filter", GrayScaleTransition.class),

    WhiteTransition("White Filter", WhiteTransition.class),
    RedTransition("Red Filter", RedTransition.class),
    GreenTransition("Green Filter", GreenTransition.class),
    BlueTransition("Blue Filter", BlueTransition.class),

    EmptyTransition("Empty Filter", EmptyTransition.class),
    OpacityTransition("Opacity Filter", OpacityTransition.class),
    StripedTransition("Striped Filter", StripedTransition.class),
    CheckerBoardTransition("CheckerBoard Filter", CheckerBoardTransition.class),
    HorizontalSymmetricTransition("Horizontal Mirror Filter", HorizontalSymmetricTransition.class),
    ItalianFlagTransition("Italian Flag Filter", ItalianFlagTransition.class),
    FrenchFlagTransition("French Flag Filter", FrenchFlagTransition.class),

    ColorMidpointTransition("Color Blend Filter", ColorMidpointTransition.class),
    ZombieRedTransition("Zombie Color Filter", ZombieRedTransition.class),

    GoldTransition("Gold Color Filter", GoldTransition.class),

    DitheringTransition("Dithering Filter", DitheringTransition.class),
    NoEvenNumberTransition("No Even Numbered Pixels Filter", NoEvenNumberTransition.class),
    ConwayGameOfLifeTransition("Conway Game of Life Filter", ConwayGameOfLifeTransition.class),
    EightBitColorTransition("EightBitColorTransition", EightBitColorTransition.class);

    private String name;
    private Class<? extends RGBTransition> clazz;

    RGBTransitions(String name, Class<? extends RGBTransition> clazz){
        this.name = name;
        this.clazz = clazz;
    }

    public String getName(){
        return name;
    }
    public String getCanonicalName(){
        return(this.name == null ? null : this.name.replaceAll("\\s",""));
    }

    public RGBTransition getInstance(){
        if(this.clazz != null){
            try {
                return this.clazz.newInstance();
            } catch (InstantiationException e) {
                e.printStackTrace();
            } catch (IllegalAccessException e) {
                e.printStackTrace();
            }
        }
        return null;
    }
}
