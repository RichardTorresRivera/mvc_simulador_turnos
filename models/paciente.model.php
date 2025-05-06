<?php
require_once './config.php';

class Paciente {
    private $conn;

    public function __construct() {
        $this->conn = conectarDB();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM pacientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM pacientes WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($nombre, $email) {
        $stmt = $this->conn->prepare("INSERT INTO pacientes (nombre, email) VALUES (?, ?)");
        return $stmt->execute([$nombre, $email]);
    }
}
?>