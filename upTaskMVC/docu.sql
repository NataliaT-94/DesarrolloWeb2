-- tablas
-- -Usuarios(clientes y Admin)
--     id int(11)
--     nombre varchar(30)
--     email varchar(30)
--     password varchar(60)
--     token varchar(15)
--     confirmado tinyint(1)

-----------------------------------------------

CREATE TABLE usuarios (
id INT(11) NOT NULL AUTO_INCREMENT, 
nombre VARCHAR(30) NOT NULL, 
email VARCHAR(30) NOT NULL, 
password VARCHAR(60) NOT NULL, 
token VARCHAR(15) NOT NULL,  
confirmado BOOLEAN NOT NULL,
 PRIMARY KEY (id)) ENGINE = InnoDB;