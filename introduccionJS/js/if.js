//Estructura de control

const puntaje = 100;

if(puntaje == 1000){
    console.log('Si el punjaje es 1000');
}else{
    console.log('No es igual');
};
 //

 const efectivo = 1000;
 const carrito = 800;

 if(efectivo > carrito){
    console.log('El usuario puede pagar');    
 } else {
    console.log('Fondos insuficientes');   
}

//

const rol = 'Editor';

if(rol === 'Administrador'){
    console.log('Acceso a todo el sistema');
} else if (rol === 'Editor'){
    console.log('Eres editor, puedes ingresar con funciones limitadas');
} else {
    console.log('No tienes acceso');
    
}