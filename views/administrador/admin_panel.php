<?php
require_once __DIR__ . '/../../config.php';

try {
    $pdo = conectarDB();

    // Ejemplo de consulta
    $stmt = $pdo->query("SELECT * FROM medicos LIMIT 2");
    $resultados = $stmt->fetchAll();

    foreach ($resultados as $fila) {
        print_r($fila);
        echo "<br>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/*

Depende de la función obtenerTurnos() y actualizarEstadoTurno()

require_once('../datos/modelo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $turno_id = (int)$_POST['turno_id'];

    if (isset($_POST['marcar_atendido'])) {
        actualizarEstadoTurno($turno_id, 'atendido');
    } elseif (isset($_POST['marcar_cancelado'])) {
        actualizarEstadoTurno($turno_id, 'cancelado');
    }
}

$turnos = obtenerTurnos();

*/
?>

<!-- HEADER -->
<?php include __DIR__ . '/../header.php' ?>

<header>
    <?php include 'navbar_admin.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row m-5">
            <div class="col-12">
                <h2 class="text-center">Panel de Turnos</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table border="1" cellpadding="8" class="table">
                    <tr>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($turnos as $turno): ?>
                        <tr>
                            <td><?= htmlspecialchars($turno['paciente']) ?></td>
                            <td><?= htmlspecialchars($turno['medico']) ?></td>
                            <td><?= htmlspecialchars($turno['especialidad']) ?></td>
                            <td><?= htmlspecialchars($turno['fecha']) ?></td>
                            <td><?= htmlspecialchars($turno['hora']) ?></td>
                            <td><?= ucfirst(htmlspecialchars($turno['estado'])) ?></td>
                            <td>
                                <?php if ($turno['estado'] === 'pendiente'): ?>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="turno_id" value="<?= $turno['id'] ?>">
                                        <button type="submit" name="marcar_atendido">Marcar como atendido</button>
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="turno_id" value="<?= $turno['id'] ?>">
                                        <button type="submit" name="marcar_cancelado">Cancelar turno</button>
                                    </form>
                                <?php elseif ($turno['estado'] === 'atendido'): ?>
                                    ✔ Atendido
                                <?php elseif ($turno['estado'] === 'cancelado'): ?>
                                    ✘ Cancelado
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-2 p-3 text-center">
                    <button type="submit" class="btn btn-primary">
                        <a href="agregar_medico.php" class="text-light text-decoration-none">Agregar nuevo médico</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include __DIR__ . '/../footer.php' ?>