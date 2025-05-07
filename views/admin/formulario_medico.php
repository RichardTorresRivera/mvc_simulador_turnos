<?php include __DIR__ . '/../layouts/header.php'; ?>
<main>
  <div class="container">
    <div class="row my-5">
      <div class="col-12">
        <h1 class="text-center">Agregar Nuevo Médico</h1>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-12 d-flex flex-column align-items-center justify-content-center">
        <div class="card" style="width: 25rem;">
          <form action="index.php?role=admin&action=guardar_medico" method="POST" class="mt-4">
            <div class="mb-2 p-3">
              <label class="form-label" for="nombre">Nombre del médico:</label>
              <input type="text" name="nombre" class="form-control border border-dark" placeholder="Nombre del medico" id="nombre" required>
            </div>

            <div class="mb-2 p-3">
              <label class="form-label" for="especialidad">Especialidad:</label>
              <input type="text" name="especialidad" class="form-control border border-dark" placeholder="Escribe una especialidad" id="especialidad" required>
            </div>

            <div class="mb-2 p-3 text-center">
              <button type="submit" class="btn btn-success">Guardar</button>
              <a href="index.php?role=admin" class="btn btn-secondary">Cancelar</a>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
</main>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
