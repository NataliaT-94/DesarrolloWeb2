//promise: refleja un valor que podria estar disponible ahora, en un futuro o nunca

const usuarioAutenticado = new Promise ((resolve, reject) => {
    const autenticado = false;

    if(autenticado){
        resolve('Ususario Autenticado');//en caso de que si este autenticado se ejecuta resolve
    } else {
        reject('No se pudo iniciar sesion'); //el promise no se cumple
    }
});

usuarioAutenticado

.then((resultado) => console.log(resultado))// muestra el mensaje se resolve
.catch( (error) => console.log(error))// muestra el mensaje se reject

/*
    .then(function(resultado){
        console.log(resultado);    
    })

    .catch(function(error){
        console.log(error);    
    })
*/

/*
En los Promise existen 3 valores

Pending: No se ha cumplido pero tampoco se ha rechazado
Fulfilled: Ya se cumplio
Rejected: Se ha rechazado o no se cudo cumplir
*/