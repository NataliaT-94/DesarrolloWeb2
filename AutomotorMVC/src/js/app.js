document.addEventListener('DOMContentLoaded', function(){
    console.log('dom');


    eventListeners();
    darkMode();
    previewImagenVehiculo();

});

// function darkMode(){
//     const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

//     //console.log(prefiereDarkMode.matches);para saber la preferencia del usuario modoOscuro o CLaro
    
//     if(prefiereDarkMode.matches){
//         document.body.classList.add('dark-mode');
//     } else {
//         document.body.classList.remove('dark-mode');
//     }

//     prefiereDarkMode.addEventListener('change', function(){//preferencia automatica
//         if(prefiereDarkMode.matches){
//             document.body.classList.add('dark-mode');
//         } else {
//             document.body.classList.remove('dark-mode');
//         }
//     });

//     const botonDarkMode = document.querySelector('.dark-mode-boton');

//     botonDarkMode.addEventListener('click', function(){
//         document.body.classList.toggle('dark-mode');//agrega la clase dark-mode al body cuando hace click en la luna
//     });

// }

function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    const body = document.body;

    // 1. Leer tema guardado
    const themeGuardado = localStorage.getItem('theme');

    if (themeGuardado === 'dark') {
        body.classList.add('dark-mode');
    } else if (themeGuardado === 'light') {
        body.classList.remove('dark-mode');
    } else {
        // 2. Si no hay tema guardado, usar preferencia del sistema
        const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
        if (prefiereDarkMode.matches) {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    }

    // 3. Botón para cambiar tema
    botonDarkMode.addEventListener('click', function () {
        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
}


function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    //Mostrar campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', seleccionarMetodo));
    
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

function seleccionarMetodo(e) {
    const contactoDiv = document.querySelector('#contacto');



    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono"  name="contacto[telefono]" required>

            <p>Elija la fecha y la hora</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]" required>

        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }

}

function previewImagenVehiculo() {
    const inputImagen = document.querySelector('#imagen');
    const preview = document.querySelector('#preview-imagen');

    if (!inputImagen || !preview) return;

    inputImagen.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Validar que sea imagen
        if (!file.type.startsWith('image/')) {
            alert('El archivo debe ser una imagen');
            inputImagen.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
}
