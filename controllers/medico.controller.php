<?php
session_start();
require_once __DIR__ . '/../models/medico.model.php';
require_once __DIR__ . '/../config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

$medicoModel = new Medico();

switch ($action) {
    case 'agregar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $especialidad = trim($_POST['especialidad'] ?? '');
            $mensaje = '';
            $status = 'error';

            if (empty($nombre) || empty($especialidad)) {
                $mensaje = "El nombre y la especialidad son obligatorios.";
            } else {
                try {
                    if ($medicoModel->add($nombre, $especialidad)) {
                        $mensaje = "Médico agregado correctamente.";
                        $status = 'success';
                    } else {
                        $mensaje = "Error al agregar el médico. Es posible que ya exista o haya un problema con la base de datos.";
                    }
                } catch (PDOException $e) {
                    $mensaje = "Error de base de datos al agregar el médico.";
                }
            }
            header("Location: ../views/administrador/agregar_medico.php?status=" . $status . "&msg=" . urlencode($mensaje));
            exit;
        }
        break;
    
    default:
        break;
}

?>