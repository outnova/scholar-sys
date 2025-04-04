<?= $this->extend('templates/base') ?>

<?= $this->section('title') ?>Inicio<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container mt-4">
        <h3 class="mb-4"><?= esc($user['username']); ?></h3>
        <p>
        Estás viendo un perfil de usuario.
        </p>
        <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary">Volver</a>
    </div>
<?= $this->endSection() ?>