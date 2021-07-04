<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Kriteria</h1>
            <hr>
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="id_kriteria" class="col-sm-2 col-form-label">Kode kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="id_kriteria" name="id_kriteria" value="<?= $kriteria['id_kriteria'] ?>">
                        <small><?= form_error('id_kriteria') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="nama_kriteria" value="<?= $kriteria['nama_kriteria'] ?>">
                    </div>
                </div>
                <?php
                if ($kriteria['jenis_pertanyaan'] == "Pilihan") :
                ?>
                    <?php
                    $q = "SELECT * FROM pilihan_kriteria where id_kriteria ='" . $kriteria['id_kriteria'] . "'";
                    $cek = $this->db->query($q)->result_array();
                    // print_r($cek);
                    // die;
                    if ($cek) :
                        foreach ($cek as $c) :
                    ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="pilihan">Urutan</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="urutan[]" name="urutan[]" value="<?= $c['urutan'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <label for="pilihan">Nama Pilihan</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="nama_pilihan[]" name="nama_pilihan[]" value="<?= $c['nama_pilihan'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <a href="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label for="pilihan">Urutan</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="urutan[]" name="urutan[]" value="0" readonly>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <label for="pilihan">Nama Pilihan</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="nama_pilihan[]" name="nama_pilihan[]" placeholder="Nama pilihan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tambahbaris"></div>
                        <input type="button" class="btn btn-secondary" value="Tambah Baris" onclick="tambah_baris()" />
                    <?php endif; ?>
                <?php else : ?>
                    <?php
                    $q = "SELECT * FROM input_kriteria where id_kriteria ='" . $kriteria['id_kriteria'] . "'";
                    $cek = $this->db->query($q)->result_array();
                    // print_r($cek);
                    // die;
                    if ($cek) :
                        foreach ($cek as $c) :
                    ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-1">
                                        <label for="pilihan">Urutan</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="urutan[]" name="urutan[]" value="<?= $c['urutan'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="pilihan">Rentang terkecil</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="min[]" name="min[]" value="<?= $c['min'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="pilihan">Rentang terbesar</label>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="max[]" name="max[]" value="<?= $c['max'] ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-2">
                                        <label for="hapus">&nbsp;</label>
                                        <div class="input-group mb-2">
                                            <a href="<?= base_url('kaprodi/hapuspertanyaan/') . $kriteria['id_kriteria'] . "/" . $c['urutan'] ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-1">
                                    <label for="pilihan">Urutan</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="urutan[]" name="urutan[]" value="0" readonly>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="pilihan">Rentang terkecil</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="min[]" name="min[]" placeholder="Angka terkecil">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="pilihan">Rentang terbesar</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="max[]" name="max[]" placeholder="Angka terbesar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tambahbarisinput"></div>
                        <input type="button" class="btn btn-success" value="Tambah Baris" onclick="tambah_baris_input()" />
                    <?php endif; ?>
                <?php endif; ?>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="<?= base_url('kaprodi/datakriteria') ?>" type="submit" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </main>