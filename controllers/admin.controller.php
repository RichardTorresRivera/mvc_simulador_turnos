<?php
session_start();
require_once __DIR__ . '/../models/turno.model.php';

$mensaje_panel = '';
$status_class_panel = '';
$mensaje = '';
$status_class = '';

if (isset($_GET['msg'])) {
    $mensaje_panel = htmlspecialchars($_GET['msg']);
    $status_class_panel = (isset($_GET['status']) && $_GET['status'] === 'success')
        ? 'alert alert-success' 
        : 'alert alert-danger';
    $mensaje = htmlspecialchars($_GET['msg']);
    $status_class = (isset($_GET['status']) && $_GET['status'] === 'success')
        ? 'alert alert-success' 
        : 'alert alert-danger';
}

$view = $_GET['view'] ?? 'panel';

switch ($view) {
    case 'agregar_medico':
        include __DIR__ . '/../views/administrador/agregar_medico.php';
        break;

    case 'panel':
    default:
        try {
            $turnoModel = new Turno();
            $turnoInfo = $turnoModel->getAll();
        } catch (PDOException $e) {
            die("Error de conexión con la base de datos: " . $e->getMessage());
        }
        include __DIR__ . '/../views/administrador/admin_panel.php';
        break;
}
