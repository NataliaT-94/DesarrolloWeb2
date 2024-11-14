import path from 'path';
import fs from 'fs';

import { src, dest, watch, parallel } from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import concat from 'gulp-concat';
import postcss from 'gulp-postcss';
import rename from 'gulp-rename';
import cssnano from 'cssnano';
import terser from 'gulp-terser-js';
import imagemin from 'gulp-imagemin';
import notify from 'gulp-notify';
import cache from 'gulp-cache';
import webp from 'gulp-webp';
import sourcemaps from 'gulp-sourcemaps';
import log from 'fancy-log';
import sharp from 'sharp';
import { glob } from 'glob';


const sass = gulpSass(dartSass);


export function css(done) {
    src('src/scss/app.scss', {sourcemaps: true})
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(postcss([autoprefixer()]))
        .pipe(dest('./public/build/css'), {sourcemaps: '.'});

    done()
}

    export function javascript(done) {
        src(['src/js/modernizr.js', 'src/js/app.js'], { sourcemaps: true })
            .pipe(concat('bundle.js'))
            .pipe(terser())
            .pipe(rename({ suffix: '.min' }))
            .pipe(dest('./public/build/js', { sourcemaps: '.' }));
        done();
    }
    

 export function imagenes(done) {
    src('src/img/**/*')
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('./public/build/img'))
        .pipe(notify('Imagen Completada' ));

    done()
}


export function versionWebp(done) {
    src('src/img/**/*')
        .pipe(webp())
        .pipe(dest('./public/build/img'))
        .pipe(notify({ message: 'Imagen Completada' }));

    done()
}




export function dev(){
    watch('src/scss/**/*.scss',css) 
    watch('src/js/**/*.js',javascript)  
    watch('src/img/**/*', imagenes) 
    watch('src/img/**/*', versionWebp) 
}

export default parallel(css, javascript, imagenes, versionWebp, dev); 