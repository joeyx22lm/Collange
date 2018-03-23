package edu.ucf.cop4331.Collange.service.s3;

import com.amazonaws.AmazonServiceException;
import com.amazonaws.auth.AWSStaticCredentialsProvider;
import com.amazonaws.auth.BasicAWSCredentials;
import com.amazonaws.services.s3.AmazonS3;
import com.amazonaws.services.s3.AmazonS3ClientBuilder;
import com.amazonaws.services.s3.model.GetObjectRequest;
import com.amazonaws.services.s3.model.S3Object;
import com.amazonaws.services.s3.model.S3ObjectInputStream;
import com.amazonaws.util.IOUtils;
import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.*;

public class AwsS3Handler {
    private static AmazonS3 session;
    private static String getBucket(){
        return System.getenv("AWS_S3_BUCKET");
    }
    private static String getAccessKey(){
        return System.getenv("AWS_KEY");
    }
    private static String getAccessSecret(){
        return System.getenv("AWS_SECRET");
    }
    protected static final AmazonS3 getSession(){
        if(session == null){
            BasicAWSCredentials creds = new BasicAWSCredentials(
                    getAccessKey(),
                    getAccessSecret()
            );
            session = AmazonS3ClientBuilder.standard()
                .withCredentials(new AWSStaticCredentialsProvider(creds))
                .withRegion("us-east-1")
                .build();
        }
        return session;
    }

    public static S3Object getFile(String key){
        S3Object ret = null;
        if(key != null) {
            GetObjectRequest rangeObjectRequest = new GetObjectRequest(
                    System.getenv("AWS_S3_BUCKET"), key);
            try {
                ret = getSession().getObject(rangeObjectRequest);
            }catch(Exception e){
                e.printStackTrace();
            }

            if (ret == null) {
                System.out.println("AwsS3Handler.getFile(" + key + "): null");
            } else {
                System.out.println("AwsS3Handler.getFile(" + key + "): "
                        + ret.getObjectMetadata().getContentLength() + "B ("
                        + ret.getObjectMetadata().getContentType() + ")");
            }
        }
        return ret;
    }

    public static BufferedImage getImage(String key) {
        S3Object obj = getFile(key);
        if(obj != null){
            try {
                return ImageIO.read(obj.getObjectContent());
            } catch (IOException e) {
                System.out.println("AwsS3Handler.getImage(" + key + "): Unable to read Image");
                e.printStackTrace();
            }
        }
        return null;
    }
}
