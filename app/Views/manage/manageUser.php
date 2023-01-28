<?= $this->extend('layout/dashboard') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>Manage User</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <?php if (session()->get('role_name') === 'superuser') : ?>
                                <th scope="col">Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($allUser)) : ?>
                            <?php $i = 1 ?>
                            <?php foreach ($allUser as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $i++ ?></th>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['role_name'] ?></td>
                                    <td><?= $user['status'] ?></td>
                                    <?php if (session()->get('role_name') === 'superuser') : ?>
                                        <td>
                                            ubah status, hapus user, ubah role, edit
                                            <form action="/manageUser/get/<?= $user['user_id'] ?>" method="get">
                                                <button class="btn btn-primary">Edit</button>
                                            </form>
                                            <form action="/manageUser/delete/<?= $user['user_id'] ?>" method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    <?php endif ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12 mt-sm-3 mt-lg-0">
        <div class="card">
            <div class="card-header">
                <h3><?= isset($userEdit) ? 'Update User' : 'Add User' ?></h3>
            </div>
            <div class="card-body">
                <?php if (isset($validation)) : ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                <form action="/manageUser/add" method="post">
                    <!-- <input type="hidden" name="_method" value="put"> -->
                    <div class="row">

                        <div class="col-2 d-flex align-items-center">
                            <span class="form-text">Username</span>
                        </div>
                        <div class="col-10 d-flex align-items-center">
                            <input type="text" class="form-control" name="username" value="<?= isset($userEdit) ? $userEdit['username'] : '' ?>">
                            <!-- <input type="hidden" value="<?= isset($userEdit) ? $userEdit['user_id'] : '' ?>"> -->
                        </div>

                        <div class="col-2 d-flex align-items-center mt-2">
                            <span class="form-text">Password</span>
                        </div>
                        <div class="col-10 d-flex align-items-center mt-2">
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="col-2 d-flex align-items-center mt-2">
                            <span class="form-text">Role</span>
                        </div>
                        <div class="col-10 d-flex align-items-center mt-2">
                            <select class="form-select" aria-label="Default select example" name="role">
                                <?php if (isset($userEdit) && $userEdit['role_id'] == '1') : ?>
                                    <option value="">--Select Role--</option>
                                    <option value="1" selected>Superuser</option>
                                    <option value="2">User</option>
                                <?php elseif (isset($userEdit) && $userEdit['role_id'] == '2') : ?>
                                    <option value="">--Select Role--</option>
                                    <option value="1">Superuser</option>
                                    <option value="2" selected>User</option>
                                <?php else : ?>
                                    <option value="" selected>--Select Role--</option>
                                    <option value="1">Superuser</option>
                                    <option value="2">User</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-2 d-flex align-items-center mt-2">
                            <span class="form-text">Status</span>
                        </div>
                        <div class="col-10 d-flex align-items-center mt-2">
                            <div class="row w-100">
                                <?php if (isset($userEdit) && $userEdit['status'] == 'active') : ?>
                                    <div class="col-3">
                                        <input type="radio" class="form-check-input" name="status" value="active" id="status_active" checked>
                                        <label for="status_active">Active</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="radio" class="form-check-input" name="status" value="notActive" id="status_not_active">
                                        <label for="status_not_active">Not Active</label>
                                    </div>
                                <?php elseif (isset($userEdit) && $userEdit['status'] == 'notActive') : ?>
                                    <div class="col-3">
                                        <input type="radio" class="form-check-input" name="status" value="active" id="status_active">
                                        <label for="status_active">Active</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="radio" class="form-check-input" name="status" value="notActive" id="status_not_active" checked>
                                        <label for="status_not_active">Not Active</label>
                                    </div>
                                <?php else : ?>
                                    <div class="col-3">
                                        <input type="radio" class="form-check-input" name="status" value="active" id="status_active">
                                        <label for="status_active">Active</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="radio" class="form-check-input" name="status" value="notActive" id="status_not_active">
                                        <label for="status_not_active">Not Active</label>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-2 d-flex align-items-center mt-2">
                        </div>
                        <div class="col-10 d-flex align-items-center mt-2">
                            <button type="submit" class="btn btn-primary w-100"><?= isset($userEdit) ? 'Update User' : 'Save User' ?></button>
                        </div>
                        <?php if (isset($userEdit)) : ?>
                            <div class="col-2 d-flex align-items-center mt-2">
                            </div>
                            <div class="col-10 d-flex align-items-center mt-2">
                                <a href="/manageUser" class="btn btn-danger w-100">Batal</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>