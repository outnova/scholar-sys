<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
 <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3">Constancias</h1>
      <a href="<?= site_url('records/create'); ?>" class="btn btn-success btn-lg">+ Nueva Constancia</a>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recientes</h5>
            <p class="mb-1">#122 - Juan Pérez - Estudio - <span class="badge bg-success">Emitida</span></p>
            <p class="mb-0">#121 - Ana Ruiz - Retiro - <span class="badge bg-danger">Anulada</span></p>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Resumen</h5>
            <p>Total emitidas: 8</p>
            <p>Este mes: 3</p>
            <p>Más común: Estudio</p>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Buscar Constancias</h5>
            <form class="row g-2">
              <div class="col-6">
                <input type="text" class="form-control" placeholder="Nombre o Cédula">
              </div>
              <div class="col-6">
                <select class="form-select">
                  <option selected>Tipo</option>
                  <option>Estudio</option>
                  <option>Trabajo</option>
                </select>
              </div>
              <div class="col-6">
                <input type="date" class="form-control">
              </div>
              <div class="col-6">
                <input type="date" class="form-control">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-success w-100">Buscar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Historial</h5>
            <div class="table-responsive">
              <table class="table table-bordered align-middle">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>122</td>
                    <td>Juan Pérez</td>
                    <td>Estudio</td>
                    <td>2025-04-18</td>
                    <td><span class="badge bg-success">Emitida</span></td>
                    <td><button class="btn btn-sm btn-primary">Ver</button> <button class="btn btn-sm btn-outline-secondary">PDF</button></td>
                  </tr>
                  <tr>
                    <td>121</td>
                    <td>Ana Ruiz</td>
                    <td>Retiro</td>
                    <td>2025-04-15</td>
                    <td><span class="badge bg-danger">Anulada</span></td>
                    <td><button class="btn btn-sm btn-primary">Ver</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if (session()->has('pdf_data')): ?>
  <script>
      const data = <?= json_encode(session('pdf_data')) ?>;

      const csrfName = '<?= csrf_token() ?>'; // nombre del token, por defecto 'csrf_test_name'
      const csrfHash = '<?= csrf_hash() ?>';  // valor del token

      fetch("<?= site_url('records/generatePdf') ?>", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "<?= csrf_header() ?>": csrfHash
          },
          body: JSON.stringify(data),
      })
      .then(response => response.blob())
      .then(blob => {
          const url = URL.createObjectURL(blob);
          window.open(url, "_blank");
      })
      .catch(error => {
          alert("Hubo un error al generar el PDF.");
          console.error(error);
      });
  </script>
  <?php endif; ?>
<?= $this->endSection() ?>
