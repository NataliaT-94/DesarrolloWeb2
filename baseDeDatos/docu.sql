mysql -u root -p

SHOW DATABASES; --Para poder visualizar las bases de datos existentes

CREATE DATABASE nombrebasedatos; --Para crear base de datos

USE nombrebasedatos; --Para poder usar la base de datos

-- los mas comunes: INT, TINYINT, DECIMAL, VARCHAR, TEXT, DATETIME

CREATE TABLE nombreTabla ( --creando tablas y sus columnsa
    id INT(11) NOT NULL AUTO_INCREMENT,
    nomnbre VARCHAR(60) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (id)
    );

SHOW TABLE; --Muestra las tablas

DESCRIBE nombreTabla; --nos muestra toda la informavcion de la tabla
 
-- CRUD: Create, Read, Update, Delete

INSERT INTO nombreTabla (nombre, precio) VALUES ('nombre del servicio nuevo', 60)--insertamos registros a la table

INSERT INTO nombreTabla (nombre, precio) VALUES --insertamos mas de un registro
('nombre del servicio nuevo', 60),
('nombre del servicio nuevo2', 80);

SELECT * FROM nombreTabla;--muestra los valores de la tablaUPDATE nombreTabla SET precio = 70 WHERE id = 2;//actualiza los valores del precio del id 2

DELETE FROM nombreTabla WHERE id = 2;--Elimina el registro con id 2
------------------------
 
ALTER TABLE nombreTabla ADD descripcion VARCHAR(100) NOT NULL; --Agregar nueva columna a la tabla


ALTER TABLE nombreTabla CHANGE descripcion nuevonombre VARCHAR(90) NOT NULL;-- MOdifica columna ya existente, no se puede modificar varchar por int etc

ALTER TABLE nombreTabla DROP COLUMN descripcion;-- Elimina la columna descripcion

DROP TABLE nombreTabla; --ELimina la tabla completa

--------------------------
CREATE DATABASE appsalon;

USE appsalon;

CREATE TABLE servicios ( 
    id INT(11) NOT NULL AUTO_INCREMENT,
    nomnbre VARCHAR(60) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE reservaciones ( 
    id INT(11) NOT NULL AUTO_INCREMENT,
    nomnbre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    hora TIME DEFAULT NULL,
    fecha DATE DEFAULT NULL,
    servicios VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
    );

    
    INSERT INTO reservaciones (nombre, apellido, hora, fecha, servicios) VALUES
        ('Juan', 'De la torre', '10:30:00', '2021-06-28', 'Corte de Cabello Adulto, Corte de Barba' ),
        ('Antonio', 'Hernandez', '14:00:00', '2021-07-30', 'Corte de Cabello Niño'),
        ('Pedro', 'Juarez', '20:00:00', '2021-06-25', 'Corte de Cabello Adulto'),
        ('Mireya', 'Perez', '19:00:00', '2021-06-25', 'Peinado Mujer'),
        ('Jose', 'Castillo', '14:00:00', '2021-07-30', 'Peinado Hombre'),
        ('Maria', 'Diaz', '14:30:00', '2021-06-25', 'Tinte'),
        ('Clara', 'Duran', '10:00:00', '2021-07-01', 'Uñas, Tinte, Corte de Cabello Mujer'),
        ('Miriam', 'Ibañez', '09:00:00', '2021-07-01', 'Tinte'),
        ('Samuel', 'Reyes', '10:00:00', '2021-07-02', 'Tratamiento Capilar'),
        ('Joaquin', 'Muñoz', '19:00:00', '2021-06-28', 'Tratamiento Capilar'),
        ('Julia', 'Lopez', '08:00:00', '2021-06-25', 'Tinte'),
        ('Carmen', 'Ruiz', '20:00:00', '2021-07-01', 'Uñas'),
        ('Isaac', 'Sala', '09:00:00', '2021-07-30', 'Corte de Cabello Adulto'),
        ('Ana', 'Preciado', '14:30:00', '2021-06-28', 'Corte de Cabello Mujer'),
        ('Sergio', 'Iglesias', '10:00:00', '2021-07-02', 'Corte de Cabello Adulto'),
        ('Aina', 'Acosta', '14:00:00', '2021-07-30', 'Uñas'),
        ('Carlos', 'Ortiz', '20:00:00', '2021-06-25', 'Corte de Cabello Niño'),
        ('Roberto', 'Serrano', '10:00:00', '2021-07-30', 'Corte de Cabello Niño'),
        ('Carlota', 'Perez', '14:00:00', '2021-07-01', 'Uñas'),
        ('Ana Maria', 'Igleias', '14:00:00', '2021-07-02', 'Uñas, Tinte'),
        ('Jaime', 'Jimenez', '14:00:00', '2021-07-01', 'Corte de Cabello Niño'),
        ('Roberto', 'Torres', '10:00:00', '2021-07-02', 'Corte de Cabello Adulto'),
        ('Juan', 'Cano', '09:00:00', '2021-07-02', 'Corte de Cabello Niño'),
        ('Santiago', 'Hernandez', '19:00:00', '2021-06-28', 'Corte de Cabello Niño'),
        ('Berta', 'Gomez', '09:00:00', '2021-07-01', 'Uñas'),
        ('Miriam', 'Dominguez', '19:00:00', '2021-06-28', 'Corte de Cabello Niño'),
        ('Antonio', 'Castro', '14:30:00', '2021-07-02', 'Corte de Cabello Adulti'),
        ('Hugo', 'Alonso', '09:00:00', '2021-06-28', 'Corte de Barba'),
        ('Victoria', 'Perez', '10:00:00', '2021-07-02', 'Uñas, Tinte'),
        ('Jimena', 'Leon', '10:30:00', '2021-07-30', 'Uñas, Corte de Cabello Mujer'),
        ('Raquel' ,'Peña', '20:30:00', '2021-06-25', 'Corte de Cabello Mujer');

 INSERT INTO servicios ( nombre, precio ) VALUES
        ('Corte de Cabello Niño', 60),
        ('Corte de Cabello Hombre', 80),
        ('Corte de Barba', 60),
        ('Peinado Mujer', 80),
        ('Peinado Hombre', 60),
        ('Tinte',300),
        ('Uñas', 400),
        ('Lavado de Cabello', 50),
        ('Tratamiento Capilar', 150);

SELECT * FROM servicios WHERE precio > 90; --Seleccionar todos los servicios mayor a 90 en el precio

SELECT * FROM servicios WHERE precio BETWEEN 100 AND 200; --Seleccionar todos los servicios que esten entre 100 y 200

--------------------
Funciones Agregadoras: Leen todo el grupo y nos entrega una suma, o el minimo o  maximo de un grupo de valores

SELECT COUNT(id), fecha --creamos dos columnas una count(id y la otra fecha)
    FROM reservaciones--extraemos los datos de la tabla reservaciones
    GROUP BY fecha-- estamos agrupando por su fecha
    ORDER BY COUNT(id) DESC;--la ordenamos del dia que tiene mas citas al de menor citas

SELECT SUM(precio) AS totalServicios FROM servicios;--la suma del precio de todos los servicios, totalServicios es una tabla virtual/ temporal 

SELECT MIN(precio) AS precioMenor FROM servicios;--muestra el menor de los precios

SELECT MAX(precio) AS precioMenor FROM servicios;--muestra el mayor de los precios

-------------------------

Buscar con sql

SELECT * FROM servicios WHERE nombre LIKE 'Corte%'; -- busca los servicios que empiezen con la palabra 'corte'
SELECT * FROM servicios WHERE nombre LIKE '%Corte'; -- busca los servicios que finaleze con la palabra 'corte'
SELECT * FROM servicios WHERE nombre LIKE '%Corte%'; -- busca los servicios que en algun lugar tenga la palabra 'corte'

----------------------------

Unimos dos columnas

SELECT CONCAT(nombre, '', apellido) AS nombreCompleto FROM reservaciones; -- Une la columna de nombre y apellido

SELECT * FROM reservaciones
WHERE CONCAT(nombre, '', apellido) LIKE '%Ana Preciado%'; --busca un dato en especifico

SELECT hora, fecha, CONCAT(nombre, '', apellido) AS 'Nombre Completo' 
FROM reservaciones
WHERE CONCAT(nombre, '', apellido)
LIKE '%Ana Preciado%';--creamos la tabla temporal con el nombre y apellido combinados del la tabla reservaciones, y buscamos un dato en especifico Ana Preciado

--------------------------

Multiples condiciones

SELECT * FROM reservaciones WHERE id IN(1, 3);-- trae los datos del id 1 e id 3

SELECT * FROM reservaciones WHERE fecha = '2021-06-28' AND id IN(1,10);-- trae los datos del id 1 e id 10 con fecha 2021-06-28'

SELECT * FROM reservaciones WHERE fecha = '2021-06-28' AND id = 1 AND nombre = 'Juan';-- trae los datos del id 1 con fecha 2021-06-28' y nombre juan

--------------------------

Normalizacion de base de datos : Optimizar tu base de datos con ciertes reglas

1NF: Cada columna debe tener solo 1 valor y no debe haber grupos repetidos.
 
2NF: Se enfocan mas en la relacion con otras columnas. Se utiliza en llaves primarias compuestas

3NF: Se enfoca en los demas datos que no forman parte de la llave compuesta

--------------------------

Denormalizacion: existen base de datos que no cumplen con las reglas de la normalizacion, pero no estan mal
--------------------------

Diagrama ER (entidad relacion) : Te daran una idea de forma grafica de las entidades(tablas) y sus atributos.
                                 Ayudan a conocer como se relacionan los datos
                                 Existen herramientas de paga y gratis para generar estos diagramas

Cardinalidad : Se refiere al numero maximo de veces que una instancias se relaciona con otra.

--------------------------
DROP TABLE reservaciones;

CREATE TABLE clientes(
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,--no puede haver dos email iguales
    PRIMARY KEY (id)
);
