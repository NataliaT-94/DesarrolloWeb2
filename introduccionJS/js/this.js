//this: Hace referencia al objeto sobre el cual se esta mandando a llamar esta funcion

const reservacion = {
    nombre: 'Natalia',
    apellido: 'Techeira',
    total: 5000,
    pagado: false,
    informacion: function(){
        console.log(`El cliente ${this.nombre} reservo y su cantidad a pagar es de ${this.total}`);        
    }
}

const reservacion2 = {
    nombre: 'Evelyn',
    apellido: 'Techeira',
    total: 3000,
    pagado: false,
    informacion: function(){
        console.log(`El cliente ${this.nombre} reservo y su cantidad a pagar es de ${this.total}`);        
    }
}

reservacion.informacion();
reservacion2.informacion();
