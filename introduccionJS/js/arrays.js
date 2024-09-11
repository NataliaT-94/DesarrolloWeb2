// Arrays

const numeros = [10,20,30,40,50];
console.log(numeros);

const meses = ['Enero','Febrero','Marzo','Abril','Mayo'];
console.log(meses);


// Acceder a los valores de un array

console.log(numeros[0]);
console.log(numeros[2]);


// Conocer la extencion de un Array

console.log(meses.length);

numeros.forEach( function(numero){
    console.log(numero);
    
})


//Modificar el array original
/*
numeros.push(60,70,80)//Agrega al final del Array
numeros.unshift(60,70,80)//Agrega al principio del Array

meses.pop(); // Ellimina el ultimo elemento
meses.shift(); // Ellimina el primer elemento
meses.splice(2,1); // el primer valor indica cual queres eliminar, el segundo cuantos a partir de esa posicion queres eliminar
*/

//Rest Operator o Spread Operator
/*
const nuevoArray = [...meses, 'Junio'];
const nuevoArray = ['Junio', ...meses];
*/

//Array Methods


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

// forEach

meses.forEach(function(mes){
    console.log(mes);//recorre cada mes
    
})
meses.forEach(function(mes){
    if(mes == 'Marzo'){
        console.log('Marzo si existe');//recorre cada mes para encontrar marzo
    }
    
})

// includes

let resultado = meses.includes('Enero');//verifica q exita o no enero

// some ideal para array de objetos

resultado = carrito.some(function(producto){
    return producto.nombre === 'Celular';//verifica q exita o no el producto
});

// reduce

resultado = carrito.reduce(function(total, producto){
    return total + producto.precio //Suma todos los precios, iniciando de la posicion 0
},0);

// filter

resultado = carrito.filter(function(producto){
    return producto.precio > 400 //filtra y muestra todos los productos mayor a 400
});
resultado = carrito.filter(function(producto){
    return producto.nombre !== 'Celular' //filtra y muestra todos los productos que no se llamen celular
});