// Async / await

function descargarNuevosClientes(){
    return new Promise( resolve => {
        console.log('Descargando clientes... espere...');
        
    setTimeout(() => {//simula una descarga del servidor
        resolve('Los Clientes fueron descargados');
    }, 5000);
    
    });
}


function descargarUltimosPedisos(){
    return new Promise( resolve => {
        console.log('Descargando pedidos... espere...');
        
    setTimeout(() => {//simula una descarga del servidor
        resolve('Los Pedidos fueron descargados');
    }, 3000);
    
    });
}//una sola consulta async
async function app(){ 
    try{
        const resultado = await descargarNuevosClientes();//esperando a que la descarga finalize
        console.log(resultado);        
    }catch (error){
        console.log(error);
        
    }
}

//cuando tenemos mas de una consulta async

async function app(){ 
    try{
        const resultado = await Promise.all([descargarNuevosClientes(), descargarUltimosPedisos()]);
        console.log(resultado[0]);        
        console.log(resultado[1]);        
    }catch (error){
        console.log(error);
        
    }
}


app();

console.log('Este codigo no se bloquea');// no hace falta que espere a que se termine de descargar los datos de los clientespara para poder ejecutarse
