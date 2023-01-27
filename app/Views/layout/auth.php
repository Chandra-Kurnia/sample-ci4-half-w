<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<div class="container d-flex align-items-center justify-content-center h-100">
    <div class="card w-50">
        <div class="card-header">
            Login
        </div>
        <div class="card-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>