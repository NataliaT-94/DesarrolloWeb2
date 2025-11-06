<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa/ Sanitizar el HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool{
    if($actual !== $proximo){
        return true;
    }

    return false;
}

//Funcion que revisa que el usuario este autenticado
function isAuth() : void{
    if(!isset($_SESSION['login'])){
        header('');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['admin'])){//si no es un admin
        header('');
    }
}

function app_base(): string {
    $scriptDir = str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $scriptDir = rtrim($scriptDir, '/');
    return ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';
}
function url_to(string $path = ''): string { return app_base() . ltrim($path, '/'); }
function redirect(string $path = ''): void { header('Location: ' . url_to($path)); exit; }


?>