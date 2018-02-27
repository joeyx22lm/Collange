package edu.ucf.cop4331.Collange.imagify;

import edu.ucf.cop4331.Collange.FileSystemHandler;
import org.junit.Assert;
import org.junit.Test;
import javax.imageio.ImageIO;
import java.awt.image.*;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class PackagedImageExamples {

    private static final String[] packagedExamples = {
        "bliss-240x320.jpg",
        "bliss-1920x1200.jpg",
        "bliss-3840x2400.jpg",
        "370z.jpg",
        "avatar.jpg"
    };

    @Test
    public void applyFiltersOnExamples(){
        for(String example : packagedExamples){
            try {
                // List to keep track of performance metrics.
                List<Long> runtimes = new ArrayList<Long>();

                // Load one of the packaged example images.
                File originalFile = FileSystemHandler.getResource(example);
                String originalFileName = originalFile.getName();
                String originalFileExt = (originalFileName == null ? "" : originalFileName.substring(originalFileName.lastIndexOf(".") + 1));

                // Iterate over all known filters.
                for(RGBTransitions filter : RGBTransitions.values()){
                    // Calculate the name for the new file that will be created.
                    String filteredImageName = originalFile.getAbsolutePath().replace("."+originalFileExt, "") + "_" + filter.getCanonicalName() + "." + originalFileExt;

                    // Reload the image so we have a fresh slate.
                    BufferedImage original = ImageIO.read(originalFile);

                    // Log the current time so we can track performance metrics.
                    long startTime = System.currentTimeMillis();
                    original = filter.getInstance().filter(original);
                    long runTime = (System.currentTimeMillis() - startTime);
                    runtimes.add(runTime);
                    System.out.println("\tapplyFiltersOnExamples("+example+"): " + filter.getName() + " - " + runTime + "ms");

                    // Write this filtered image back to disk.
                    ImageIO.write(original, "jpg", new File(filteredImageName));
                }

                if(runtimes.size() > 0){
                    long maxTimeCurrentImage = 0;
                    long minTimeCurrentImage = 0;
                    long totalTime = 0;
                    for(Long time : runtimes){
                        if(time > maxTimeCurrentImage){
                            maxTimeCurrentImage = time;
                        }
                        if(minTimeCurrentImage == 0 || minTimeCurrentImage > time){
                            minTimeCurrentImage = time;
                        }
                        totalTime += time;
                    }
                    System.out.println("applyFiltersOnExamples("+example+") - Best: " + minTimeCurrentImage +
                            "ms  Worst: " + maxTimeCurrentImage + "ms  Avg: " +
                            (totalTime/runtimes.size())+"ms\n");
                }
            } catch (IOException e) {
                e.printStackTrace();
                Assert.fail(e.getMessage());
            }
        }
    }
}
