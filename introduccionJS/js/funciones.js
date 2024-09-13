//Declaracion de la funcion

sumar();// se puede llamar la funcion primero

function sumar(){
    console.log(10 + 10);
    
}


//Expresion de la funcion

const sumar2 = function (){
    console.log(3 + 3);
    
}
sumar2(); //no se puede llamar la funcion primero

//IIFE: permite protejer que no se mesclen las variables de unas funciones con las de otros archivos, se llama a ella sola

(function (){
    const cliente = 'juan';
    
})();

//--------------

const numero1 = 20;
const numero2 = "20";

console.log(parseInt(numero2));//parseInt() es una funcion
console.log(numero1.toString());//.toString() es un metodo

//--------------
 //funciones inteligentes con parametros y argumentos

function sumar(numero1, numero2){//numero1, numero2 son los parametros
    console.log(numero1 + numero2);
    
}
sumar(10, 5);//Argumentos o los valores reales
sumar(1, 5);
sumar(6, 5);


const sumar02 = function (n1, n2){
    console.log(n1 + n2);
    
}
sumar02(5, 10);

//parametros por default

function sumar(numero1 = 0, numero2 = 0){//si alguno de los dos parametros falta se suma con 0
    console.log(numero1 + numero2);
    
}
sumar(10);

//--------------
 //funciones que retornan valores

 function sumar(n1, n2){
    return n1 + n2;
 }

 const resultado = sumar(2, 3);
 console.log(resultado);

 //ejemplo2 

 let total = 0;

 function agregarCarrito(precio){
    return total += precio;
 }//suma el precio del los productos del carrito

 function calcularImpuesto(total){
    return 1.15 * total;
 }//al total del carrito le multiplica el impuesto

 total = agregarCarrito(200);
 total = agregarCarrito(300);

 console.log(total);

 const totalAPagar = calcularImpuesto(total);
 console.log(`El total a pagar con impuestos es de: ${totalAPagar}`);
 
 
//--------------
 //Metodos de propiedad

 const reproductor = {
    reproducir : function(id){
        console.log(`Reproduciendo Cancion con el IO: ${id}`);
    },
    pausar : function(){
        console.log('Pausado...');
    },
    crearPlaylist : function(nombre){
        console.log(`Reproduciendo Cancion con el IO: ${nombre}`);
    },
    reproducirPlaylist : function(nombre){
        console.log(`Reproduciendo Cancion con el IO: ${nombre}`);
    },
 }

 resproductor.borrarCancion = function(id){
    console.log(`Eliminar la cancion: ${id}`);
 }
 
 reproductor.reproducir(3840);
 reproductor.pausar();
 reproductor.borrarCancion(30);
 reproductor.crearPlaylist(3840);
 reproductor.reproducirPlaylist(3840);

 //--------------
 //Arrow Functions

const sumar3 = (n1, n2) => console.log(n1 + n2);
sumar3(5, 10);


const aprendiendo = tecnologia => console.log(`Aprendiendo ${tecnologia}`);
aprendiendo('JavaScript');


// forEach
const meses = ['Enero','Febrero','Marzo','Abril','Mayo'];

meses.forEach(mes => {
    if(mes == 'Marzo'){
        console.log('Marzo si existe');
    }    
});

// some
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
let resultado2;
resultado2 = carrito.some(producto => producto.nombre === 'Celular');
console.log(resultado2);



// reduce

resultado2 = carrito.reduce((total, producto) => total + producto.precio, 0);
console.log(resultado2);

// filter

resultado = carrito.filter(producto =>  producto.precio > 400);

resultado = carrito.filter((producto) => producto.nombre !== 'Celular');