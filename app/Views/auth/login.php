<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>
<form action="/login" method="POST">
    <?php if (session()->getFlashdata('err-login')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('err-login') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($validation)) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="inputUsername" class="form-label">Username</label>
        <input type="text" class="form-control" id="inputUsername" name="username" value="<?= set_value('username') ?>">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="password" value="<?= set_value('password') ?>">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?= $this->endSection() ?>