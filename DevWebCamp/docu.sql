-- 6 tablas
-- -Usuarios(clientes y Admin)
--     id int(11)
--     nombre varchar(30)
--     email varchar(30)
--     password varchar(60)
--     token varchar(15)
--     confirmado tinyint(1)

-- -ponentes
--     id int(11)
--     nombre varchar(40)
--     apellido varchar(40)
--     ciudad varchar(20)
--     pais varchar(20)
--     imagen varchar(32)
--     tags varchar(120)
--     redes text


-- -categorias
--     id int(11)
--     nombre varchar(45)


-- -dias
--     id int(11)
--     nombre varchar(45)


-- -horas
--     id int(11)
--     hora varchar(13)



-- -evventos
--     id int(11)
--     nombre varchar(120)
--     descripcion text,
--     disponibles int(11)
--     categoria_id int(11)
--     dia_id int(11)
--     hora_id int(11)
--     ponente_id int(11)


-----------------------------------------------
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `ponentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `ciudad` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `imagen` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tags` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `redes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `categorias` (`id`, `hora`) VALUES
(1, 'WorkShops'),
(2, 'Conferencias'),


CREATE TABLE `dias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `dias` (`id`, `hora`) VALUES
(1, 'Viernes'),
(2, 'Sabado'),


CREATE TABLE `horas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `hora` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `horas` (`id`, `hora`) VALUES
(1, '10:00 - 10:55'),
(2, '11:00 - 11:55'),
(3, '12:00 - 12:55'),
(4, '13:00 - 13:55'),
(5, '16:00 - 16:55'),
(6, '17:00 - 17:55'),
(7, '18:00 - 18:55'),
(8, '19:00 - 19:55');


CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `descripcion` text,
  `disponibles` int DEFAULT NULL,
  `categoria_id` int NOT NULL,
  `dia_id` int NOT NULL,
  `hora_id` int NOT NULL,
  `ponente_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_eventos_categorias_idx` (`categoria_id`),
  KEY `fk_eventos_dias1_idx` (`dia_id`),
  KEY `fk_eventos_horas1_idx` (`hora_id`),
  KEY `fk_eventos_ponentes1_idx` (`ponente_id`),
  CONSTRAINT `fk_eventos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `fk_eventos_dias1` FOREIGN KEY (`dia_id`) REFERENCES `dias` (`id`),
  CONSTRAINT `fk_eventos_horas1` FOREIGN KEY (`hora_id`) REFERENCES `horas` (`id`),
  CONSTRAINT `fk_eventos_ponentes1` FOREIGN KEY (`ponente_id`) REFERENCES `ponentes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `eventos`(`id`, `nombre`, `descripcion`, `disponibles`, `categoria_id`, `dia_id`, `hora_id`, `ponente_id`) VALUES ('2','Next.js','Descripcion del evento 2','40','1','2','5','1'), ('3','Next.js','Descripcion del evento 3','40','2','1','4','1')