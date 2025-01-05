-- 4tablas
-- -Usuarios(clientes y Admin)
--     id int(11)
--     nombre varchar(60)
--     apellido varchar(60)
--     email varchar(30)
--     telefono varchar(10)
--     admin tinyint(1)
--     confirmado tinyint(1)
--     token varchar(15)
-- -Citas
--     id int(11)
--     fecha date
--     hora time
--     usuarioId int(11) forenkey usuario
-- -Servicios
--     id int(11)
--     nombre varchar(60)
--     precio decimal(5,2)
-- -CitasServicios
--     id int(11)
--     citaId int(11) forenkey citas
--     servicioId int(11) forenkey servicios
-----------------------------------------------

CREATE TABLE `nailsmvc`.`usuarios` (`id` INT(11) NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(60) NOT NULL , `apellido` VARCHAR(60) NOT NULL , `email` VARCHAR(30) NOT NULL , `password` VARCHAR(60) NOT NULL , `telefono` VARCHAR(10) NOT NULL , `admin` BOOLEAN NOT NULL , `confirmado` BOOLEAN NOT NULL , `token` VARCHAR(15) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `nailsmvc`.`servicios` (`id` INT(11) NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(60) NOT NULL , `precio` DECIMAL(5,2) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
('1', 'Acrilicas', '20.00'),
('2', 'Semipermanente', '15.00'),
('3', 'Encapsuladas', '25.00'),
('4', 'Kapping en gel o acrilicas', '25.00'),
('5', 'Esculpidas en gel o acrilicas', '30.00'),
('6', 'Extension de uñas en gel o acrilicas', '10.00'),
('7', 'Dipping', '20.00'),
('8', 'Acrilicas', '25.00'),
('9', 'Softgel', '30.00'),
('10', 'Manicuria Completa', '50.00'),
('11', 'Aplicacion de piedras, glitters o strass, c/u', '10.00'),
('12', 'Decoracion por uña', '10.00'),


CREATE TABLE citas( id INT(11) AUTO_INCREMENT, fecha DATE NOT NULL, hora TIME NOT NULL, usuarioId INT(11) NOT NULL, PRIMARY KEY (id), KEY usuarioId (usuarioId), CONSTRAINT usuarios_FK FOREIGN KEY (usuarioId) REFERENCES usuarios(id) );

CREATE TABLE citasServicios( id INT(11) AUTO_INCREMENT, citaId INT(11) NOT NULL, PRIMARY KEY (id), KEY citaId (citaId), CONSTRAINT citas_FK FOREIGN KEY (citaId) REFERENCES citas(id) );

ALTER TABLE citasServicios
ADD COLUMN servicioId INT NOT NULL;

ALTER TABLE citasServicios
ADD CONSTRAINT fk_servicioId
FOREIGN KEY (servicioId)
REFERENCES servicios(id)
ON UPDATE SET NULL;
ON DELETE SET NULL;

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `telefono`, `confirmado`) VALUES
('1', 'Natalia', 'Techaira', 'correo@correo.com', '1123567483', '1' )

INSERT INTO `citas` (`id`, `fecha`, `hora`, `usuarioId`) VALUES ('1', NOW(), NOW(), '1');