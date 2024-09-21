// gulpfile: sirve para crear funciones
/*
export function hola(done){//colocando el export ya te da acceso para ejecutarlo con el package.json
    console.log('Hola desde Gulfile.js');
    done();// es la funcion que finaliza la ejecucion de la funcion
}*/
import path from 'path'
import fs from 'fs'
import {glob} from 'glob'
import {src, dest, watch, series} from 'gulp' //src: es la funcion que nos va a permitir acceder a los archivos fuentes,donde estan ubicados, dest: es donde se van a almacenar una vez que hayan sido procesados
//series: te permite ejecutar una tarea y despues otra. puedes ejecutar multiples tareas con esta funcion
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'

const sass = gulpSass(dartSass)

import terser from 'gulp-terser' //para minificar js
import sharp from 'sharp'

export function js(done){
    src('src/js/app.js')
        .pipe(terser())//minificar js
        .pipe(dest('build/js'))

    done()
}

export function css(done){
    src('src/scss/app.scss', {sourcemaps: true})//sourcemaps: siver para generar un archivo interno para que cuando pongas inspeccionar el elemento te indique en que lina de scss esta ubicada
        .pipe( sass({
            outputStyle:'compressed'//elimina todos los espacios del css
        }).on('error', sass.logError))//una vez que ubica la funcion lo ejecuta el sass. Si hay un error mostrar cual
        .pipe( dest('build/css', {sourcemaps: true}) )//luego lo almacena

    done()
}




export async function crop(done) {//creamos una carpeta en la galeria con imagenes mas chicass
    const inputFolder = 'src/img/galeria/full';
    const outputFolder = 'src/img/galeria/thumb';
    const width = 250;
    const height = 180;
    if (!fs.existsSync(outputFolder)) {
        fs.mkdirSync(outputFolder, { recursive: true })
    }
    const images = fs.readdirSync(inputFolder).filter(file => {
        return /\.(jpg)$/i.test(path.extname(file));
    });
    try {
        images.forEach(file => {
            const inputFile = path.join(inputFolder, file)
            const outputFile = path.join(outputFolder, file)
            sharp(inputFile) 
                .resize(width, height, {
                    position: 'centre'
                })
                .toFile(outputFile)
        });

        done()
    } catch (error) {
        console.log(error)
    }
}




export async function imagenes(done){//esta funcion se encarge de buscar las imagenes
    const srcDir = 'src/img';
    const buildDir = 'build/img';
    const images = await glob('./src/img/**/*{jpg,png}')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

function procesarImagenes(file, outputSubDir){// esta funcion procesa las imagenes
    if(!fs.existsSync(outputSubDir)){
        fs.mkdirSync(outputSubDir, {recursive: true})
    }

    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)
    const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
    const outputFileWebP = path.join(outputSubDir,`${baseName}.webp`)
    const outputFileAvif = path.join(outputSubDir,`${baseName}.avif`)

    const options = {quality: 80}
    sharp(file).jpeg(options).toFile(outputFile)
    sharp(file).webp(options).toFile(outputFileWebP)
    sharp(file).avif().toFile(outputFileAvif)
}

export function dev(){
    // watch('src/scss/app.scss', css)//revia la carpeta y ejecuta la funcion css
    watch('src/scss/**/*.scss',css) //revisa todas las carpetas y archivos, si hay cambios lo ejecuta
    watch('src/js/**/*.js',js) //revisa todas las carpetas y archivos, si hay cambios lo ejecuta
    watch('src/img/**/*.{png,jpg}', imagenes) //busca todas las imagenes esn la carpeta img y luego ejecutamos la funcion imagenes
}

// export default parallel(js, css, dev) // te permite ejecutar todas las funciones al mismo tiempo

export default series(crop, js, css, imagenes, dev)// package.json sector script-"dev": "gulp" // te permite ejecutar un funcion y cuando termina ejecuta la siguiente