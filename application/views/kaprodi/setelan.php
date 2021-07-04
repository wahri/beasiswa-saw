<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Pengaturan Akun</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">NIDN</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" name="user_id" value="<?= $this->session->userdata('user_id'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" value="<?= $user['nama'] ?>">
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_lama">
                                <?= form_error('password_lama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password1">
                                <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password2">
                                <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <button type="Submit" class="btn btn-primary float-right">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </main>