package edu.ucf.cop4331.Collange.service.redis.dto;

import edu.ucf.cop4331.Collange.imagify.RGBTransitions;
import java.io.Serializable;

public class FilterWorkerMessage implements Serializable {
    public String transactionId;
    public String imageId;
    public RGBTransitions transition;

    public FilterWorkerMessage(){}

    public FilterWorkerMessage(String transactionId, String imageId, RGBTransitions transition){
        this.transactionId = transactionId;
        this.imageId = imageId;
        this.transition = transition;
    }
}