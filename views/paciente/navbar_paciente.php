<?php

?>

<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestión de Citas</a>
        <span class="navbar-text">
            <?= htmlspecialchars($_SESSION['paciente']['nombre'])?> (<?= htmlspecialchars($_SESSION['paciente']['email'])?>)
        </span>
    </div>
</nav>