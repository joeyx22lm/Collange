package edu.ucf.cop4331.Collange;

public class HerokuWorkerActivity {

    private static final String ENV_VAR_REDIS = "REDIS_URL";

    public static void main(String[] args){
        // Initialize Redis Session.
        JedisHandler redisSession = new JedisHandler(System.getenv(ENV_VAR_REDIS));
        if(redisSession.isConnected()){
            System.out.println("HerokuWorkerActivity: Redis Session Established.");
        }else{
            System.out.println("HerokuWorkerActivity: Redis Session failed to connect.");
        }

        // Pop a message off the queue.
        JedisHandler.QueueMessage msg = redisSession.dequeue("queue", 10000, 1000);
        if(msg == null){
            System.out.println("HerokuWorkerActivity: Listener timed out while waiting for messages.");
        }

        // Begin processing the message.
        System.out.println("HerokuWorkerActivity: Listener received message\n\tKey: " + msg.getKey() + "\n\tValue: " + msg.getValue());
    }
}
