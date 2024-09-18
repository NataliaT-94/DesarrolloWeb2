// gulpfile: sirve para crear funciones
/*
export function hola(done){//colocando el export ya te da acceso para ejecutarlo con el package.json
    console.log('Hola desde Gulfile.js');
    done();// es la funcion que finaliza la ejecucion de la funcion
}*/

import {src, dest, watch} from 'gulp' //src: es la funcion que nos va a permitir acceder a los archivos fuentes,donde estan ubicados, dest: es donde se van a almacenar una vez que hayan sido procesados
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'

const sass = gulpSass(dartSass)

export function css(done){
    src('src/scss/app.scss')
        .pipe( sass().on('error', sass.logError))//una vez que ubica la funcion lo ejecuta el sass. Si hay un error mostrar cual
        .pipe( dest('build/css') )//luego lo almacena

    done()
}

export function dev(){
    // watch('src/scss/app.scss', css)//revia la carpeta y ejecuta la funcion css
    watch('src/scss/**/*.scss',css) //revisa todas las carpetas y archivos, si hay cambios lo ejecuta
}