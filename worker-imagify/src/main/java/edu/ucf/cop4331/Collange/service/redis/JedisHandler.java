package edu.ucf.cop4331.Collange.service.redis;

import com.fasterxml.jackson.databind.ObjectMapper;
import com.google.common.collect.ImmutableMap;
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

    protected static final ObjectMapper om = new ObjectMapper();
    protected Jedis session;

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

    public JedisHandler(Jedis session){
        this.session = session;
    }

    public Jedis getSession(){
        return this.session;
    }

    public boolean isConnected(){
        return this.session != null && this.session.isConnected();
    }

    public static <T> QueueMessage deserializeQueueMessage(String json) {
        if(json != null && !json.isEmpty()){
            try {
                return om.readValue(json, QueueMessage.class);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

    public static <T> String serializeQueueMessage(QueueMessage msg) {
        if(msg != null){
            try {
                return om.writeValueAsString(msg);
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return null;
    }

    public <T> QueueMessage dequeue(String queueName) throws IOException {
        if(this.isConnected()){
            List<String> msg = session.blpop(0,queueName);
            if(msg != null && msg.size() > 1){
                return deserializeQueueMessage(msg.get(1));
            }
        }
        return null;
    }

    public QueueMessage dequeue(String queueName, long timeoutSec, long sleepTime) throws IOException {
        // Sleep time must be larger than timeout time.
        if(sleepTime > timeoutSec) timeoutSec = sleepTime;
        long start = System.currentTimeMillis();
        QueueMessage msg = null;
        while(System.currentTimeMillis() - start < timeoutSec){
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

    public <T> boolean enqueue(String queueName, T value, Class<T> clazz) throws IOException {
        if(this.isConnected()){
            QueueMessage payload = new QueueMessage(value, clazz);
            session.lpush(queueName, om.writeValueAsString(payload));
            return true;
        }
        return false;
    }

    public <T> QueueMessage getMap(String identifier, String key){
        if(this.isConnected()){
            List<String> ret = session.hmget(identifier, key);
            if(ret != null && ret.size() > 0){
                return deserializeQueueMessage(ret.get(0));
            }
        }
        return null;
    }

    public <T> boolean putMap(String identifier, String key, T value, Class<T> type){
        if(this.isConnected()){
            QueueMessage msg = new QueueMessage(value, type);
            session.hmset(identifier,
                    ImmutableMap.of(key, serializeQueueMessage(msg)));
            return true;
        }
        return false;
    }

    public class QueueMessage {
        private Object value;
        private Class<?> clazz;

        public QueueMessage(){}

        public QueueMessage(final Object value, final Class<?> clazz) {
            this.value = value;
            this.clazz = clazz;
        }

        public Object getObject(){
            return value;
        }

        public Class<?> getObjectType(){
            return clazz;
        }
    }
}
