package edu.ucf.cop4331.Collange;

import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;
import edu.ucf.cop4331.Collange.worker.FilterWorker;

import java.io.IOException;

public class TestFilterWorker extends FilterWorker {
    public static void main(String[] args) {
        System.out.println("TestFilterWorker: Initialized");

        // Initialize Redis Session.
        JedisHandler redisSession = new JedisHandler(System.getenv(FilterWorker.ENV_REDISURL));
        for(int i = 0; i < 10; i++){
            try {
                boolean result = redisSession.enqueue(FilterWorker.WaitingQueueRedisIdentifier,
                        new FilterWorkerMessage(),
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
