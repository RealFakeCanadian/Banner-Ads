CREATE DATABASE app;
USE app;

CREATE TABLE content (
                         id INT NOT NULL AUTO_INCREMENT,
                         category VARCHAR(50) NOT NULL,
                         content VARCHAR(50) NOT NULL,
                         PRIMARY KEY(id)
);

INSERT INTO content (category,content)
VALUES
    ("cat1","cont1"),
    ("cat2","cont2"),
    ("cat3","cont3");