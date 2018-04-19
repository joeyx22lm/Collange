package edu.ucf.cop4331.Collange.service.redis.dto;

import edu.ucf.cop4331.Collange.imagify.RGBTransitions;

public class FilterCompleteMessage {
    public String transactionId;
    public String revisionId;
    public String eventId;
    public String key;

    public FilterCompleteMessage(){}

    public FilterCompleteMessage(String transactionId, String revisionId, String eventId, String key){
        this.transactionId = transactionId;
        this.revisionId = revisionId;
        this.eventId = eventId;
        this.key = key;
    }
}