package edu.ucf.cop4331.Collange.worker;

import com.fasterxml.jackson.databind.ObjectMapper;
import edu.ucf.cop4331.Collange.service.redis.FilterWorkerQueue;
import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterCompleteMessage;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;
import edu.ucf.cop4331.Collange.service.s3.AwsS3Handler;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.util.UUID;

public class FilterWorker {

    protected static final String ENV_REDISURL = "REDIS_URL";

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
            String msg = jobQueue.dequeue(FilterWorkerQueue.WaitingQueueRedisIdentifier, 1000, 10000);
            if(msg == null){
                System.out.println("FilterWorker.DEBUG: Listener timed out while waiting for messages.");
                continue;
            }
            FilterWorkerMessage message = null;
            try{
                message = new ObjectMapper().readValue(msg, FilterWorkerMessage.class);
            }catch(Exception e){
                System.err.println(e.getMessage());
                if(e.getCause() != null){
                    System.err.println(e.getCause().getMessage());
                }
                continue;
            }

            // Begin processing the message.
            System.out.println(" FilterWorker.INFO: Listener received message\n\tTransaction ID: " + message.transactionId);
            System.out.println("\tkey: " + message.key);
            System.out.println("\ttransformation: " + message.getTransition() + "\n");

            BufferedImage img = AwsS3Handler.getImage(message.key);
            if(img == null){
                System.out.println("Unable to retrieve image: " + message.key);
                // TODO: Mark complete w/ error.
                continue;
            }

            BufferedImage newImg = message.getTransition().getInstance().filter(img);
            if(newImg == null){
                System.out.println("Unable to filter image: " + message.key);
                // TODO: Mark complete w/ error.
                continue;
            }

            FilterCompleteMessage resp = new FilterCompleteMessage(message.transactionId,
                    message.revisionId,
                    message.eventId,
                    "/filtered/"+ UUID.randomUUID()+".jpg");
            // Upload the new revision to S3.
            try {
                AwsS3Handler.putImage(resp.key, newImg);
                System.out.println("Filtered Image: " + message.key);
                // TODO: Mark complete w/ success.
                jobQueue.markJobComplete(resp);
            } catch (IOException e) {
                e.printStackTrace();
                System.out.println("Unable to upload filtered image: " + message.key);
                // TODO: Mark complete w/ error.
                continue;
            }

            // If a second argument is given, run indefinitely.
            if(args == null || args.length <= 1){
                break;
            }
        }
    }
}
