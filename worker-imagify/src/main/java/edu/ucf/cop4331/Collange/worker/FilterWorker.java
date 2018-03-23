package edu.ucf.cop4331.Collange.worker;

import edu.ucf.cop4331.Collange.service.redis.FilterWorkerQueue;
import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;

public class FilterWorker {

    protected static final String ENV_REDISURL = "REDIS_URL";
    protected static final String WaitingQueueRedisIdentifier = "FilterWaitingQueue";
    protected static final String CompletedQueueRedisIdentifier = "FilterCompletedQueue";

    public static void main(String[] args){
        System.out.println("FilterWorker: Initialiing");

        // Initialize Redis Session.
        JedisHandler redisSession = new JedisHandler(System.getenv(ENV_REDISURL));

        // Initialize Filter Worker Queue Handler.
        FilterWorkerQueue jobQueue = new FilterWorkerQueue(redisSession);

        if(!jobQueue.isConnected()){
            System.out.println("FilterWorker.ERROR: Redis Session failed to connect.");
            System.exit(1);
        }else{
            System.out.println("FilterWorker.DEBUG: Redis Session Established.");
        }

        while(true) {
            // Attempt to pop a message off the queue.
            FilterWorkerMessage message = jobQueue.dequeueJob(10, 1000);
            if(message == null){
                System.out.println("FilterWorker.DEBUG: Listener timed out while waiting for messages.");
            }else{
                // Begin processing the message.
                System.out.println("FilterWorker.INFO: Listener received message\n\tTransaction ID: " + message.transactionId);
            }

            // If a second argument is given, run indefinitely.ß
            if(args == null || args.length <= 1){
                break;
            }
        }
    }
}
