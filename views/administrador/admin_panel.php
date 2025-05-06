<?php

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

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Panel de Turnos</h2>
    <table border="1" cellpadding="8">
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

    <br>
    <a href="agregar_medico.php">Agregar nuevo médico</a>
</body>
</html>
