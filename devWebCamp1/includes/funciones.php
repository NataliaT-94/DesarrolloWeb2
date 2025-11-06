<?php

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

function pagina_actual($path) : bool{
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}


function is_auth() : bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['nombre']) && !empty($_SESSION);//validamos que exista el nombre y no este vacia la sesion
}

function is_admin() : bool{
    if(!isset($_SESSION)){
        session_start();
    }
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animacion() : void{
    $efectos = ['fade-up', 'fade-down,', 'fade-left', 'fade-right', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out',];
    $efecto = array_rand($efectos, 1);
    // echo $efectos[$efecto];
    echo 'data-aos="' . $efectos[$efecto] . '" ';
}

function app_base(): string {
    $scriptDir = str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $scriptDir = rtrim($scriptDir, '/');
    return ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';
}
function url_to(string $path = ''): string { return app_base() . ltrim($path, '/'); }
function redirect(string $path = ''): void { header('Location: ' . url_to($path)); exit; }
