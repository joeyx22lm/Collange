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
        GetObjectRequest rangeObjectRequest = new GetObjectRequest(
                System.getenv("AWS_S3_BUCKET"), key);
        rangeObjectRequest.setRange(0, 10);
        S3Object obj = getSession().getObject(rangeObjectRequest);
        if(obj == null){
            System.out.println("AwsS3Handler.getFile("+key+"): null");
        }else{
            System.out.println("AwsS3Handler.getFile("+key+"): " + obj.getObjectMetadata().getContentLength() + " ("
                + obj.getObjectMetadata().getContentType() + ", " + obj.getObjectMetadata().getContentEncoding() + ")");
        }
        return obj;
    }

    public static BufferedImage getImage(String key) {
        try {
            S3Object file = getFile(key);
            if(file != null && file.getObjectMetadata().getContentLength() > 0){
                try {
                    File tmp = new File(key);
                    S3ObjectInputStream s3is = file.getObjectContent();
                    FileOutputStream fos = new FileOutputStream(tmp);
                    byte[] read_buf = new byte[4096];
                    int read_len = 0;
                    while ((read_len = s3is.read(read_buf)) > 0) {
                        fos.write(read_buf, 0, read_len);
                    }
                    s3is.close();
                    fos.close();
                    System.out.println("LOCAL."+key+": " + tmp.length());
                    BufferedImage ret = ImageIO.read(tmp);
                    return ret;
                } catch (AmazonServiceException e) {
                    System.err.println(e.getErrorMessage());
                    e.printStackTrace();
                } catch (FileNotFoundException e) {
                    System.err.println(e.getMessage());
                    e.printStackTrace();
                } catch (IOException e) {
                    System.err.println(e.getMessage());
                    e.printStackTrace();
                }
            }
        } catch (Exception e) {
            String msg = (e.getCause() != null ? e.getCause().getMessage() : e.getMessage());
            System.out.println("AwsS3Handler.getImage("+key+").ERROR: " + msg);
            e.printStackTrace();
        }
        return null;
    }
}
