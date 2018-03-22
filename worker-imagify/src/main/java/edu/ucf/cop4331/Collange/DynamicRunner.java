package edu.ucf.cop4331.Collange;

import java.lang.reflect.InvocationTargetException;

public class DynamicRunner {
    public static void main(String[] args, boolean exit){
        // Verify that some valid resource was given.
        if(args != null && args.length > 0 && args[0] != null) {
            try {
                Class<?> type = Class.forName(args[0]);
                java.lang.reflect.Method mainMethod = type.getDeclaredMethod("main", String[].class);
                mainMethod.invoke(tail(args));
                if(exit) System.exit(0);
            } catch (java.lang.ClassNotFoundException e) {
                System.out.println("Error: " + args[0] + " is not a valid resource: " + e.getMessage());
            } catch (java.lang.NoSuchMethodException e) {
                System.out.println("Error: " + args[0] + " is not a runnable resource: " + e.getMessage());
            } catch (IllegalAccessException | InvocationTargetException e) {
                System.out.println("An unexpected error occurred while running " + args[0] + ".main(String[]): " + e.getMessage());
                e.printStackTrace();
            }
        }

        // No valid resource was given.
        else{
            System.out.println("Invalid arguments!");
        }

        // Exit with error.
        if(exit) System.exit(-1);
    }

    public static void main(String[] args){
        main(args, true);
    }
    /**
     * Returns the List of arguments, with the first
     * element removed. This is because the first element
     * represents the runnable class name itself.
     * @param String[] args
     * @return
     */
    public static String[] tail(String[] in){
        String[] ret = null;
        if(in != null && in.length > 1){
            ret = new String[in.length-1];
            for(int i = 1; i<in.length;i++){
                ret[i-1] = in[i];
            }
        }
        return (ret == null ? new String[0] : ret);
    }
}
