<?php
require_once './config.php';

class Turno {
    private $conn;

    public function __construct() {
        $this->conn = conectarDB();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM turnos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPaciente($id_paciente) {
        $stmt = $this->conn->prepare("SELECT * FROM turnos WHERE id_paciente = ?");
        $stmt->execute([$id_paciente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDisponibles($id_medico, $fecha) {
        $stmt = $this->conn->prepare("SELECT hora FROM turnos WHERE id_medico = ? AND fecha = ?");
        $stmt->execute([$id_medico, $fecha]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function existeTurno($id_medico, $fecha, $hora) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM turnos WHERE id_medico = ? AND fecha = ? AND hora = ?");
        $stmt->execute([$id_medico, $fecha, $hora]);
        return $stmt->fetchColumn() > 0;
    }

    public function add($id_paciente, $id_medico, $fecha, $hora) {
        if ($this->existeTurno($id_medico, $fecha, $hora)) {
            return false;
        }
        $stmt = $this->conn->prepare("INSERT INTO turnos (id_paciente, id_medico, fecha, hora) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_paciente, $id_medico, $fecha, $hora]);
    }

    public function marcarAtendido($id_turno) {
        $stmt = $this->conn->prepare("UPDATE turnos SET estado = 'atendido' WHERE id = ?");
        return $stmt->execute([$id_turno]);
    }

    public function estadisticasPorMedico() {
        $stmt = $this->conn->query("
            SELECT m.nombre, COUNT(t.id) as cantidad_turnos
            FROM turnos t
            JOIN medicos m ON t.id_medico = m.id
            GROUP BY t.id_medico
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>