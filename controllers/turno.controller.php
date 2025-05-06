<?php
session_start();
require_once __DIR__ . '/../models/turno.model.php';
require_once __DIR__ . '/../models/paciente.model.php';
require_once __DIR__ . '/../models/medico.model.php';
require_once __DIR__ . '/../config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

$turnoModel = new Turno();

switch ($action) {
    case 'solicitar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_paciente = $_POST['id_paciente'] ?? null;
            $id_medico = $_POST['id_medico'] ?? null;
            $fecha = $_POST['fecha'] ?? '';
            $hora = $_POST['hora'] ?? '';
            $mensaje = '';
            $status = 'error';
            
            $nombreMedico = $_POST['nombre_medico'] ?? '';
            $especialidadMedico = $_POST['especialidad_medico'] ?? '';

            if (empty($id_paciente) || empty($id_medico) || empty($fecha) || empty($hora)) {
                $mensaje = "Todos los campos son obligatorios (paciente, médico, fecha, hora).";
            } elseif (strtotime($fecha) < strtotime(date('Y-m-d'))) {
                $mensaje = "La fecha del turno no puede ser anterior a la fecha actual.";
            } else {
                try {
                    if ($turnoModel->existeTurno($id_medico, $fecha, $hora)) {
                        $mensaje = "El turno seleccionado ya no está disponible. Por favor, elija otro horario.";
                    } elseif ($turnoModel->add($id_paciente, $id_medico, $fecha, $hora)) {
                        $mensaje = "Turno solicitado con éxito.";
                        $status = 'success';
                    } else {
                        $mensaje = "Error al solicitar el turno.";
                    }
                } catch (PDOException $e) {
                    $mensaje = "Error de base de datos al solicitar el turno: " . $e->getMessage();
                }
            }
            
            if ($status == 'success') {
                 header("Location: ../views/paciente/ver_psicologos.php?status=" . $status . "&msg=" . urlencode($mensaje));
            } else {
                 $redirect_url = "../views/paciente/solicitar_turno.php?medico_id={$id_medico}&nombre=" . urlencode($nombreMedico) . "&especialidad=" . urlencode($especialidadMedico) . "&status=" . $status . "&msg=" . urlencode($mensaje);
                 if (isset($_POST['fecha'])) $redirect_url .= "&fecha_original=" . urlencode($_POST['fecha']);
                 if (isset($_POST['hora'])) $redirect_url .= "&hora_original=" . urlencode($_POST['hora']);
                 header("Location: " . $redirect_url);
            }
            exit;
        }
        break;

    case 'marcar_atendido':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_turno = $_POST['turno_id'] ?? null;
            if ($id_turno) {
                try {
                    $turnoModel->marcarAtendido($id_turno);
                    header("Location: ../views/administrador/admin_panel.php?status=success&msg=" . urlencode("Turno marcado como atendido."));
                    exit;
                } catch (PDOException $e) {
                    header("Location: ../views/administrador/admin_panel.php?status=error&msg=" . urlencode("Error de BD al marcar atendido."));
                    exit;
                }
            }
            header("Location: ../views/administrador/admin_panel.php?status=error&msg=" . urlencode("ID de turno no proporcionado."));
            exit;
        }
        break;

    case 'cancelar_admin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_turno = $_POST['turno_id'] ?? null;
            if ($id_turno) {
                 try {
                    $turnoModel->cancelar($id_turno);
                    header("Location: ../views/administrador/admin_panel.php?status=success&msg=" . urlencode("Turno cancelado."));
                    exit;
                } catch (PDOException $e) {
                    header("Location: ../views/administrador/admin_panel.php?status=error&msg=" . urlencode("Error de BD al cancelar turno."));
                    exit;
                }
            }
            header("Location: ../views/administrador/admin_panel.php?status=error&msg=" . urlencode("ID de turno no proporcionado para cancelar."));
            exit;
        }
        break;
    
    default:
        break;
}
?>