<?php
session_start();
require_once __DIR__ . '/../models/paciente.model.php';
require_once __DIR__ . '/../config.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';


switch ($action) {
    
    default:
        break;
}

?>