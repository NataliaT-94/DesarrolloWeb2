//querySelector

const heading = document.querySelector('.header__texto h2')// retorna de 0 a 1 elemento
console.log(heading);


//querySelectorAll

const enlaces = document.querySelectorAll('.navegacion a');// retorna varios elementos
enlaces[0].textContent = 'Nuevo texto';
enlaces[0].href = 'http://google.com';
console.log(enlaces[0]);
console.log(enlaces[1]);

//getElementById

const heading2 = document.getElementById('heading');
console.log(heading2);

//Crear un nuevo enlace con codigo js

const nuevoEnlace = document.createElement('A');

/** Agregar el href*/

nuevoEnlace.href = 'nuevo-enlace.html';

/** Agregar el texto*/

nuevoEnlace.textContent = 'Un nuevo enlace'; 

/** Agregar la clase*/

nuevoEnlace.classList.add('navegacion__enlace');


//Agregarlo al documento

const navegacion = document.querySelector('.navegacion');
navegacion.appendChild(nuevoEnlace);

//-----------

//Eventos

window.addEventListener('load', function(){//load espera a que el JS y los archivos que dependen del HTML esten listos
    console.log(2);
});

window.onload = function(){// nueva sintaxis
    console.log(3);
    
}

document.addEventListener('DOMContentLoaded', function(){//Solo espera por e lHTML, pero no espera CSS o imagenes
    console.log(4);
    
})

//Eventos del teclado

const datos = {
    nombre: '',
    email: '',
    mensaje: ''
}

const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');

nombre.addEventListener('input', leerTexto);
email.addEventListener('input', leerTexto);
mensaje.addEventListener('input', leerTexto);

function leerTexto(e){
    datos[e.target.id] = e.target.value;

    console.log(datos);
}
/*
//Seleccionar elementos y asociarloes un evento

const btnEnviar = document.querySelector('boton--primario');
btnEnviar.addEventListener('click', function(e){//click esta asociado a cualquier elemento
    console.log(e);
    e.preventDefault();//validar formulario, no recarga la pagina hasta no evaluar si esta todo completo correctamente

    console.log('enviando formulario');    
})
*/
//Evento submit

const formulario = document.querySelector('.formulario');
formulario.addEventListener('submit', function(e){// submit esta asociado al formulario
    e.preventDefault();

    //validar el formulario
    const {nombre, email, mensaje} = datos;//permite extraer los vlaores de un objeto, pero tambien crear las variables al mismo tiempo

    
    if(nombre === '' || email === '' || mensaje === ''){
        // mostrarError('Todos los campos son obligatorios');
        mostrarAlerta('Todos los campos son obligatorios',true);
        return;// Corta la ejecucion del codigo
    }
    // crear la alerta de Enviar correctamente

    // mostrarMensaje('Mensaje enviado correctamente');    
    mostrarAlerta('Todos los campos son obligatorios');
})
/*
//Mostrar una alerta de que se envio correctamente

function mostrarMensaje(mensaje){
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;
    alerta.classList('correcto');

    formulario.appendChild(alerta);
    
    //desapareccer despues de 5 segundos

    setTimeout(()=>{
        alerta.remove()
    }, 5000);
}

//mostrar un error en pantalla

function mostrarError(mensaje){
    const error = document.createElement('P');
    error.textContent = mensaje;
    error. classList.add('error');

    formulario.appendChild(error);

    //desapareccer despues de 5 segundos

    setTimeout(()=>{
        error.remove()
    }, 5000);
}
*/
//refactorizar funciones

function mostrarAlerta(mensaje,error = null){
    const alerta = document.createElement('P');
    alerta.textContent = mensaje;

    if(error){
        alerta.classList.add('error');
    } else {
        alerta.classList.add('correcto');
    }

    formulario.appendChild(alerta);

        //desapareccer despues de 5 segundos

        setTimeout(()=>{
            alerta.remove()
        }, 5000);
}