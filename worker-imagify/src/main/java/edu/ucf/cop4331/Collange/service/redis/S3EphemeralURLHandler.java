package edu.ucf.cop4331.Collange.service.redis;

public class S3EphemeralURLHandler extends JedisHandler {

    private static final String S3URLMapRedisIdentifier = "S3EphemeralURLMap";

    public S3EphemeralURLHandler(JedisHandler context){
        super(context.getSession());
    }

    public QueueMessage<String> getMap(String key){
        return super.getMap(S3URLMapRedisIdentifier, key, String.class);
    }

    public boolean putMap(String key, String value){
        return super.putMap(S3URLMapRedisIdentifier, key, value, String.class);
    }
}
