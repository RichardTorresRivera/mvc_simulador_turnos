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

<header>
    <?php include 'navbar_admin.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <h2 class="text-center">Agregar Nuevo Médico</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center justify-content-center">

                <div class="card" style="width: 25rem;">
                    <form method="POST">
                        <div class="mb-2 p-3">
                            <label class="form-label">Nombre del médico:</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-2 p-3">
                            <label class="form-label">Especialidad:</label>
                            <input type="text" name="especialidad" class="form-control" required>
                        </div>

                        <div class="mb-2 p-3 text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>

                <?php if ($mensaje): ?>
                    <p><strong><?= $mensaje ?></strong></p>
                <?php endif; ?>
                
                <div class="row my-5">
                    <div class="col-12">
                        <div class="mb-2 p-3 text-center">
                            <button type="submit" class="btn btn-danger">
                                <a href="admin_panel.php" class="text-light text-decoration-none">Volver al panel de turnos</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>