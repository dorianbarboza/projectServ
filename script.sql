CREATE DATABASE project;

USE project;

-- Tabla Usuario
CREATE TABLE Usuario(
ID_Usuario int primary key not null auto_increment,
Username varchar(20),
Password varchar(10)
);

INSERT INTO Usuario (Username, Password)
VALUES ('dorianbarboza','123');

-- Tabla Artista
CREATE TABLE Artista(
ID_Artista int primary key not null,
Seudonimo varchar(30),
Nombre varchar(30),
Apellido varchar(30),
FechaNacimiento date,
Ciudad varchar(30),
Pais varchar(30),
UrlImg varchar(100)
);
-- Tabla Album
CREATE TABLE Album(
ID_Album int primary key not null,
NombreAlbum varchar(30),
Publicacion date,
CiudadGrabacion varchar(30),
PaisGrabacion varchar(30),
Duracion time,
Genero varchar(30),
UrlImgAlbum varchar(100)
-- Fk Artista
ALTER TABLE Album
ADD ID_Artista int,
ADD FOREIGN KEY (ID_Artista)
REFERENCES Artista (ID_Artista);
);
-- Tabla Cancion
CREATE TABLE Cancion(
ID_Cancion int primary key not null,
NombreCancion varchar(30),
DuracionCancion time,
UrlSong varchar(100)
-- FK Album
ALTER TABLE Cancion
ADD ID_Album int,
ADD FOREIGN KEY (ID_Album)
REFERENCES Album (ID_Album);
);
