CREATE DATABASE app;
USE app;

CREATE TABLE content (
                         id INT NOT NULL AUTO_INCREMENT,
                         banner_name VARCHAR(100),
                         category VARCHAR(100) NOT NULL,
                         content VARCHAR(2000) NOT NULL,
                         PRIMARY KEY(id)
);

INSERT INTO content (banner_name,category,content)
VALUES
    ("banner_name1","cat1","cont1"),
    ("","cat2","cont2"),
    ("banner_name3","cat3","cont3");