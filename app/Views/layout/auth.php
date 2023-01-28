<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid d-flex align-items-center justify-content-center h-100 bg-dark w-100">
    <div class="card w-25">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>