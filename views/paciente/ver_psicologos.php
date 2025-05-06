<?php
session_start();
require_once __DIR__ . '/../../config.php';

try {
    $pdo = conectarDB();
    
    // Obtener el nombre del paciente
    $obtener_paciente = $pdo->query("SELECT * FROM pacientes WHERE id = 1");
    $paciente = $obtener_paciente->fetchAll();
    if(!empty($paciente)) {
        $_SESSION['paciente'] = [
            'nombre' => $paciente[0]['nombre'],
            'email' => $paciente[0]['email']];
    }

    // Obtener todos los médicos
    $obtener_medicos = $pdo->query("SELECT * FROM medicos");
    $medicos = $obtener_medicos->fetchAll();

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
                <h1 class="text-center">Bienvenido, <?= htmlspecialchars($_SESSION['paciente']['nombre'])?></h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <?php foreach ($medicos as $medico):?>
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