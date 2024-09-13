const metodoPago = 'efectivo';

switch (metodoPago) {
    case 'efectivo':
        console.log('pagaste con efectivo');        
        break;
    case 'tarjeta':
        console.log('pagaste con tarjeta');        
        break;
    case 'cheque':
        console.log('el usuario va a pagar con cheque, revisaremos los fondos primero');        
        break;

    default:
        console.log('Aun no ha pagado');   
        break;
}