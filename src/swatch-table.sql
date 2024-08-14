CREATE TABLE details (
 id INT NOT NULL AUTO_INCREMENT,
 name VARCHAR(128) NOT NULL,
 sort_order DECIMAL NOT NULL DEFAULT 0.0,
 image VARCHAR(512),
 color VARCHAR(128),
 fabric VARCHAR(128),
 description TEXT NOT NULL,
 is_eco BOOLEAN DEFAULT 0,
 eco_order DECIMAL DEFAULT 0.0,
 attributes VARCHAR(1024),
 cleancode VARCHAR(2),
 is_available BOOLEAN DEFAULT 1
 PRIMARY KEY (id)
);
