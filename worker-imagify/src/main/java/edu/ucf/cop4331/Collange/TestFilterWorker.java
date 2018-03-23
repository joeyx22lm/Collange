package edu.ucf.cop4331.Collange;

import edu.ucf.cop4331.Collange.imagify.RGBTransitions;
import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;
import edu.ucf.cop4331.Collange.worker.FilterWorker;

import java.io.IOException;
import java.util.Random;

public class TestFilterWorker extends FilterWorker {
    public static void main(String[] args) {
        System.out.println("TestFilterWorker: Initialized");

        // Initialize Redis Session.
        JedisHandler redisSession = new JedisHandler(System.getenv(FilterWorker.ENV_REDISURL));

        // Run test for 30 seconds.
        int test = 0;
        long start = System.currentTimeMillis();
        while(true){
            long runtime = (System.currentTimeMillis() - start)/1000;
            if(runtime >= 10){
                break;
            }

            int max = new Random().nextInt(5);
            for(int i = 0; i < max; i++){
                try {
                    boolean result = redisSession.enqueue(FilterWorker.WaitingQueueRedisIdentifier,
                            new FilterWorkerMessage(Double.toString(new Random().nextInt()),
                                    "avatar.jpg",
                                    RGBTransitions.getRandomTransition()),
                            FilterWorkerMessage.class);
                    if(result){
                        System.out.println("TestFilterWorker: Enqueued Successfully");
                    }else{
                        System.out.println("TestFilterWorker: Enqueue Failed");
                    }
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
    }
}
