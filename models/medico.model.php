<?php
require_once __DIR__ . '/../config.php';

class Medico {
    private $conn;

    public function __construct() {
        $this->conn = conectarDB();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM medicos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM medicos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEspecialidad($especialidad) {
        $stmt = $this->conn->prepare("SELECT * FROM medicos WHERE especialidad = ?");
        $stmt->execute([$especialidad]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($nombre, $especialidad) {
        $stmt = $this->conn->prepare("INSERT INTO medicos (nombre, especialidad) VALUES (?, ?)");
        return $stmt->execute([$nombre, $especialidad]);
    }
}
?>