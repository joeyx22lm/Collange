package edu.ucf.cop4331.Collange;

import org.junit.Assert;
import org.junit.Test;

public class DynamicRunnerTest {

    private static boolean hasRun = false;

    private static int argCount = 0;

    @Test
    public void verifyResourceRuns(){
        try {
            // Build arguments and invoke main.
            String[] args = new String[]{ "DynamicRunnerTest", "", "" };
            DynamicRunner.main(args);

            // Assert that main was properly invoked.
            Assert.assertTrue(DynamicRunnerTest.hasRun);
            Assert.assertEquals(3, DynamicRunnerTest.argCount);
        } catch (Exception e){
            Assert.fail("An unexpected error occurred: " + e.getMessage());
        }
    }

    public static void main(String args[]){
        hasRun = true;
        if(args != null){
            argCount = args.length;
        }
    }
}
