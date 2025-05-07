<?php
require_once 'models/turno.model.php';
require_once 'models/medico.model.php';
require_once 'assets/Flash.php';

class AdminController {
  private $turnoModel;
  private $medicoModel;
  
  public function __construct() {
    $this->turnoModel = new Turno();
    $this->medicoModel = new Medico();
  }

  public function dashboard() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $turno_id = $_POST['turno_id'] ?? null;
      $action = $_POST['action'] ?? null;

      if ($turno_id && $action) {
        if ($action === 'marcar_atendido') {
          $this->turnoModel->marcarAtendido($turno_id);
          Flash::set("El turno fue marcado como atendido", 'success');
        } elseif ($action === 'cancelar_admin') {
          $this->turnoModel->cancelar($turno_id);
          Flash::set("El turno fue cancelado", 'warning');
          
        }
        header("Location: ?role=admin");
        exit;
      }
    }
    $mensaje_flash = Flash::get();

    $turnos = $this->turnoModel->getAll();
    require 'views/admin/dashboard.php';
  }

  public function mostrarFormularioMedico() {
    require 'views/admin/formulario_medico.php';
  }

  public function guardarMedico() {
    $nombre = $_POST['nombre'] ?? null;
    $especialidad = $_POST['especialidad'] ?? null;

    if ($nombre) {
      $this->medicoModel->add($nombre, $especialidad);
      Flash::set("Médico agregado exitosamente.", 'success');
      header("Location: index.php?role=admin");
      exit;
    } else {
      Flash::set("Faltan datos obligatorios.", 'error');
      header("Location: index.php?role=admin&action=nuevo_medico");
      exit;
    }
  }
}