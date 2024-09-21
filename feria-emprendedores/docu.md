# para generar el archivo package de node, donde vas colocando los datos necesarios


npm init

# o su vercion rapida, se instala automaticamnete

npm init -y

# instalar las dependencias de sass
npm i sass

# instalar gulp
 npm i --save-dev gulp

# En caso de descargar el repositorio y no tener las dependencias "node_modules" Ejecutar el siguiente comando

npm i

# comandos para compilar el sass
-En el package.json en la seccion de script- "sass": "sass --watch src/scss:dist/css";  // src/scss es donde vamos a acrear la hora de estilo, --watch es para que se ejecute automaticamente cada vez que realizamos un cambio en sass, dist/css es donde vamos a almacenar una vez que se compile.
-hacer click con el boton derecho en la carpeta feria de emprendedores y apretar en - Open in integrated terminal - 
y ejecutar el siguiente comando
- npm run sass -
- con ctrl C se detiene el compilado automatico

# gulpfile: sirve para crear funciones
-Para poder exportar la funcion, se le coloca export delante de la funcion.
-Para que el package.json reconosca 'export', despues de description colocar "type": "module" y ejecutar el sass
- En la parte de script nombramos a la funcion luego lo llamamos desde la carpeta gulp junto al nombre de la funcion. "hola": "gulp hola", ejecutamos en la terminal - npm run hola -

# Como compilar sass con gulp
import {src, dest} from 'gulp' //src: es la funcion que nos va a permitir acceder a los archivos fuentes,donde estan ubicados, dest: es donde se van a almacenar una vez que hayan sido procesados
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'

const sass = gulSass(dartSass)

# Minificar js
-En la terminal ejecutar - npm i --save-dev gulp-terser  -
-En gulpfile import terser from 'gulp-terser'
    src('src/js/app.js')
        .pipe(terser())//minificarjs
        .pipe(dest('build/js'))

    done()
}

# Crear una carpeta en la galeria de imagenes con las mismas imagenes pero mas chicas 
 
gulpfile: import path from 'path'
          import fs from 'fs'

          import sharp from 'sharp'

terminal - npm i --save-dev sharp -

# generamos imagenes webp
-Es un formato de imagenes para la web
- usa una dependencia llamada glob
- en la terminal - npm i --save-dev glob-
luego la importamos en gulpfile - import {glob} from 'glob' -

# generamos imagenes avif
-Ofrece una comprecion de imagenes muy eficiente, lo que resulta en archivos mucho mas mequeños en comparacin con otros formatos como jpeg,png y webp
-Mantiene una calidad de imagen superior
