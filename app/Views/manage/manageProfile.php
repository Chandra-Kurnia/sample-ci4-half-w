<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Manage Profile</h3>
            </div>
            <div class="card-body">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>