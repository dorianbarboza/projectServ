CREATE DATABASE project;

USE project;

CREATE TABLE Usuario(
ID_Usuario int primary key not null auto_increment,
Username varchar(20),
Password varchar(10)
);

INSERT INTO Usuario (Username, Password)
VALUES ('dorianbarboza','123');
