<?php
namespace clientepc\kesto\Controllers;

use clientepc\kesto\Models\Proveedores;

if (!isset($_SESSION['id'])) {
    header('Location: ?c=login&accion=view');
    exit();
}

$accion = $_GET['accion'] ?? $_POST['accion'] ?? 'view';

switch ($accion) {

    case 'view':
        $title              = 'Proveedores';
        $proveedor          = new Proveedores();
        $proveedores        = $proveedor->search();
        $proveedoresInactive = $proveedor->searchInactive();
        require_once __DIR__ . '/../Views/proveedores.php';
        break;

    case 'add':
        if (
            isset($_POST['razonSocial'])     &&
            isset($_POST['nombreC'])         &&
            isset($_POST['telefonoPrncpl'])
        ) {
            $proveedor = new Proveedores();
            $proveedor->setRazonSocial($_POST['razonSocial'])
                      ->setNombreC($_POST['nombreC'])
                      ->setTelefonoPrncpl($_POST['telefonoPrncpl'])
                      ->setTelefonoScndr($_POST['telefonoScndr'] ?? null)
                      ->setCorreo($_POST['correo'] ?? null);

            if ($proveedor->insert()) {
                header('Location: ?c=proveedores&accion=view&success=1');
            } else {
                header('Location: ?c=proveedores&accion=view&error=1');
            }
        } else {
            header('Location: ?c=proveedores&accion=view&error=2');
        }
        exit();

    case 'edit':
        if (
            isset($_POST['id_proveedor'])   &&
            isset($_POST['nombreC'])        &&
            isset($_POST['telefonoPrncpl'])
        ) {
            $proveedor = new Proveedores();
            $proveedor->setIdProveedor($_POST['id_proveedor'])
                      ->setRazonSocial($_POST['razonSocial'] ?? null)
                      ->setNombreC($_POST['nombreC'])
                      ->setTelefonoPrncpl($_POST['telefonoPrncpl'])
                      ->setTelefonoScndr($_POST['telefonoScndr'] ?? null)
                      ->setCorreo($_POST['correo'] ?? null);

            if ($proveedor->update()) {
                header('Location: ?c=proveedores&accion=view&success=1');
            } else {
                header('Location: ?c=proveedores&accion=view&error=1');
            }
        } else {
            header('Location: ?c=proveedores&accion=view&error=2');
        }
        exit();

    case 'delete':
        if (isset($_POST['id_proveedor'])) {
            $proveedor = new Proveedores();
            $proveedor->setIdProveedor($_POST['id_proveedor']);
            if ($proveedor->delete()) {
                header('Location: ?c=proveedores&accion=view&success=1');
            } else {
                header('Location: ?c=proveedores&accion=view&error=1');
            }
        } else {
            header('Location: ?c=proveedores&accion=view&error=2');
        }
        exit();

    case 'active':
        if (isset($_POST['id_proveedor'])) {
            $proveedor = new Proveedores();
            $proveedor->setIdProveedor($_POST['id_proveedor']);
            if ($proveedor->active()) {
                header('Location: ?c=proveedores&accion=view&success=1');
            } else {
                header('Location: ?c=proveedores&accion=view&error=1');
            }
        } else {
            header('Location: ?c=proveedores&accion=view&error=2');
        }
        exit();

    default:
        http_response_code(404);
        require_once __DIR__ . '/../Views/errors/404.php';
        break;
}
