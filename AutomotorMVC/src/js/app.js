document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkMode();

});

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    //console.log(prefiereDarkMode.matches);para saber la preferencia del usuario modoOscuro o CLaro
    
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function(){//preferencia automatica
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');//agrega la clase dark-mode al body cuando hace click en la luna
    });

}

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    /** 
    if(navegacion.classList.contains('mostrar')){//sinavegacion tiene la class mostrar
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
*/
    navegacion.classList.toggle('mostrar');

}