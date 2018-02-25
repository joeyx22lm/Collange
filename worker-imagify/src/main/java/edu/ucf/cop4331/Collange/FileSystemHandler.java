package edu.ucf.cop4331.Collange;

import java.io.File;

public class FileSystemHandler {
    public static File getResource(String path) {
        StringBuilder result = new StringBuilder();
        ClassLoader classLoader = FileSystemHandler.class.getClassLoader();
        return new File(classLoader.getResource(path).getFile());
    }
}
