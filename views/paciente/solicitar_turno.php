<?php
session_start();

if (!isset($_SESSION['paciente']['id'])) {
    die("Acceso no autorizado. Debes iniciar sesión como paciente.");
}

$id_paciente_session = $_SESSION['paciente']['id'];

$medico_id = isset($_GET['medico_id']) ? htmlspecialchars($_GET['medico_id']) : null;
$nombreMedico = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : "Nombre no disponible";
$especialidadMedico = isset($_GET['especialidad']) ? htmlspecialchars($_GET['especialidad']) : "Especialidad no disponible";

if (!$medico_id) {
    die("Error: No se especificó el médico.");
}

$mensaje_form = '';
$status_class_form = '';
if (isset($_GET['msg'])) {
    $mensaje_form = htmlspecialchars($_GET['msg']);
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        $status_class_form = 'alert alert-success';
    } else {
        $status_class_form = 'alert alert-danger';
    }
}
$fecha_original = $_GET['fecha_original'] ?? '';
$hora_original = $_GET['hora_original'] ?? '';

?>

<?php include __DIR__ . '/../header.php' ?>

<header>
    <?php include 'navbar_paciente.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h1 class="text-center">Solicitar turno</h1>
            </div>
        </div>

        <?php if ($mensaje_form): ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="<?= $status_class_form ?>" role="alert">
                        <?= $mensaje_form ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 d-flex align-items-center justify-content-center">
                <div class="card" style="width: 100%;">
                    <div class="mt-2 px-3 py-2">
                        <h5 class="card-title"><?= $nombreMedico ?></h5>
                        <h6 class="card-subtitle mb-3 text-body-secondary"><?= $especialidadMedico ?></h6>
                    </div>
                    <form method="POST" action="../../controllers/turno.controller.php">
                        <input type="hidden" name="action" value="solicitar">
                        <input type="hidden" name="id_paciente" value="<?= $id_paciente_session ?>">
                        <input type="hidden" name="id_medico" value="<?= $medico_id ?>">
                        <input type="hidden" name="nombre_medico" value="<?= htmlspecialchars($nombreMedico) ?>">
                        <input type="hidden" name="especialidad_medico" value="<?= htmlspecialchars($especialidadMedico) ?>">

                        <div class="mb-2 px-3 py-2">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control border border-dark" id="fecha" name="fecha" 
                                   min="<?= date('Y-m-d') ?>" value="<?= htmlspecialchars($fecha_original) ?>" required>
                        </div>
                        <div class="mb-2 px-3 py-2">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control border border-dark" id="hora" name="hora" value="<?= htmlspecialchars($hora_original) ?>" required>
                        </div>
                        
                        <div class="mb-2 p-2 text-center">
                            <button type="submit" class="btn btn-primary">
                                Crear Turno
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12">
                <div class="mb-2 p-3 text-center">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='ver_psicologos.php'">
                        Regresar a ver Psicólogos
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ .  '/../footer.php' ?>