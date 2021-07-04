<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Kriteria</h1>
            <hr>
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="id_kriteria" class="col-sm-2 col-form-label">Kode kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="id_kriteria" value="<?= $kriteria['id_kriteria'] ?>">
                        <small class="form-text text-danger"><?= form_error('id_kriteria') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?= $kriteria['nama_kriteria'] ?>">
                        <small class="form-text text-danger"><?= form_error('nama_kriteria') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judul_kriteria" class="col-sm-2 col-form-label">Judul Kriteria</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul_kriteria" name="judul_kriteria" value="<?= $kriteria['judul_kriteria'] ?>">
                        <small class="form-text text-danger"><?= form_error('judul_kriteria') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Bobot</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bobot" name="bobot" value="<?= $kriteria['bobot'] ?>">
                        <small class="form-text text-danger"><?= form_error('bobot') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Benefit/Cost</label>
                    <div class="col-sm-10">
                        <select name="bc" id="bc" class="form-control">
                            <?php if ($kriteria['b/c'] == "b") {
                                $bc = "Benefit";
                            } else {
                                $bc = "Cost";
                            } ?>
                            <option value="<?= $kriteria['b/c'] ?>"><?= $bc ?></option>
                            <option value="b">Benefit</option>
                            <option value="c">Cost</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('bc') ?></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bobot" class="col-sm-2 col-form-label">Jenis Pertanyaan</label>
                    <div class="col-sm-10">
                        <select name="jenis_pertanyaan" id="jenis_pertanyaan" class="form-control">
                            <option value="<?= $kriteria['jenis_pertanyaan'] ?>"><?= $kriteria['jenis_pertanyaan'] ?></option>
                            <option value="Pilihan">Pilihan</option>
                            <option value="Input">Input</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('jenis_pertanyaan') ?></small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </main>