// POO

/** Objet Literal */

const producto1 = {
    nombre: 'Tablet',
    precio: 500
}

//Object Constructor

/** Formato anterior */

// function Producto(nombre, precio){
//     this.nombre = nombre;
//     this.precio = precio;
// }

// // console.log(producto2);
// // console.log(producto3);

// //Prototypes: Crean funciones que solo se utilizan en un objeto en especifico

// Producto.prototype.formatearProducto = function(){
//     return `El producto ${this.nombre} tiene un precio de: ${this.precio}`;
// }

// const producto2 = new Producto('Monitor', 800);
// const producto3 = new Producto('Television', 400);

// function formatearProducto(producto){
//     return `El producto ${producto.nombre} tiene un precio de: ${producto.precio}`;
// }
// console.log(producto2);
// console.log(producto3);

// //

// function Cliente(nombre, apellido){
//     this.nombre = nombre;
//     this.apellido = apellido;
// }

// Cliente.prototype.formatearCliente = function(){
//     return `El cliente ${this.nombre}  ${this.apellido}`;
// }

// const cliente = new Cliente ('Natalia', 'Techeira');

// console.log(cliente);
//-------------------------

/** Formato ACTUAL */

// Classes

class Producto {
    constructor(nombre, precio){
        this.nombre = nombre;
        this.precio = precio;
    }

    formatearProducto(){
        return `El producto ${this.nombre} tiene un precio de: ${this.precio}`
    }

    obtenerPrecio(){
        console.log(this.precio);
        
    }
}

const producto2 = new Producto('Monitor', 800);
const producto3 = new Producto('Televisor', 400);

console.log(producto2.formatearProducto());
console.log(producto3.formatearProducto());


//Herencia

class Libro extends Producto{
    constructor(nombre, precio, isbn){
        super(nombre,precio);
        this.isbn = isbn;
    }
    
    formatearProducto(){
        return `${super.formatearProducto()} y su ISBN es ${this.isbn}`;
    }

    obtenerPrecio(){
        super.obtenerPrecio();
        console.log('y si hay en existencia');        
    }
}

const libro = new Libro('JS la Revolucio', 2000, '234568909864');

console.log(libro.formatearProducto());
console.log(libro.obtenerPrecio());
