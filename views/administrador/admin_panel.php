<?php
// AÑADIDO: proteger el acceso directo
if (!isset($turnoInfo)) {
    header('Location: ../../controllers/admin.controller.php');
    exit;
}
?>

<?php include __DIR__ . '/../header.php'; ?>

<header>
    <?php include 'navbar_admin.php'; ?>
</header>

<section>
    <div class="container-fluid">
        <div class="row m-3">
            <div class="col-12">
                <h1 class="text-center">Panel de Turnos</h1>
            </div>
        </div>

        <?php if ($mensaje_panel): ?>
            <div class="row justify-content-center mb-3">
                <div class="col-md-8">
                    <div class="<?= $status_class_panel ?>" role="alert">
                        <?= $mensaje_panel ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Paciente</th>
                            <th>Médico</th>
                            <th>Especialidad</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($turnoInfo)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No hay turnos registrados.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($turnoInfo as $turno): ?>
                                <tr>
                                    <td><?= htmlspecialchars($turno['nombre_paciente']) ?></td>
                                    <td><?= htmlspecialchars($turno['nombre_medico']) ?></td>
                                    <td><?= htmlspecialchars($turno['especialidad']) ?></td>
                                    <td><?= htmlspecialchars(date("d/m/Y", strtotime($turno['fecha']))) ?></td>
                                    <td><?= htmlspecialchars(date("H:i", strtotime($turno['hora']))) ?></td>
                                    <td>
                                        <?php 
                                            $estado_texto = ucfirst(htmlspecialchars($turno['estado']));
                                            $estado_clase = '';
                                            switch ($turno['estado']) {
                                                case 'pendiente': $estado_clase = 'badge bg-warning text-dark'; break;
                                                case 'atendido':  $estado_clase = 'badge bg-success'; break;
                                                case 'cancelado': $estado_clase = 'badge bg-danger'; break;
                                                default: $estado_clase = 'badge bg-secondary'; break;
                                            }
                                        ?>
                                        <span class="<?= $estado_clase ?>"><?= $estado_texto ?></span>
                                    </td>
                                    <td>
                                        <?php if ($turno['estado'] === 'pendiente'): ?>
                                            <form method="POST" action="../../controllers/turno.controller.php" style="display:inline-block; margin-bottom: 5px;">
                                                <input type="hidden" name="turno_id" value="<?= $turno['id'] ?>">
                                                <input type="hidden" name="action" value="marcar_atendido">
                                                <button type="submit" class="btn btn-sm btn-success">Atendido</button>
                                            </form>
                                            <form method="POST" action="../../controllers/turno.controller.php" style="display:inline-block;">
                                                <input type="hidden" name="turno_id" value="<?= $turno['id'] ?>">
                                                <input type="hidden" name="action" value="cancelar_admin">
                                                <button type="submit" class="btn btn-sm btn-danger">Cancelar</button>
                                            </form>
                                        <?php elseif ($turno['estado'] === 'atendido'): ?>
                                            <span class="text-success">✔ Atendido</span>
                                        <?php elseif ($turno['estado'] === 'cancelado'): ?>
                                            <span class="text-danger">✘ Cancelado</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="mb-2 p-3 text-center">
                    <a href="admin.controller.php?view=agregar_medico" class="btn btn-primary">Agregar nuevo médico</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php'; ?>
