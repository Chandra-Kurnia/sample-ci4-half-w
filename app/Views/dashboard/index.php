<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>
<h1>Welcome back <?= session()->get('username') ?></h1>
<h1><?= session()->get('role_name') ?></h1>
<img src="<?= session()->get('image') ?>" alt="profile pic">
<form action="/logout" method="post">
    <button type="submit">logout</button>
</form>
<?= $this->endSection() ?>