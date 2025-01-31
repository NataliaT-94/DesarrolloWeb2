obtenerTareas();
let tareas = [];


//Boton para mostrar el Modal de Agregar tarea
const nuevaTareaBtn = document.querySelector('#agregar-tarea');
nuevaTareaBtn.addEventListener('click', function(){
    mostrarFormulario();
} );

async function obtenerTareas(){
    try {
        const id = obtenerProyecto();
        const url = `/api/tareas?id=${id}`;
        
        const respuesta = await fetch(url);

        const resultado = await respuesta.json();
        
        tareas = resultado.tareas;

        
        mostrarTareas();
    } catch (error) {
        console.log(error);
        
        
    }
}

function mostrarTareas(){

    limpiarTareas();
    
    if(tareas.length === 0){
        const contenedorTareas = document.querySelector('#listado-tareas');
        const textNoTareas = document.createElement('LI');
        textNoTareas.textContent = "No hay Tareas";
        textNoTareas.classList.add('no-tareas');

        contenedorTareas.appendChild(textNoTareas);
    }

    const estados = {
        0: 'Pendiente',
        1: 'Completa'
    }

    tareas.forEach(tarea => {
        const contenedorTarea = document.createElement('LI');
        contenedorTarea.dataset.tareaId = tarea.id;
        contenedorTarea.classList.add('tarea');

        const nombreTarea = document.createElement('P');
        nombreTarea.textContent = tarea.nombre;
        nombreTarea.ondblclick = function(){
            mostrarFormulario(editar = true, tarea);
        }

        const opcionesDiv = document.createElement('DIV');
        opcionesDiv.classList.add('opciones');

        //Botones
        const btnEstadoTarea = document.createElement('BUTTON');
        btnEstadoTarea.classList.add('estado-tarea');
        btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
        btnEstadoTarea.textContent = estados[tarea.estado];
        btnEstadoTarea.dataset.estadoTarea = tarea.estado;
        btnEstadoTarea.ondblclick = function(){//doble click
            cambiarEstadoTarea({...tarea});//sacamos una copia del objeto la cual vamos a modificar
            
        }

        const btnEliminarTarea = document.createElement('BUTTON');
        btnEliminarTarea.classList.add('eliminar-tarea');
        btnEliminarTarea.dataset.idTarea = tarea.id;
        btnEliminarTarea.textContent = 'Eliminar';
        btnEliminarTarea.ondblclick = function(){
            confirmarEliminarTarea({...tarea});
        }

        opcionesDiv.appendChild(btnEstadoTarea);
        opcionesDiv.appendChild(btnEliminarTarea);

        contenedorTarea.appendChild(nombreTarea);
        contenedorTarea.appendChild(opcionesDiv);

        const listadoTareas = document.querySelector('#listado-tareas');
        listadoTareas.appendChild(contenedorTarea);
        
    });
    
}

function mostrarFormulario(editar = false, tarea = {}){
    const modal = document.createElement('DIV');
    modal.classList.add('modal');
    modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>${editar ? 'Editar Tarea' : 'Añade una nueva tarea'}</legend>
            <div class="campo">
                <label>Tarea</label>
                <input type="text" name="tarea" placeholder="${tarea.nombre ? 'Edita la Tarea' : 'Añadir Tarea al Proyecto Actual'}" id="tarea" value="${tarea.nombre ? tarea.nombre : ''}"/>
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" value="${tarea.nombre ? 'Guardar Cambios' : 'Añadir Tarea'}"/>
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
    `;
    
    setTimeout(() => {
         const formulario = document.querySelector('.formulario');
         formulario.classList.add('animar');
    }, 0);

    modal.addEventListener('click', function(e){
        e.preventDefault();

        if(e.target.classList.contains('cerrar-modal')){//contains: verifica que el elemnto html contenga cerrar-modal
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('cerrar');    

             setTimeout(() => {
                modal.remove();
            }, 500);
        }

        if(e.target.classList.contains('submit-nueva-tarea')){//contains: verifica que el elemnto html contenga cerrar-modal
            submitFormularioNuevaTarea();

        }
    })

    document.querySelector('.dashboard').appendChild(modal);
}

    function submitFormularioNuevaTarea(){
        const tarea = document.querySelector('#tarea').value.trim();//trim: elimini el espacio al inicio y al final

        if(tarea === ''){
            //Mostrar una alerta de error
            mostrarAlerta('El nombre de la tarea es Obligatorio', 'error', document.querySelector('.formulario legend'));
            return;
        }

        agregarTarea(tarea);
    
    }
    
    //Muestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia){

        //Previene la creacion de multiples alertas
        const alertaPrevia = document.querySelector('.alerta');

        if(alertaPrevia){
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        //Inserta la alerta antes del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        //Eliminar la alerta despues de unos segundos
        setTimeout(() => {
            alerta.remove();
        }, 5000);

    }

    //Consultar el servidor para añadir una nueva tarea al proyecto actual
    async function agregarTarea(tarea){
      //Construir la peticion
       const datos = new FormData();
        datos.append('nombre', tarea);        
        datos.append('proyectoId', obtenerProyecto());        

        try{
            const url = 'http://localhost:3000/api/tarea';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos

            });
           const resultado = await respuesta.json();

           mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector('.formulario legend'));
            
           if(resultado.tipo === 'exito'){
                const modal = document.querySelector('.modal');
                setTimeout(() => {
                    modal.remove();
                }, 1000);  

                //Agregar el objeto de tarea al global de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: "0",
                    proyectoId: resultado.proyectoId
                }

                tareas =[...tareas, tareaObj];//tengo una copia de las tareas, y le agrega la nueva tarea                
                mostrarTareas();
            }

        } catch(error) {
            console.log(error);
            
        }
    }

    function cambiarEstadoTarea(tarea){

        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;
        actualizarTarea(tarea);
    }

    async function actualizarTarea(tarea){
        const {estado, id, nombre} = tarea;

        const datos = new FormData;
        datos.append('id',id);
        datos.append('nombre',nombre);
        datos.append('estado',estado);
        datos.append('proyectoId',obtenerProyecto());

        // for(let valor of datos.values()){ para poder ver los datos en el formdata antes de enviar al servidor
        //     console.log(valor);
        // }
        try {
            const url = 'http://localhost:3000/api/tarea/actualizar';  
            const respuesta =  await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();
            
            if(resultado.respuesta.tipo === 'exito'){
                mostrarAlerta(
                    resultado.respuesta.mensaje, 
                    resultado.respuesta.tipo, 
                    document.querySelector('.contenedor-nueva-tarea')
                );

                tareas = tareas.map(tareaMemoria =>{//map crea un arreglo ya con la actualizacion
                    if(tareaMemoria.id === id){
                        tareaMemoria.estado = estado;
                    }
                    return tareaMemoria;
                });
                mostrarTareas();   
            }
             
        } catch (error) {
            console.log(error);
            
        }
    }

    function confirmarEliminarTarea(tarea){
        Swal.fire({
            title: "Eliminar Tarea?",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
          });
    }
    async function eliminarTarea(tarea) {
        const {estado, id, nombre} = tarea;

        const datos = new FormData;
        datos.append('id',id);
        datos.append('nombre',nombre);
        datos.append('estado',estado);
        datos.append('proyectoId',obtenerProyecto());

        try {
            const url = 'http://localhost:3000/api/tarea/eliminar';  
            const respuesta =  await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if(resultado.resultado){
                // mostrarAlerta(
                //     resultado.mensaje, 
                //     resultado.tipo, 
                //     document.querySelector('.contenedor-nueva-tarea')
                // );
                Swal.fire('Eliminado!', resultado.mensaje, 'success');

                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);//genera una copia y solo trae todas que sean diferentes al id que seleccione
                mostrarTareas();
            }
            
        } catch (error) {
            console.log(error);
            
        }
    }

    function obtenerProyecto(){
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());//sirve para iterar objetos como el formdata/entries trae los datos del obje
        return proyecto.id;
    }


    function limpiarTareas(){
        const listadoTareas = document.querySelector('#listado-tareas');
        // listadoTareas.innerHTML = '';

        while(listadoTareas.firstChild){
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }



    