<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<div class="container-fluid bg-dark">
    <div class="row">
        <div class="col-sm-auto bg-light sticky-top">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <img src="<?= session()->get('image') ?>" alt="hugenerd" width="40" height="40" class="rounded-circle">
                </a>
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li>
                        <a href="/" class="nav-link py-3 px-2" data-toggle="tooltip" data-placement="right" title="Dashboard">
                            <i class="bi-speedometer2 fs-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/manageEmployees" class="nav-link py-3 px-2" data-toggle="tooltip" data-placement="right" title="Manage Employees data">
                            <i class="bi-table fs-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/manageUser" class="nav-link py-3 px-2" data-toggle="tooltip" data-placement="right" title="Manage User Data">
                            <i class="bi-people fs-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/manageProfile" class="nav-link py-3 px-2" data-toggle="tooltip" data-placement="right" title="Manage Profile">
                            <i class="bi-person-circle h2"></i>
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            <button type="submit" class="nav-link py-3 px-2" data-toggle="tooltip" data-placement="right" title="Logout">
                                <i class="bi bi-power fs-1"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm p-3 min-vh-100">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>