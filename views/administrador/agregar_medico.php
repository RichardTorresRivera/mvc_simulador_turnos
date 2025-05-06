<?php
session_start();
$mensaje = '';
$status_class = '';
if (isset($_GET['msg'])) {
    $mensaje = htmlspecialchars($_GET['msg']);
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        $status_class = 'alert alert-success';
    } else {
        $status_class = 'alert alert-danger';
    }
}
?>

<?php include __DIR__ . '/../header.php' ?>


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

        <?php if ($mensaje): ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="<?= $status_class ?>" role="alert">
                        <?= $mensaje ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center justify-content-center">

                <div class="card" style="width: 25rem;">
                    <form method="POST" action="../../controllers/medico.controller.php">
                        <input type="hidden" name="action" value="agregar">
                        
                        <div class="mb-2 p-3">
                            <label class="form-label">Nombre del médico:</label>
                            <input type="text" name="nombre" class="form-control border border-dark" placeholder="Juan Perez" required>
                        </div>

                        <div class="mb-2 p-3">
                            <label class="form-label">Especialidad:</label>
                            <input type="text" name="especialidad" class="form-control border border-dark" placeholder="Medicina general" required>
                        </div>

                        <div class="mb-2 p-3 text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
                
                <div class="row my-5">
                    <div class="col-12">
                        <div class="mb-2 p-3 text-center">
                            <button type="button" class="btn btn-danger" onclick="window.location.href='admin_panel.php'">
                                Volver al panel de turnos
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../footer.php' ?>