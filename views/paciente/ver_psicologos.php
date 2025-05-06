<?php
session_start();
require_once __DIR__ . '/../../models/paciente.model.php';
require_once __DIR__ . '/../../models/medico.model.php';

$mensaje_turno = '';
$status_class_turno = '';
if (isset($_GET['msg'])) {
    $mensaje_turno = htmlspecialchars($_GET['msg']);
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        $status_class_turno = 'alert alert-success';
    } else {
        $status_class_turno = 'alert alert-danger';
    }
}

try {
    $pacienteModel = new Paciente();
    $emailPaciente = 'juan.lopez@gmail.com'; 

    $pacienteInfo = $pacienteModel->getByEmail($emailPaciente);
    if (!empty($pacienteInfo)) {
        $_SESSION['paciente'] = [
            'id' => $pacienteInfo['id'],
            'nombre' => $pacienteInfo['nombre'],
            'email' => $pacienteInfo['email']
        ];
    } else {
        if (!isset($_SESSION['paciente'])) {
             die("Error: Paciente no encontrado. Por favor, asegúrate de que el paciente 'juan.lopez@gmail.com' existe en la base de datos o implementa un sistema de login.");
        }
    }

    $medicoModel = new Medico();
    $medicosInfo = $medicoModel->getAll();

} catch (PDOException $e) {
    die("Error de conexión con la base de datos: " . $e->getMessage());
}
?>

<?php include __DIR__ . '/../header.php' ?>

<header>
    <?php include 'navbar_paciente.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h1 class="text-center">Bienvenido, <?= isset($_SESSION['paciente']['nombre']) ? htmlspecialchars($_SESSION['paciente']['nombre']) : "Invitado" ?></h1>
            </div>
        </div>

        <?php if ($mensaje_turno): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="<?= $status_class_turno ?>" role="alert">
                        <?= $mensaje_turno ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if (empty($medicosInfo)): ?>
                <div class="col-12">
                    <p class="text-center">No hay médicos disponibles en este momento.</p>
                </div>
            <?php else: ?>
                <?php foreach ($medicosInfo as $medico): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex align-items-stretch justify-content-center">
                        <div class="card" style="width: 100%;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($medico["nombre"]) ?></h5>
                                <h6 class="card-subtitle mb-3 text-body-secondary">
                                    <?= htmlspecialchars($medico["especialidad"]) ?></h6>
                                <div class="mt-auto">
                                    <a href="solicitar_turno.php?medico_id=<?= $medico['id'] ?>&nombre=<?= urlencode($medico['nombre']) ?>&especialidad=<?= urlencode($medico['especialidad']) ?>"
                                        class="btn btn-primary w-100">Solicitar turno</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ .  '/../footer.php' ?>