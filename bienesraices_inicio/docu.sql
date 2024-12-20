CREATE TABLE vendedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(15) NOT NULL
);
--------
CREATE TABLE propiedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT NOT NULL,
    habitaciones INT NOT NULL,
    banio INT NOT NULL,
    estacionamiento INT NOT NULL,
    vendedorId INT NOT NULL,
    FOREIGN KEY (vendedorId) REFERENCES vendedores(id) ON DELETE CASCADE ON UPDATE CASCADE
);
----------------
-- En caso de que ya esten creadas las tablas, para poder relacionarlas realizar 
ALTER TABLE propiedades
ADD CONSTRAINT fk_vendedor
FOREIGN KEY (vendedorId) REFERENCES vendedores(id)
ON DELETE CASCADE
ON UPDATE CASCADE;
----------------------------------------------------------------

CREATE TABLE vendedores (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    telefono VARCHAR(11) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE propiedades(
    id INT(11) AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT NOT NULL,
    habitaciones INT NOT NULL,
    banio INT NOT NULL,
    estacionamiento INT NOT NULL,
    vendedorId INT(11) NOT NULL,
    PRIMARY KEY (id),
    KEY vendedorId (vendedorId),
    CONSTRAINT vendedor_FK
    FOREIGN KEY (vendedorId) 
    REFERENCES vendedores(id)
);

INSERT INTO `vendedores` (`nombre`, `apellido`, `telefono`) VALUES
('Natt', 'Techeira', '123456789'),
('Braian', 'Zamudio', '987654321');

ALTER TABLE `propiedades` ADD `creado` DATE NULL AFTER `estacionamiento`;
ALTER TABLE `propiedades` ADD `imagen` VARCHAR(200) NOT NULL AFTER `precio`;

CREATE TABLE `bienesraices_crud`.`usuarios` (`id` INT NOT NULL AUTO_INCREMENT ,
 `email` VARCHAR(50) NOT NULL , `password` CHAR(60) NOT NULL , 
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

 INSERT INTO `usuarios`(`id`, `email`, `password`) VALUES 
 ('1','correo@correo.com','12345678')