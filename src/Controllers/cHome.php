<?php
namespace clientepc\kesto\Controllers;

use clientepc\kesto\Models\Proveedores;

$accion = $_GET['accion'] ?? $_POST['accion'] ?? 'view';

switch ($accion) {

    case 'view':
        if (!isset($_SESSION['id'])) {
            require_once __DIR__ . '/../Views/Login.php';
            exit();
        }
        $title = 'Inicio';
        require_once __DIR__ . '/../Views/home.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: ?c=login');
        exit();

    default:
        http_response_code(404);
        require_once __DIR__ . '/../Views/errors/404.php';
        break;
}
