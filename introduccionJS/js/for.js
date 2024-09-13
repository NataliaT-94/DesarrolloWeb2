//For loop

for(let i = 0; i < 10; i++){
    console.log(i);
}

//

for(let i = 1; i <= 100; i++){
    if(i % 2 === 0){
        console.log(`El numero ${i} es PAR`);
    } else {
        console.log(`El numero ${i} es IMPAR`);
    }
}

//

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

for(let i = 0; i < carrito.length; i++){
    console.log(carrito[i].nombre);
    
}