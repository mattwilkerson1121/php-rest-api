CREATE TABLE details (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(128) NOT NULL,
 sort_order INT NOT NULL DEFAULT 0,
 image VARCHAR(512),
 color VARCHAR(128),
 fabric VARCHAR(128),
 description TEXT NOT NULL,
 is_eco BOOLEAN DEFAULT FALSE,
 eco_order INT DEFAULT 0,
 attributes VARCHAR(1024),
 cleancode CHAR(1),
 PRIMARY KEY (id)
);