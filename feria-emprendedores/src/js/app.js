document.addEventListener('DOMContentLoaded', function(){
    navegacionFija();
    crearGaleria();
    resaltarEnlace();
    scrollNav();
})

function navegacionFija(){
    const header = document.querySelector('.header');
    const sobreFestival = document.querySelector('.sobre-festival');

    document.addEventListener('scroll', function(){
        if(sobreFestival.getBoundingClientRect().bottom < 1){//cuando se muestre sobrefestival en pantalla
            header.classList.add('fixed')//agregar la clase fixed
        } else{ 
            header.classList.remove('fixed')
        }
    })

}

function crearGaleria(){

    const CANTIDAD_IMAGENES = 16;
    const galeria = document.querySelector('.galeria-imagenes');

    for(let i = 1; i <= CANTIDAD_IMAGENES; i++){
      const imagen = document.createElement('IMG')
      imagen.src = `src/img/galeria/imagen${i}.jpg`
      imagen.alt = 'Imagen Galeria'

      // Event Handler

      imagen.onclick = function(){
        mostrarImagen(i)
      }

      galeria.appendChild(imagen)
        
    }
}

function mostrarImagen(i){
    const imagen = document.createElement('IMG')
    imagen.src = `src/img/galeria/imagen${i}.jpg`
    imagen.alt = 'Imagen Galeria'

    // Generar Modal

    const modal = document.createElement('DIV')
    modal.classList.add('modal')
    modal.onclick = cerrarModal //no hace falta colocar function porq no lleva parametro 

    // Boton cerrar modal
    const cerrarModalBtn = document.createElement('BUTTON')
    cerrarModalBtn.textContent = 'X'
    cerrarModalBtn.classList.add('btn-cerrar')
    cerrarModalBtn.onclick = cerrarModal

    modal.appendChild(imagen)
    modal.appendChild(cerrarModalBtn)

    // Agregar al HTML

    const body = document.querySelector('body')
    body.classList.add('overflow-hidden')
    body.appendChild(modal)
}

function cerrarModal(){
    const modal = document.querySelector('.modal')
    modal.classList.add('fade-out')
    

    setTimeout(()=>{
        modal?.remove()//el ? indica que si es que existe modal remover

        const body = document.querySelector('body')
        body.classList.remove('overflow-hidden')
    }, 500);
}

function resaltarEnlace(){
    document.addEventListener('scroll', function(){
        const sections = document.querySelectorAll('section')
        const navLinks = document.querySelectorAll('.navegacion-principal a')

        let actual = '';

        sections.forEach( section => {
            const sectionTop = section.offsetTop//mide la distancia que hay entre los section y el elemento padre (body)
            const sectionHeight = section.clientHeight//mide la altura en px de cada section

            if(window.scrollY >= (sectionTop - sectionHeight / 3)){//detectamos que secion ocupa mas espacio en pantalla
                actual = section.id
            }
        })

        navLinks.forEach( link => {
            link.classList.remove('active');
            if(link.getAttribute('href') === '#' + actual){
                link.classList.add('active');
            }
        })
    })
}

function scrollNav(){
    const navLinks = document.querySelectorAll('.navegacion-principal a')

    navLinks.forEach ( link => {
        link.addEventListener('click', e => {
            e.preventDefault()
            const sectionScroll = e.target.getAttribute('href')
            const section = document.querySelector(sectionScroll)

            section.scrollIntoView({behavior: 'smooth'})

        })
    })
}