package edu.ucf.cop4331.Collange.service.redis.dto;

import edu.ucf.cop4331.Collange.imagify.RGBTransitions;

public class FilterWorkerMessage {
    public String transactionId;
    public String imageId;
    public RGBTransitions transition;

    public FilterWorkerMessage(){}
}