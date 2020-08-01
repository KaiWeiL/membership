DROP DATABASE IF EXISTS Kai200436558;
CREATE DATABASE Kai200436558;
USE Kai200436558;



CREATE TABLE user_info(
	id INT UNSIGNED AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(40) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE user_info_more(
	id INT UNSIGNED,
    location VARCHAR(20) NOT NULL,
    social_media_URL VARCHAR(100),
    skill VARCHAR(100),
    image_id VARCHAR(200) NOT NULL,
    PRIMARY KEY(id),
	CONSTRAINT fk_user_more
    FOREIGN KEY (id) REFERENCES user_info(id)
);


CREATE TABLE credential(
	id INT UNSIGNED,
    `account` VARCHAR(60) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL,
    CONSTRAINT fk_user
    FOREIGN KEY (id) REFERENCES user_info(id)
);