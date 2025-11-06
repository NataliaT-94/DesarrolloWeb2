-- 3 tablas
-- -Usuarios(clientes y Admin)
--     id int(11)
--     nombre varchar(30)
--     email varchar(30)
--     password varchar(60)
--     token varchar(15)
--     confirmado tinyint(1)

-- -Proyectos
--     id int(11)
--     proyecto varchar(60)
--     url varchar(32)
--     propietarioId int(11)(FK)

-- -Tareas
--     id int(11)
--     nombre varchar(60)
--     estado tinyint(1)
--     proyectoId int(11)(FK)


-----------------------------------------------

CREATE TABLE usuarios (
id INT(11) NOT NULL AUTO_INCREMENT, 
nombre VARCHAR(30) NOT NULL, 
email VARCHAR(30) NOT NULL, 
password VARCHAR(60) NOT NULL, 
token VARCHAR(15) NOT NULL,  
confirmado BOOLEAN NOT NULL,
 PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE proyectos (
id INT(11) NOT NULL AUTO_INCREMENT, 
proyecto VARCHAR(30) NOT NULL, 
url VARCHAR(32) NOT NULL,  
propietarioId int(11) NOT NULL,
PRIMARY KEY (id),
KEY propietarioId (propietarioId), 
CONSTRAINT usuarios_FK FOREIGN KEY (propietarioId) REFERENCES usuarios(id) );

CREATE TABLE tareas (
id INT(11) NOT NULL AUTO_INCREMENT, 
nombre VARCHAR(60) NOT NULL, 
estado tinyint(1) NOT NULL,  
proyectoId int(11) NOT NULL,
PRIMARY KEY (id),
KEY proyectoId (proyectoId), 
CONSTRAINT proyectos_FK FOREIGN KEY (proyectoId) REFERENCES proyectos(id) );
