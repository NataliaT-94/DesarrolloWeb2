let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});//Cuando todo el DOM este cargado ejecutar la figuiente funcion

function iniciarApp(){
    mostrarSeccion();//Muestra y Oculta las secciones
    tabs();//Cambia la seccion cuando se presionen los tabs
    botonesPaginador();//Agrega o Quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

}

function mostrarSeccion(){
    //Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');

    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso..
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);

    seccion.classList.add('mostrar');

    //Quita la clase actual del tab anterior
    const tabAnterior = document.querySelector('.actual');

    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);//toma data-paso del index y el paso del let

    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {//accedemos a cada uno de los botones
        boton.addEventListener('click', function(e){
            paso = parseInt( e.target.dataset.paso );//averiguamos el num de paso al cual le haceos click

            mostrarSeccion();
            botonesPaginador();
            
        })
    })
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;

        botonesPaginador();
    })

}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');

    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;

        botonesPaginador();
    })
}