const { src, dest, watch, parallel } = require('gulp');

// --- SCSS / CSS ---
const dartSass   = require('sass');
const gulpSass   = require('gulp-sass')(dartSass);
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const cssnano    = require('cssnano');

// --- JS ---
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');

// --- Imágenes ---
const imagemin = require('gulp-imagemin');
const cache    = require('gulp-cache');
const webp     = require('gulp-webp');
const avif     = require('gulp-avif');

// --- Paths ---
const paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  imagenes: 'src/img/**/*'
};

// --- Funciones ---
function css() {
  return src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(gulpSass().on('error', gulpSass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/build/css'));
}

function javascript() {
  return src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(concat('bundle.js'))
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/build/js'));
}

function imagenes() {
  return src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest('./public/build/img'));
}

function versionWebp() {
  return src(paths.imagenes)
    .pipe(webp())
    .pipe(dest('./public/build/img'));
}

function versionAvif() {
  return src(paths.imagenes)
    .pipe(avif({ quality: 50 }))
    .pipe(dest('./public/build/img'));
}

function watchArchivos() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
  watch(paths.imagenes, versionAvif);
}

// --- Export ---
exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.webp = versionWebp;
exports.avif = versionAvif;
exports.default = parallel(css, javascript, imagenes, versionWebp, versionAvif, watchArchivos);