<?= $this->extend('templates/base') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="welcome-message mt-4">
        <h3>Dashboard</h3>
        <p class="text-muted">Bienvenido al panel de control, <span class="text-primary"><?= session('username'); ?></span>. Aquí puedes ver un resumen de las actividades recientes.</p>
    </div>

    <div class="row g-4">
        <!-- Card Constancias -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                <div class="fs-2 fw-bold counter" data-target="<?= $recordsCount ?>">0</div>
                <div class="text-muted">Constancias generadas</div>
                </div>
                <div class="text-primary fs-1">
                <i class="bi bi-file-earmark-text-fill"></i>
                </div>
            </div>
            </div>
        </div>

        <!-- Card Usuarios -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                <div class="fs-2 fw-bold counter" data-target="<?= $usersCount ?>">0</div>
                <div class="text-muted">Usuarios registrados</div>
                </div>
                <div class="text-success fs-1">
                <i class="bi bi-people-fill"></i>
                </div>
            </div>
            </div>
        </div>

        <!-- Card Trabajadores -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                <div class="fs-2 fw-bold counter" data-target="<?= $employeeCount ?>">0</div>
                <div class="text-muted">Trabajadores activos</div>
                </div>
                <div class="text-warning fs-1">
                <i class="bi bi-person-badge-fill"></i>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4 shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title">Gráfica</h5>
                        <select id="rangeSelector" class="form-select select-sm">
                            <option value="daily">Últimos 7 días</option>
                            <option value="two-weeks">Últimos 15 días</option>
                            <option value="month">Últimos 30 días</option>
                            <option value="monthly">Últimos 6 meses</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="recordsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-4 shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-1">
                        <h5 class="card-title">Constancias por tipo</h5>
                    </div>
                    <div class="chart-container">
                        <canvas id="recordsByTypeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('assets/js/homeCharts.js') ?>"></script>
    <script src="<?= base_url('assets/js/homeCounter.js') ?>"></script>
<?= $this->endSection() ?>
