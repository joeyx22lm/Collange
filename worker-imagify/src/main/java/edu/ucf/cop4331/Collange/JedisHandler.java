package edu.ucf.cop4331.Collange;

import com.fasterxml.jackson.databind.ObjectMapper;
import redis.clients.jedis.Jedis;
import redis.clients.jedis.JedisPool;
import redis.clients.jedis.JedisPoolConfig;
import redis.clients.jedis.Protocol;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.List;

/**
 * Redis Session Handler
 */
public class JedisHandler {

    private static final ObjectMapper om = new ObjectMapper();
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

    public <T> QueueMessage<T> dequeue(String queueName) throws IOException {
        if(session != null){
            List<String> msg = session.blpop(0,queueName);
            if(msg != null && msg.size() > 1){
                QueueMessage<T> payload = om.readValue(msg.get(1), QueueMessage.class);
                if(payload != null && payload.getKey() == null){
                    payload.setKey(msg.get(0));
                }
                return payload;
            }
        }
        return null;
    }

    public <T> boolean enqueue(String queueName, T value, Class<T> clazz) throws IOException {
        if(session != null){
            QueueMessage<T> payload = new QueueMessage<>(null, value, clazz);
            session.lpush(queueName, om.writeValueAsString(payload));
            return true;
        }
        return false;
    }

    public QueueMessage dequeue(String queueName, long timeoutMs, long sleepTime) throws IOException {
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

    class QueueMessage<T> {
        private String key;
        private T value;
        private Class<T> clazz;

        public QueueMessage(final String key, final T value, final Class<T> clazz) {
            this.key = key;
            this.value = value;
            this.clazz = clazz;
        }

        public void setKey(String key){
            this.key = key;
        }

        public String getKey(){
            return key;
        }

        public T getObject(){
            return value;
        }

        public Class<T> getObjectType(){
            return clazz;
        }
    }
}
