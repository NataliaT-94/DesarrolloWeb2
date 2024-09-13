//fetch API es el nuevo estandar

/**Igual qu Ajax te permite enviar informacion al servidor u obtener informacion de un servidor 
 * Puedes obtener un archivo local o una respuesta de un servidor(texto o json)
 * Al igualque todas las API's modernas de js utiliza Promises o tambien async / await
*/

function obtenerEmpleador(){
    const archivo = 'empleados.json'

    fetch(archivo)
        .then( resultado => {
            return resultado.json();//extraemos los datos en formato json
        })
        .then( datos => {//imprimimos los datos
            //console.log(datos);
            const {empleados} = datos;

            empleados.forEach(empleado => {
                console.log(empleado);
                console.log(empleado.id);
                console.log(empleado.nombre);
                
            });
        })
}

//fetch Api con async / await
async function obtenerEmpleador(){
    const archivo = 'empleados.json'

    const resultado = await fetch(archivo);
    const datos = await resultado.json();
    console.log(datos);
    
 
}
obtenerEmpleador();