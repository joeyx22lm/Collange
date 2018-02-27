package edu.ucf.cop4331.Collange.imagify.filters;

import edu.ucf.cop4331.Collange.imagify.Pixel;
import edu.ucf.cop4331.Collange.imagify.RGBTransition;
import edu.ucf.cop4331.Collange.imagify.RGBUtility;

import java.awt.image.BufferedImage;

public class ConwayGameOfLifeTransition extends RGBTransition {

    @Override
    protected Pixel filterPixel(Pixel pxl, int width, int height) {
        if (pxl != null) {
            // Check for underpopulation restriction.
            int liveNeighborCount = 9;
            // Check horizontal neighbors.
            if (pxl.getX() - 1 >= 0 && RGBUtility.getBrightness(image.getRGB(pxl.getX() - 1, pxl.getY())) < 70) {
                liveNeighborCount--;
            }
            if (pxl.getX() + 1 < width && RGBUtility.getBrightness(image.getRGB(pxl.getX() + 1, pxl.getY())) < 70) {
                liveNeighborCount--;
            }

            // Check vertical neighbors.
            if (pxl.getY() - 1 >= 0 && RGBUtility.getBrightness(image.getRGB(pxl.getX(), pxl.getY() - 1)) < 70) {
                liveNeighborCount--;
            }
            if (pxl.getY() + 1 < height && RGBUtility.getBrightness(image.getRGB(pxl.getX(), pxl.getY() + 1)) < 70) {
                liveNeighborCount--;
            }

            // Check diagonally adjacent neighbors. Top left.
            if (pxl.getX() - 1 >= 0 && pxl.getY() - 1 >= 0 && RGBUtility.getBrightness(image.getRGB(pxl.getX() - 1, pxl.getY() - 1)) < 70) {
                liveNeighborCount--;
            }
            // Check diagonally adjacent neighbors. Bottom Right.
            if (pxl.getX() + 1 < width && pxl.getY() + 1 < height && RGBUtility.getBrightness(image.getRGB(pxl.getX() + 1, pxl.getY() + 1)) < 70) {
                liveNeighborCount--;
            }
            // Check diagonally adjacent neighbors. Top Right.
            if (pxl.getX() + 1 < width && pxl.getY() - 1 >= 0 && RGBUtility.getBrightness(image.getRGB(pxl.getX() + 1, pxl.getY() - 1)) < 70) {
                liveNeighborCount--;
            }
            // Check diagonally adjacent neighbors. Bottom Left.
            if (pxl.getX() - 1 >= 0 && pxl.getY() + 1 < height && RGBUtility.getBrightness(image.getRGB(pxl.getX() - 1, pxl.getY() + 1)) < 70) {
                liveNeighborCount--;
            }

            // Die of underpopulation. Die of overpopulation.
            //if (liveNeighborCount < 2 || liveNeighborCount > 3) {
            if (liveNeighborCount < 1 || liveNeighborCount > 5) {       // Slightly adjusted rules to make it look better visually.
                pxl.setRed(0);
                pxl.setGreen(0);
                pxl.setBlue(0);
            }
        }
        return pxl;
    }

    /* Run it multiple times?
    @Override
    public BufferedImage filter(BufferedImage image) {
        for(int i = 0;i<3;i++){
            image = super.filter(image);
        }
        return image;
    }
    */
}
