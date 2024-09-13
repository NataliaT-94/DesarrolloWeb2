//while: primero evalua la condicion y si se cumple lo ejecuta

let i = 1;//indice o valor inicial

while(i <= 100){//condicion
    if(i % 2 === 0){
        console.log(`El numero ${i} es PAR`);   
    } else {
        console.log(`El numero ${i} es IMPAR`);   
    }
    i++;//incremento
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

let j = 0;

while(j < carrito.length){
    console.log(carrito[j].nombre);   
    j++;
}

// do while: primero ejecuta la funcion al menos una vez y despues evalua si se cumple la condicion

let l = 100;

do{
    console.log(l);
    l++;    
} while(l < 10);
