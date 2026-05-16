<?php
/**
 * Front Controller
 * URL: ?c=home  →  src/Controllers/cHome.php
 * URL: ?c=home&accion=view  (el switch interno lee $_GET['accion'])
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/vendor/autoload.php';

$c = isset($_GET['c']) ? strtolower(trim($_GET['c'])) : 'home';

if (!preg_match('/^[a-z]+$/', $c)) {
    http_response_code(400);
    exit('Ruta inválida');
}

$archivoControlador = __DIR__ . '/src/Controllers/c' . ucfirst($c) . '.php';

if (file_exists($archivoControlador)) {
    require_once $archivoControlador;
} else {
    http_response_code(404);
    require_once __DIR__ . '/src/Views/errors/404.php';
}
