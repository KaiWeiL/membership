DROP DATABASE IF EXISTS developer_network;
CREATE DATABASE developer_network;
USE developer_network;

CREATE TABLE developer_info(
	id  INT UNSIGNED AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    email VARCHAR(20) NOT NULL,
    current_city VARCHAR(20),
    skills VARCHAR(80),
    PRIMARY KEY(id)
);

DESC developer_info;