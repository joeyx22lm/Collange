package edu.ucf.cop4331.Collange.worker;

import com.amazonaws.services.s3.model.S3Object;
import com.fasterxml.jackson.databind.ObjectMapper;
import edu.ucf.cop4331.Collange.imagify.RGBTransitions;
import edu.ucf.cop4331.Collange.service.redis.FilterWorkerQueue;
import edu.ucf.cop4331.Collange.service.redis.JedisHandler;
import edu.ucf.cop4331.Collange.service.redis.dto.FilterWorkerMessage;
import edu.ucf.cop4331.Collange.service.s3.AwsS3Handler;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.nio.Buffer;
import java.util.UUID;

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
            }

            // Begin processing the message.
            System.out.println(" FilterWorker.INFO: Listener received message\n\tTransaction ID: " + message.transactionId);
            System.out.println("\timageId: " + message.imageId);
            System.out.println("\ttransformation: " + message.transition + "\n");

            BufferedImage img = AwsS3Handler.getImage(message.imageId);
            if(img == null){
                System.out.println("Unable to retrieve image: " + message.imageId);
                // TODO: Mark complete w/ error.
                continue;
            }

            BufferedImage newImg = message.transition.getInstance().filter(img);
            if(newImg == null){
                System.out.println("Unable to filter image: " + message.imageId);
                // TODO: Mark complete w/ error.
                continue;
            }

            // Upload the new revision to S3.
            try {
                AwsS3Handler.putImage("/filtered/"+ UUID.randomUUID()+".jpg", newImg);
                System.out.println("Filtered Image: " + message.imageId);
                // TODO: Mark complete w/ success.
            } catch (IOException e) {
                e.printStackTrace();
                System.out.println("Unable to upload filtered image: " + message.imageId);
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
