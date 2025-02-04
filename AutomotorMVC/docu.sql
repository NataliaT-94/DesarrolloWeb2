CREATE TABLE vendedores (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    telefono VARCHAR(11) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE vehiculos(
    id INT(11) AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    modelo INT NOT NULL,
    puertas INT NOT NULL,
    motor INT NOT NULL,
    creado DATE NOT NULL,
    vendedorId INT(11) NOT NULL,
    PRIMARY KEY (id),
    KEY vendedorId (vendedorId),
    CONSTRAINT vendedor_FK
    FOREIGN KEY (vendedorId) 
    REFERENCES vendedores(id)
);

CREATE TABLE `automotormvc`.`usuarios` (`id` INT NOT NULL AUTO_INCREMENT ,
 `email` VARCHAR(50) NOT NULL , `password` CHAR(60) NOT NULL , 
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `vehiculos`(`titulo`, `precio`, `descripcion`, `modelo`, `puertas`, `motor`, `vendedorId`) VALUES
 ('cronos drive','123444','El mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculoEl mejor vehiculo','2023','4','1.6','2');

 INSERT INTO `vendedores`(`id`, `nombre`, `apellido`, `telefono`) VALUES ('1','Natt','Techeira','1125397568');
 INSERT INTO `vendedores`(`id`, `nombre`, `apellido`, `telefono`) VALUES ('2','Eve','Techeira','1122347538');

 INSERT INTO `usuarios`(`id`, `email`, `password`) VALUES ('1','correo@correo.com','$2y$10$HfWvkMI2QAVIXmTS94V.u.aem3c9Daaan1I0Zy/JqsoZd2v1oQQmS')