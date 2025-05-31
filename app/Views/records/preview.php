<?= $this->extend('templates/base') ?>
<?= $this->section('title') ?>Vista previa<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Vista previa de la constancia</h3>

    <p><strong>Nombre completo:</strong> <?= esc($data['nombre_completo']) ?></p>
    <p><strong>Cédula:</strong> <?= esc($data['cedula']) ?></p>
    <p><strong>Fecha de ingreso:</strong> <?= esc($data['fecha_ingreso']) ?></p>
    <p><strong>Nivel:</strong> <?= esc($data['nivel']) ?></p>
    <p><strong>Cargo/Funciones:</strong> <?= esc($data['cargo_funciones']) ?></p>
    <p><strong>Código del cargo:</strong> <?= esc($data['codigo_cargo']) ?></p>
    <p><strong>Dependencia:</strong> <?= esc($data['dependencia']) ?></p>
    <p><strong>Código dependencia:</strong> <?= esc($data['codigo_dependencia']) ?></p>
    <p><strong>Sueldo mensual:</strong> <?= esc($data['sueldo_mensual']) ?></p>

    <form method="post" action="<?= site_url('records/store') ?>" class="mb-2">
        <?= csrf_field(); ?>
        <?php foreach ($data as $key => $value): ?>
            <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success">Generar PDF y Guardar</button>
    </form>
    <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= site_url('records/create/' . $slug) ?>'">Editar</button>
    
    <?php
    /*
    <form method="post" action="<?= site_url('records/create/' . $slug) ?>">
        <?= csrf_field(); ?>
        <?php foreach ($data as $key => $value): ?>
            <input type="hidden" name="<?= esc($key) ?>" value="<?= esc($value) ?>">
        <?php endforeach; ?>
        <button type="submit" class="btn btn-secondary">Editar</button>
    </form>
            <a href="<?= site_url('records/create/' . $slug) ?>" class="btn btn-secondary">Editar</a>
    <form method="get" action="<?= site_url('records/create/' . $slug) ?>">
        <button type="submit" class="btn btn-secondary">Editar2</button>
    </form>
    */ 
    ?>
</div>

<?= $this->endSection() ?>