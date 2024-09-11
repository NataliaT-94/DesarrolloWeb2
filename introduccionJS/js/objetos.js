//Objetos

const producto = {
    nombre : "Monitor",
    precio : 300,
    disponible : true
}

//Forma anterior
/*
 const precioProducto = producto.precio;
 const nombreProducto = producto.nombre;

 console.log(precioProducto);
 console.log(nombreProducto);
*/

//Destructuring

const {precio, nombre} = producto;


console.log(precio);
console.log(nombre);

//--------------

Object.freeze(producto);//para congelar el objeto y que no permita agregar, eliminar, modificar las caracteristicas del objeto

console.log(Object.isFrozen(producto)); //para verificar que el objeto esta congelado


Object.seal(producto);//para congelar el objeto y que no permita agregar, eliminar, pero si modificar las caracteristicas del objeto

console.log(Object.isSealed(producto)); //para verificar que el objeto esta congelado

//--------------
 //unir dos objetos

 const medidas = {
    peso: '1kg',
    medida: '1m'
 }

 const nuevoProducto = { ...producto, ...medidas};

 console.log(nuevoProducto);
 