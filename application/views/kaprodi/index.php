<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <a href="" class="btn btn-warning float-right mt-4" data-toggle="modal" data-target="#reset">Reset Pendaftaran</a>

            <!-- modal reset -->
            <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ingin reset pendaftaran mahasiswa?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Anda yakin ingin menghapus semua data mahasiswa yang sudah mendaftar?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" href="<?= base_url('kaprodi/reset') ?>">Reset</a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <h5 class="mt-4">Selamat datang di halaman admin!</h5>


            <?php if ($user['berkas'] != null) : ?>
                <div class="row">
                    <div class="col-md-6 border px-3 py-3">
                        <div class="row">
                            <div class="col-lg-3">Berkas</div>
                            <hr>
                            <div class="col-lg-9">
                                <p class="card-text mb-1">: <a class="text-info" href="<?= base_url('assets/berkas/') . $user['berkas'] ?>">Download</a></p>
                                <a href="<?= base_url('kaprodi/hapusberkas') ?>" class="btn btn-danger btn-sm ml-2 text-light">Ganti Berkas</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <?php echo form_open_multipart('kaprodi/uploadberkas'); ?>
                <div class="row">
                    <div class="col-md-7 justify-content-center">
                        <div class="form-inline mt-3 border pl-4 pt-2">
                            <div class="form-group mb-2">
                                <label for="exampleFormControlFile1">Upload berkas</label>
                                <input type="file" class="form-control-file" id="berkas" name="berkas">
                            </div>
                            <button class="btn btn-primary" type="submit">Upload Berkas</button>
                        </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            $hitung = count($cek);
            if ($hitung > 0) :
            ?>
                <a href="<?= base_url('kaprodi/stoppendaftaran') ?>" class="btn btn-danger btn-xl text-uppercase mt-3 js-scroll-trigger">Tutup Pendaftaran</a>
            <?php else : ?>
                <a href="<?= base_url('kaprodi/bukapendaftaran') ?>" class="btn btn-success btn-xl text-uppercase mt-3 js-scroll-trigger">Buka Pendaftaran</a>
            <?php endif; ?>

        </div>
    </main>