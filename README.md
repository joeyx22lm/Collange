# Collange
#### UCF COP4331C - Image Filter Application, Team 20

This project seeks to create a web application, which allows users to upload images and apply unto them one or more precreated image filters. This project is written in both PHP 7.0+ and Java 8, and demonstrates the asynchronous application of filters and transformations unto images. 

The project in its current state is packaged to be easily deployed in a Heroku pipeline, and scale both web and worker processes dynamically according to load. The PHP web application is served by an Apache buildpack, while the filter worker is Java application, packaged as a runnable Jar. RPC calls between the web application and filter workers are handled by a Redis queue. 

Look below for build instructions. tl;dr: gradle and composer. gradle manages the parent project and java module, composer manages the PHP module.



# Demo

https://collange.herokuapp.com


# How to build
This project uses gradle to handle dependencies, building, packaging and testing. Look below for more information on how to package the application.


**How to see all possible build options/tasks:**
```
./gradlew tasks
```

**How to build:**
```
./gradlew clean build
```

**How to test:**
```
./gradlew test
```

**How to run deployment tasks:**
```
./gradlew clean stage
```
