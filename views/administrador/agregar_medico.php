<?php
/*

Depende de la función agregarMedico()

require_once('../datos/modelo.php');
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';

    $resultado = agregarMedico($nombre, $especialidad);
    if ($resultado) {
        $mensaje = "Médico agregado correctamente.";
    } else {
        $mensaje = "Error al agregar el médico.";
    }
    
}
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Médico</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <h2>Agregar Nuevo Médico</h2>
    <form method="POST">
        <label>Nombre del médico:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Especialidad:</label>
        <input type="text" name="especialidad" required><br><br>

        <button type="submit">Agregar</button>
    </form>

    <?php if ($mensaje): ?>
        <p><strong><?= $mensaje ?></strong></p>
    <?php endif; ?>

    <a href="admin_panel.php">Volver al panel de turnos</a>
</body>
</html>
