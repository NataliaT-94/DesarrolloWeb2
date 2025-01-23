const { src, dest, watch , parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const avif = require('gulp-avif');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))        
        .pipe(sourcemaps.write('.'))
        .pipe( dest('./public/build/css') );

}

function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))      
      .pipe(dest('./public/build/js'))
      
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('./public/build/img'))
        // .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('./public/build/img'))
        // .pipe(notify({ message: 'Imagen Completada'}));
}

// function versionAvif() {
//     return src(paths.imagenes)
//         .pipe(avif({ quality: 50 })) // Configura la calidad del AVIF
//         .pipe(dest('./public/build/img'))
//         // .pipe(notify({ message: 'Imagen AVIF generada' }));
// }

function watchArchivos() {
    watch( paths.scss, css );
    watch( paths.js, javascript );
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
    // watch( paths.imagenes, versionAvif );
}
  
exports.default = parallel(css, javascript,  imagenes, versionWebp, watchArchivos );
exports.build = parallel(css, javascript,  imagenes, versionWebp);