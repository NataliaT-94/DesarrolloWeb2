import path from 'path'
import fs from 'fs'

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
import sharp from 'sharp'
import { glob } from 'glob';


const sass = gulpSass(dartSass);

// const { src, dest, watch, series, parallel } = require('gulp');
// const sass = require('gulp-sass')(require('sass'));
// const autoprefixer = require('autoprefixer');
// const postcss = require('gulp-postcss')
// const sourcemaps = require('gulp-sourcemaps')
// const cssnano = require('cssnano');
// const concat = require('gulp-concat');
// const terser = require('gulp-terser-js');
// const rename = require('gulp-rename');
// const imagemin = require('gulp-imagemin'); // Minificar imagenes 
// const notify = require('gulp-notify');
// const cache = require('gulp-cache');
// const clean = require('gulp-clean');
// const webp = require('gulp-webp');


export function css(done) {
    src('src/scss/app.scss', {sourcemaps: true})
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        // .pipe(postcss([autoprefixer()]))
        .pipe(dest('build/css'), {sourcemaps: '.'});

    done()
}

export function javascript(done) {
    src('src/js/modernizr.js', 'src/js/app.js')
      .pipe(concat('bundle.js'))
      .pipe(terser())
    //   .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('build/js'))

    done()
}

 export function imagenes(done) {
    src('src/img/**/*')
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('build/img'))
        .pipe(notify('Imagen Completada' ));

    done()
}


export function versionWebp(done) {
    src('src/img/**/*')
        .pipe(webp())
        .pipe(dest('build/img'))
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