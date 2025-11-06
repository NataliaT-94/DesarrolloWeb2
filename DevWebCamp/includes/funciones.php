<?php

// Iniciamos sesión al comienzo (previene errores de headers)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

/**
 * Detecta si la página actual coincide con el path indicado
 * Funciona correctamente incluso si la app está en un subdirectorio
 */
function pagina_actual($path) : bool {
    // Obtener la ruta actual sin query string
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

    // Normalizar base de la app (por si está en subdirectorio)
    $base = rtrim(app_base(), '/'); // devuelve '/' o '/subdir'
    if ($base !== '') {
        // Quitamos el prefijo base si existe
        if (str_starts_with($uri, $base)) {
            $uri = substr($uri, strlen($base));
            if ($uri === '') {
                $uri = '/';
            } else {
                $uri = '/' . ltrim($uri, '/');
            }
        }
    }

    // Asegurar que $path empieza con /
    $path = '/' . ltrim($path, '/');

    // Comparamos la ruta actual con la solicitada
    return $uri === $path;
}

function is_auth() : bool {
    return isset($_SESSION['nombre']) && !empty($_SESSION['nombre']);
}

function is_admin() : bool {
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() : void {
    $efectos = ['fade-up', 'fade-down', 'fade-left', 'fade-right', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];
    $efecto = array_rand($efectos, 1);
    echo 'data-aos="' . $efectos[$efecto] . '" ';
}

function app_base(): string {
    $scriptDir = str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $scriptDir = rtrim($scriptDir, '/');
    return ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';
}

function url_to(string $path = ''): string { 
    return app_base() . ltrim($path, '/'); 
}

function redirect(string $path = ''): void { 
    header('Location: ' . url_to($path)); 
    exit; 
}