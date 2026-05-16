<?php
namespace clientepc\kesto\Controllers;

use clientepc\kesto\Models\Usuarios;

$accion = $_GET['accion'] ?? $_POST['accion'] ?? 'view';

switch ($accion) {

    case 'view':
        $title = 'Iniciar Sesión';
        require_once __DIR__ . '/../Views/Login.php';
        break;

    case 'login':
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            $usuario = new Usuarios();
            $login = $usuario->login($_POST['usuario'], $_POST['clave']);

            if ($login) {
                $_SESSION['id']     = $login['id'];
                $_SESSION['nombre'] = $login['nombre'];
                $rolData            = $usuario->searchRol($_POST['usuario']);
                $_SESSION['rol']    = $rolData ? $rolData['rol_nombre'] : '';
                header('Location: ?c=home&accion=view');
            } else {
                header('Location: ?c=login&accion=view&error=1');
            }
            exit();
        }
        header('Location: ?c=login&accion=view&error=2');
        exit();

    case 'logout':
        session_destroy();
        header('Location: ?c=login&accion=view');
        exit();

    default:
        http_response_code(404);
        require_once __DIR__ . '/../Views/errors/404.php';
        break;
}
