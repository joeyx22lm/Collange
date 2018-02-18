package edu.ucf.cop4331.Collange;

import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;

public class MainActivityTest {
    private MainActivity process;

    @Before
    public void setUp(){
        this.process = new MainActivity();
    }

    @Test
    public void testIfActivityLoadNullArguments(){
        try {
            process.main(null);
        } catch (Exception e){
            Assert.fail(e.getMessage());
        }
    }

    @Test
    public void testIfActivityLoadEmptyArguments(){
        try {
            process.main(new String[]{});
        } catch (Exception e){
            Assert.fail(e.getMessage());
        }
    }
}
