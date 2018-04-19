package edu.ucf.cop4331.Collange.service.redis.dto;

import edu.ucf.cop4331.Collange.imagify.RGBTransition;
import edu.ucf.cop4331.Collange.imagify.RGBTransitions;
import java.io.Serializable;

public class FilterWorkerMessage implements Serializable {
    public String transactionId;
    public String revisionId;
    public String key;
    public String eventId;
    public String filter;

    public FilterWorkerMessage(){}

    public FilterWorkerMessage(String transactionId, String revisionId, String key, String eventId, String filter){
        this();
        this.transactionId = transactionId;
        this.revisionId = revisionId;
        this.key = key;
        this.eventId = eventId;
        this.filter = filter;
    }

    public RGBTransitions getTransition(){
        return RGBTransitions.valueOf(this.filter);
    }
}