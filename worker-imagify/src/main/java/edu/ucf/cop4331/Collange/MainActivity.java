package edu.ucf.cop4331.Collange;

import edu.ucf.cop4331.Collange.worker.FilterWorker;

public class MainActivity {
    public static void main(String[] args) {
        System.out.println("MainActivity: Initialiing");

        // Verify some runtime instructions were given.
        if(args == null || args.length == 0){
            System.out.println("Not enough arguments");
            System.exit(-1);
        }

        // Check whether to initialize the Filter Worker.
        if("FilterWorker".equalsIgnoreCase(args[0])){
            FilterWorker.main(args);
        }

        // Check whether to initialize the Filter Worker.
        else if("TestFilterWorker".equalsIgnoreCase(args[0])){
            TestFilterWorker.main(args);
        }

        // Check whether unknown arguments were given.
        else {
            System.out.println("Unrecognized arguments: "  + args[0]);
            System.exit(-1);
        }
    }
}
