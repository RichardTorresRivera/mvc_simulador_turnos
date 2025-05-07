<?php
class Flash {
    public static function set($mensaje, $tipo = 'success') {
        $_SESSION['flash_mensaje'] = $mensaje;
        $_SESSION['flash_tipo'] = $tipo;
    }

    public static function get() {
        $mensaje = $_SESSION['flash_mensaje'] ?? null;
        $tipo = $_SESSION['flash_tipo'] ?? 'info';

        // Limpiar para que no se repita
        unset($_SESSION['flash_mensaje'], $_SESSION['flash_tipo']);

        if (!$mensaje) return null;

        // Bootstrap alert classes
        $clases = [
            'success' => 'alert alert-success',
            'warning' => 'alert alert-warning',
            'error'   => 'alert alert-danger',
            'info'    => 'alert alert-info'
        ];

        $class = $clases[$tipo] ?? $clases['info'];

        return ['mensaje' => $mensaje, 'clase' => $class];
    }
}
