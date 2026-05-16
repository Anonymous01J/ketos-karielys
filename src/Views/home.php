<!DOCTYPE html>
<html lang="es">
<?php require_once __DIR__ . '/../complements/head.php'; ?>
<?php require_once __DIR__ . '/../complements/header.php'; ?>

<div class="container py-5">
    <h2 class="mb-4">Panel principal</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            Operación realizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4 d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Proveedores</h5>
                    <p class="card-text">Gestiona todos los proveedores registrados.</p>
                    <a href="?c=proveedores&accion=view" class="btn btn-primary">Ver proveedores</a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-muted">
        <small>Rol: <?= htmlspecialchars($_SESSION['rol']) ?> | <?= date('d/m/Y H:i') ?></small>
    </div>
</div>

<?php require_once __DIR__ . '/../complements/footer.php'; ?>
</body>
</html>
