<!DOCTYPE html>
<html lang="es">
<?php require_once __DIR__ . '/../complements/head.php'; ?>
<?php require_once __DIR__ . '/../complements/header.php'; ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Gestión de Proveedores</h3>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            + Nuevo Proveedor
        </button>
    </div>

    <!-- Alertas -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            Operación realizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $_GET['error'] == 2 ? 'Faltan campos obligatorios.' : 'Ocurrió un error. Intenta de nuevo.' ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#activos" type="button">Activos</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#inactivos" type="button">Inactivos</button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- ── Tab Activos ─────────────────────────────────────────── -->
        <div class="tab-pane fade show active" id="activos">
            <div class="table-responsive">
                <table class="table-DT table table-striped">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>Contacto</th>
                            <th>Tel. Principal</th>
                            <th>Tel. Secundario</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proveedores as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['razon_social']) ?></td>
                                <td><?= htmlspecialchars($p['nombreC']) ?></td>
                                <td><?= htmlspecialchars($p['telefono_prncpl']) ?></td>
                                <td><?= htmlspecialchars($p['telefono_scndr'] ?? '') ?></td>
                                <td><?= htmlspecialchars($p['correo'] ?? '') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditar<?= $p['id_proveedor'] ?>">
                                        Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar<?= $p['id_proveedor'] ?>">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="modalEditar<?= $p['id_proveedor'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="?c=proveedores&accion=edit" method="POST">
                                            <input type="hidden" name="id_proveedor" value="<?= $p['id_proveedor'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Proveedor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Razón Social</label>
                                                    <input type="text" name="razonSocial" class="form-control"
                                                           value="<?= htmlspecialchars($p['razon_social']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Contacto</label>
                                                    <input type="text" name="nombreC" class="form-control"
                                                           value="<?= htmlspecialchars($p['nombreC']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tel. Principal</label>
                                                    <input type="text" name="telefonoPrncpl" class="form-control"
                                                           value="<?= htmlspecialchars($p['telefono_prncpl']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tel. Secundario</label>
                                                    <input type="text" name="telefonoScndr" class="form-control"
                                                           value="<?= htmlspecialchars($p['telefono_scndr'] ?? '') ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Correo</label>
                                                    <input type="email" name="correo" class="form-control"
                                                           value="<?= htmlspecialchars($p['correo'] ?? '') ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Eliminar -->
                            <div class="modal fade" id="modalEliminar<?= $p['id_proveedor'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="?c=proveedores&accion=delete" method="POST">
                                            <input type="hidden" name="id_proveedor" value="<?= $p['id_proveedor'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmar eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Inhabilitar a <strong><?= htmlspecialchars($p['razon_social']) ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ── Tab Inactivos ───────────────────────────────────────── -->
        <div class="tab-pane fade" id="inactivos">
            <div class="table-responsive">
                <table class="table-DT table table-striped">
                    <thead>
                        <tr>
                            <th>Razón Social</th>
                            <th>Contacto</th>
                            <th>Tel. Principal</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proveedoresInactive as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['razon_social']) ?></td>
                                <td><?= htmlspecialchars($p['nombreC']) ?></td>
                                <td><?= htmlspecialchars($p['telefono_prncpl']) ?></td>
                                <td><?= htmlspecialchars($p['correo'] ?? '') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalActivar<?= $p['id_proveedor'] ?>">
                                        Activar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Activar -->
                            <div class="modal fade" id="modalActivar<?= $p['id_proveedor'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="?c=proveedores&accion=active" method="POST">
                                            <input type="hidden" name="id_proveedor" value="<?= $p['id_proveedor'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmar activación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Habilitar a <strong><?= htmlspecialchars($p['razon_social']) ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Activar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- ── Modal Agregar ──────────────────────────────────────────────────── -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?c=proveedores&accion=add" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Razón Social <span class="text-danger">*</span></label>
                        <input type="text" name="razonSocial" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre de Contacto <span class="text-danger">*</span></label>
                        <input type="text" name="nombreC" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tel. Principal <span class="text-danger">*</span></label>
                        <input type="text" name="telefonoPrncpl" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tel. Secundario</label>
                        <input type="text" name="telefonoScndr" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../complements/footer.php'; ?>
</body>
</html>
