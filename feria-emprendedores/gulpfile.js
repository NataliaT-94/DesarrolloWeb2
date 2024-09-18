// gulpfile: sirve para crear funciones
/*
export function hola(done){//colocando el export ya te da acceso para ejecutarlo con el package.json
    console.log('Hola desde Gulfile.js');
    done();// es la funcion que finaliza la ejecucion de la funcion
}*/

import {src, dest, watch, series} from 'gulp' //src: es la funcion que nos va a permitir acceder a los archivos fuentes,donde estan ubicados, dest: es donde se van a almacenar una vez que hayan sido procesados
//series: te permite ejecutar una tarea y despues otra. puedes ejecutar multiples tareas con esta funcion
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'

const sass = gulpSass(dartSass)

export function js(done){
    src('src/js/app.js')
        .pipe(dest('build/js'))

    done()
}

export function css(done){
    src('src/scss/app.scss', {sourcemaps: true})//sourcemaps: siver para generar un archivo interno para que cuando pongas inspeccionar el elemento te indique en que lina de scss esta ubicada
        .pipe( sass().on('error', sass.logError))//una vez que ubica la funcion lo ejecuta el sass. Si hay un error mostrar cual
        .pipe( dest('build/css', {sourcemaps: true}) )//luego lo almacena

    done()
}

export function dev(){
    // watch('src/scss/app.scss', css)//revia la carpeta y ejecuta la funcion css
    watch('src/scss/**/*.scss',css) //revisa todas las carpetas y archivos, si hay cambios lo ejecuta
    watch('src/js/**/*.js',js) //revisa todas las carpetas y archivos, si hay cambios lo ejecuta
}

// export default parallel(js, css, dev) // te permite ejecutar todas las funciones al mismo tiempo

export default series(js, css, dev)// package.json sector script-"dev": "gulp" // te permite ejecutar un funcion y cuando termina ejecuta la siguiente