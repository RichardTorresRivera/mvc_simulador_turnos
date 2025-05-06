<?php
session_start();
require_once __DIR__ . '/../../models/paciente.model.php';
require_once __DIR__ . '/../../models/medico.model.php';

try {
    // Obtener el nombre del paciente
    $pacienteModel = new Paciente();
    $emailPaciente = 'juan.lopez@gmail.com';

    $pacienteInfo = $pacienteModel->getByEmail($emailPaciente);
    if(!empty($pacienteInfo)) {
        $_SESSION['pacienteInfo'] = [
            'nombre' => $pacienteInfo['nombre'],
            'email' => $pacienteInfo['email']];
    }

    // Obtener todos los médicos
    $medicoModel = new Medico();
    $medicosInfo = $medicoModel->getAll();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- HEADER -->
<?php include '../header.php' ?>

<!-- VER PSICÓLOGOS -->
<header>
    <?php include 'navbar_paciente.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <h1 class="text-center">Bienvenido, <?= htmlspecialchars($_SESSION['pacienteInfo']['nombre'])?></h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach ($medicosInfo as $medico):?>
                <div class="col-4 mb-3 d-flex align-items-center justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($medico["nombre"])?></h5>
                            <h6 class="card-subtitle mb-3 text-body-secondary"><?= htmlspecialchars($medico["especialidad"])?></h6>
                            <button class="btn btn-primary">
                                <a href="solicitar_turno.php" class="text-light text-decoration-none">Solicitar turno</a>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include '../footer.php' ?>