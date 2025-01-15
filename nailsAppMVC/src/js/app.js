let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;
const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}


document.addEventListener('DOMContentLoaded', function(){
    iniciarAppUsuario();

});//Cuando todo el DOM este cargado ejecutar la figuiente funcion

function iniciarAppUsuario(){

    
    mostrarSeccion();//Muestra y Oculta las secciones
    tabs();//Cambia la seccion cuando se presionen los tabs
    botonesPaginador();//Agrega o Quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();//Consulta la API en el backend de PHP

    idCliente();
    nombreCliente();//Añade el nombre del cliente al objeto de cita
    seleccionarFecha();//Añade la fecha de la cita en el objeto
    seleccionarHora();//Añade la hora de la cita en el objeto

    mostrarResumen();//Muestra el resumen de la cita

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

        mostrarResumen();
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

async function consultarAPI(){
    
    try{
        // const url = '$(location.origin)/api/servicios';
        const url = '/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        mostrarServicios(servicios);

    } catch (error){
        console.log(error);
    }
}

function mostrarServicios(servicios){
    
    servicios.forEach( servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
        
    });
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;//extrae el nuevo servicio//servicios viene de const cita-servicios[]

    //Identificar el elemento al que se le da click
    const divSevicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //Comprobar si un servicio ya fue agregado
    if(servicios.some(agregado => agregado.id === id)){//va a iterar sobre el arreglo y va a devolver true o false  
        //Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divSevicio.classList.remove('seleccionado');

    
    } else {
        //Agregarlo
        cita.servicios = [...servicios, servicio];//toma la copia de los servicios ya seeccionados y le agrega el nuevo servicio
        divSevicio.classList.add('seleccionado');
    }

    //console.log(cita);
    
}

function idCliente(){
    cita.id = document.querySelector('#id').value;
    
}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
    
}

function seleccionarFecha(){

    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        e.preventDefault();
        const dia = new Date(e.target.value).getUTCDay();

        if([6, 0].includes(dia)){
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        } else {
            cita.fecha = e.target.value;
        } 
    });
} 

function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];

        if(hora < 10 || hora > 18){
            e.target.value = '';
            mostrarAlerta('Hora no valida', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;
        } 
    });
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    //Previene que se creen mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    } 

    //Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece){
        //Eliminar la alerta
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');

    //Limpiar el contenido del resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('') || cita.servicios.length === 0){//si el valor de la cita contiene string vacios
        mostrarAlerta('Faltan datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false );
        return;
    }

    //Formatear el div de resumen
    const {nombre, fecha, hora, servicios} = cita;
    
    const nombreCLiente = document.createElement('P');
    nombreCLiente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const dia = fechaObj.getDate() + 2;
    const mes = fechaObj.getMonth();
    const year = fechaObj.getFullYear();

    const opciones = {day: 'numeric', weekday: 'long', month: 'long', year: 'numeric'}
    const fechaUTC = new Date( Date.UTC(year, mes, dia));
    const fechaFormateada = fechaUTC.toLocaleDateString('es-AR', opciones);
    
    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
    
    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} HS`;

    //Heading para Servicios en Resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';

    resumen.appendChild(headingServicios);

    //Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    //Heading para Cita en Resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';

    resumen.appendChild(headingCita);

    //Boton para Crear una Cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(botonReservar);


    resumen.appendChild(nombreCLiente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

}

async function reservarCita(){
    const { nombre, fecha, hora, servicios, id} = cita;

    const idServicios = servicios.map(servicio => servicio.id);

    const datos = new FormData();


    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuarioId', id);//append sirve para agrega datos
    datos.append('servicios', idServicios);

    console.log([...datos]);

    try {
        //Peticion hacia la API
        // const url = '$(location.origin)/api/citas';
        const url = '/api/citas';

        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        

        if(resultado.resultado){
            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita fue creada correctamente!",
                button: 'OK'
            }).then(() => {
                setTimeout(() => {
                    window.location.reload();

                }, 3000);
            });
        }
    } catch (error) {
        console.log(error);
        
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error al gurdar la cita!"
        });
    }





    
    
    
}