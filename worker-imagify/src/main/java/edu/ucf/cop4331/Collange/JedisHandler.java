package edu.ucf.cop4331.Collange;

import redis.clients.jedis.Jedis;
import redis.clients.jedis.JedisPool;
import redis.clients.jedis.JedisPoolConfig;
import redis.clients.jedis.Protocol;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;

/**
 * Redis Session Handler
 */
public class JedisHandler {

    private Jedis session;

    public JedisHandler(String connectURL){
        if(connectURL != null) {
            try {
                URI redisURI = new URI(connectURL);
                JedisPool pool = new JedisPool(new JedisPoolConfig(),
                        redisURI.getHost(),
                        redisURI.getPort(),
                        Protocol.DEFAULT_TIMEOUT,
                        redisURI.getUserInfo().split(":", 2)[1]);
                this.session = pool.getResource();
            } catch (URISyntaxException e) {
                e.printStackTrace();
                System.out.println("ERROR - JedisHandler: Unable to connect to redis: " + e.getMessage());
            }
        }
    }

    public boolean isConnected(){
        return this.session != null && this.session.isConnected();
    }

    public QueueMessage dequeue(String queueName){
        if(session != null){
            List<String> msg = session.blpop(0,queueName);
            if(msg != null && msg.size() > 1){
                return new QueueMessage(msg.get(0), msg.get(1));
            }
        }
        return null;
    }

    public QueueMessage dequeue(String queueName, long timeoutMs, long sleepTime){
        // Sleep time must be larger than timeout time.
        if(sleepTime > timeoutMs) timeoutMs = sleepTime;
        long start = System.currentTimeMillis();
        QueueMessage msg = null;
        while(System.currentTimeMillis() - start < timeoutMs){
            msg = dequeue(queueName);
            if(msg != null){
                break;
            } else {
                try {
                    Thread.sleep(sleepTime);
                }catch(Exception e){
                    System.out.println("ERROR - JedisHandler: Unable to sleep? " + e.getMessage());
                }
            }
        }
        return msg;
    }

    class QueueMessage {
        private String key;
        private String value;

        public QueueMessage(final String key, final String value){
            this.key = key;
            this.value = value;
        }

        public String getKey(){
            return key;
        }

        public String getValue(){
            return value;
        }
    }
}
