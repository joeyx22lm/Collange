package edu.ucf.cop4331.Collange.service.s3;

import com.amazonaws.auth.AWSStaticCredentialsProvider;
import com.amazonaws.auth.BasicAWSCredentials;
import com.amazonaws.auth.profile.ProfileCredentialsProvider;
import com.amazonaws.services.s3.AmazonS3;
import com.amazonaws.services.s3.AmazonS3Client;
import com.amazonaws.services.s3.AmazonS3ClientBuilder;
import com.amazonaws.services.s3.model.GetObjectRequest;
import com.amazonaws.services.s3.model.S3Object;
import com.amazonaws.util.IOUtils;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.io.InputStream;

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
        rangeObjectRequest.setRange(0, 10); // retrieve 1st 11 bytes.
        return getSession().getObject(rangeObjectRequest);
    }

    public static BufferedImage getImage(String key) {
        S3Object file = getFile(key);
        if(file != null && file.getObjectMetadata().getContentLength() > 0){
            try {
                byte[] byteArray = IOUtils.toByteArray(file.getObjectContent());
                file.close();
                BufferedImage ret = ImageIO.read(new ByteArrayInputStream(byteArray));
                return ret;
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
        return null;
    }
}
