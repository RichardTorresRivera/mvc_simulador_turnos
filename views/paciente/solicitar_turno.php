<!-- HEADER -->
<?php include '../header.php' ?>

<!-- SOLICITAR TURNO -->
<header>
    <?php session_start();
    include 'navbar_paciente.php'; ?>
</header>

<section>
    <div class="container">
        <div class="row my-5">
            <div class="col-12">
                <h1 class="text-center">Solicitar turno</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4 d-flex align-items-center justify-content-center">
                <div class="card" style="width: 25rem;">
                    <h5 class="card-title"><?= htmlspecialchars($medico["nombre"]) ?></h5>
                    <h6 class="card-subtitle mb-3 text-body-secondary"><?= htmlspecialchars($medico["especialidad"]) ?>
                    </h6>
                    <form>
                        <div class="mb-2 p-3">
                            <label for="exampleInputEmail1" class="form-label">Fecha</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-2 p-3">
                            <label for="exampleInputPassword1" class="form-label">Hora</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-2 p-3 text-center">
                            <button type="submit" class="btn btn-primary">
                                <a href="paciente/ver_psicologos.php" class="text-light text-decoration-none">Crear</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-12">
                <div class="mb-2 p-3 text-center">
                    <button type="submit" class="btn btn-danger">
                        <a href="ver_psicologos.php" class="text-light text-decoration-none">
                            Regresar
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include '../footer.php' ?>