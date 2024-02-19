CREATE DATABASE app;
USE app;

CREATE TABLE content (
                         id INT NOT NULL AUTO_INCREMENT,
                         content_name VARCHAR(100),
                         category VARCHAR(100) NOT NULL,
                         content VARCHAR(2000) NOT NULL,
                         PRIMARY KEY(id)
);

INSERT INTO content (content_name,category,content)
VALUES
    ("content_name1","cat1","cont1"),
    ("","cat2","cont2"),
    ("content_name3","cat3","cont3");


CREATE TABLE positions (
                         id INT NOT NULL AUTO_INCREMENT,
                         position_name VARCHAR(100),
                         category VARCHAR(100) NOT NULL,
                         content VARCHAR(2000) NOT NULL,
                         PRIMARY KEY(id)
);

INSERT INTO positions (position_name,category,content)
VALUES
    ("position_name","cat1","cont1"),
    ("","cat2","cont2"),
    ("position_name","cat3","cont3");

CREATE TABLE client_info (
                             client_id INT NOT NULL AUTO_INCREMENT,
                             client_first_name VARCHAR(100) NOT NULL,
                             client_last_name VARCHAR(100) NOT NULL,
                             gender VARCHAR(6) NOT NULL,
                             client_address VARCHAR(100) NOT NULL,
                             client_email_address VARCHAR(100) NOT NULL,
                             PRIMARY KEY(client_id)
);




CREATE TABLE people (
                             id INT NOT NULL AUTO_INCREMENT,
                             first_name VARCHAR(100) NOT NULL,
                             last_name VARCHAR(100) NOT NULL,
                             gender VARCHAR(6) NOT NULL,
                             address VARCHAR(100) NOT NULL,
                             email VARCHAR(100) NOT NULL,
                             PRIMARY KEY(id)
);

INSERT INTO people (first_name,last_name,gender,address,email)
VALUES
    ("first_name","last_name","gender","address","email");