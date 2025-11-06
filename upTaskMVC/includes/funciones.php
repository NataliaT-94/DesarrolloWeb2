<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        // header('Location: /');
        header('');
    }
}

//_-----------------------------

function app_base(): string {
    $scriptDir = str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    $scriptDir = rtrim($scriptDir, '/');
    return ($scriptDir && $scriptDir !== '/') ? ($scriptDir . '/') : '/';
}
function url_to(string $path = ''): string { return app_base() . ltrim($path, '/'); }
function redirect(string $path = ''): void { header('Location: ' . url_to($path)); exit; }

