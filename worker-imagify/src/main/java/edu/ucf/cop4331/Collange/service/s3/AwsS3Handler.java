package edu.ucf.cop4331.Collange.service.s3;

import com.amazonaws.AmazonServiceException;
import com.amazonaws.auth.AWSStaticCredentialsProvider;
import com.amazonaws.auth.BasicAWSCredentials;
import com.amazonaws.services.s3.AmazonS3;
import com.amazonaws.services.s3.AmazonS3ClientBuilder;
import com.amazonaws.services.s3.model.*;
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

    public static String putFile(String key, InputStream is, String mimeType, long bytes){
        ObjectMetadata md = new ObjectMetadata();
        md.setContentLength(bytes);
        md.setContentType(mimeType);
        PutObjectResult ret = getSession().putObject(new PutObjectRequest(
                getBucket(), key, is, md));
        return (ret == null ? null : ret.getETag());
    }

    /**
     * Stores a buffered image as a JPG.
     * @param key
     * @param img
     * @return
     */
    public static String putImage(String key, BufferedImage img) throws IOException {
        ByteArrayOutputStream os = new ByteArrayOutputStream();
        ImageIO.write(img, "jpg", os);
        InputStream is = new ByteArrayInputStream(os.toByteArray());
        return putFile(key, is, "image/jpeg", os.toByteArray().length);
    }
}
