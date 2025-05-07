<?php
session_start();
require_once 'config.php';
$role = $_GET['role'] ?? null;
$action = $_GET['action'] ?? 'dashboard';

if ($role) {
  switch ($role) {
    case 'admin':
      require_once 'controllers/admin.controller2.php';
      $controller = new AdminController();
      switch ($action) {
        case 'dashboard':
          $controller->dashboard();
          break;
        case 'nuevo_medico':
          $controller->mostrarFormularioMedico();
          break;
        case 'guardar_medico':
          $controller->guardarMedico();
          break;
        default:
          echo "Acción no reconocida";
          break;
      }

    case 'paciente':
      // require_once 'controllers/paciente.controller.php';
      break;

    default:
      echo "Rol no válido.";
  }
  exit;
}
?>
<?php include __DIR__ . '/views/layouts/header.php' ?>
<main class="container mt-5">
  <h1 class="text-center">Simulador de Turnos</h1>
  <div class="d-grid gap-2 col-6 mx-auto mt-5">
    <a href="?role=admin" class="btn btn-primary">Administrador</a>
    <!-- <a href="?role=medico" class="btn btn-success">Medico</a> -->
    <a href="?role=paciente" class="btn btn-secondary">Paciente</a>
  </div>
</main>
<?php include __DIR__ . '/views/layouts/footer.php' ?>