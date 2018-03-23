package edu.ucf.cop4331.Collange;

import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;
import edu.ucf.cop4331.Collange.worker.FilterWorker;

import java.io.IOException;

public class TestFilterWorker extends FilterWorker {
    public static void main(String[] args) {
        // Initialize Redis Session.
        JedisHandler redisSession = new JedisHandler(System.getenv(FilterWorker.ENV_REDISURL));
        float max = (Math.random() % 14);
        for(int i = 0; i < max; i++){
            try {
                redisSession.enqueue(FilterWorker.WaitingQueueRedisIdentifier,
                        new FilterWorkerMessage(),
                        FilterWorkerMessage.class);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }
}