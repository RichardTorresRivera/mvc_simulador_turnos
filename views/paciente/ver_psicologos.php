<?php

?>
<header>
    <?php include 'navbar_paciente.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <h1 class="text-center">Bienvenido, Usuario</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Médico</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Especialidad</h6>
                        <button class="btn btn-primary">
                            <a href="paciente/solicitar_turno.php" class="text-light">Ver Psicólogos</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>