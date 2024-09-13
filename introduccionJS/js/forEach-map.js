const carrito = [
    {nombre: 'Monitor', precio: 500},
    {nombre: 'Televisor', precio: 700},
    {nombre: 'Tablet', precio: 300},
    {nombre: 'Teclado', precio: 500},
    {nombre: 'Audifono', precio: 50},
    {nombre: 'Celular', precio: 500},
    {nombre: 'Parlantes', precio: 300},
    {nombre: 'Laptop', precio: 800}
];


//forEach:  Cuando quieras imprimir algo en consola o cuando quieras imprimir en el HTML, Esta diseñado para iterar y mostrar los resultados

carrito.forEach(function(producto){
    console.log(producto.nombre); 
});

//

carrito.forEach(producto => console.log(producto.nombre));

//map: sirve para crear un nuevo array con la informacion q requerimos, en este caso un array con los nombres de los productos

const arreglo1 = carrito.map(producto => producto.nombre);
console.log(arreglo1);
