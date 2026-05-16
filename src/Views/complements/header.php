<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-2">
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <a class="navbar-brand me-4" href="?c=home&accion=view">Kesto Sistema</a>
            <span class="text-white me-3">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
            </span>
            <a href="?c=login&accion=logout" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
        </div>
    </div>
</nav>
