<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Data Kriteria</h1>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <?= form_error('nama_kriteria', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('judul_kriteria', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('bobot', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                    <?= form_error('bc', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                    <?= $this->session->flashdata('message'); ?>
                    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah Kriteria</a>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id Kriteria</th>
                                <th scope="col">Nama Kriteria</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Benefit/Cost</th>
                                <th scope="col">Jenis Pertanyaan</th>
                                <th scope="col" width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($kriteria as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $m['id_kriteria'] ?></th>
                                    <td><?= $m['nama_kriteria']; ?></td>
                                    <td><?= $m['bobot']; ?></td>
                                    <td>
                                        <?php if ($m['b/c'] == "b") {
                                            echo "Benefit";
                                        } else {
                                            echo "Cost";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $m['jenis_pertanyaan']; ?></td>
                                    <td>
                                        <a href="<?= base_url('kaprodi/tambahpertanyaan/') . $m['id_kriteria']; ?>" class="badge badge-primary">Tambah Pertanyaan</a>
                                        <a href="<?= base_url('kaprodi/editkriteria/') . $m['id_kriteria'] ?>" class="badge badge-success">Edit</a>
                                        <a href="<?= base_url('kaprodi/deletekriteria/') . $m['id_kriteria']; ?>" class="badge badge-danger">Delete</a>
                                    </td>
                                </tr>

                            <?php
                                $i++;
                            endforeach;
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Tambah Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kaprodi/datakriteria') ?>" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="id_kriteria" name="id_kriteria" value="<?= $kode ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="menu" name="nama_kriteria" placeholder="Nama Kriteria">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="menu" name="judul_kriteria" placeholder="Judul pertanyaan...">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="menu" name="bobot" placeholder="Bobot kriteria">
                        </div>
                        <div class="form-group">
                            <select name="bc" id="bc" class="form-control">
                                <option value="">Benefit/Cost</option>
                                <option value="b">Benefit</option>
                                <option value="c">Cost</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="jenis_pertanyaan" id="jenis_pertanyaan" class="form-control">
                                <option value="">Jenis Pertanyaan</option>
                                <option value="Pilihan">Pilihan</option>
                                <option value="Input">Input</option>
                            </select>
                        </div>

                        <!-- <hr>
                        <label for="pilihan">Pilihan / Range</label>
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
                        <input type="button" class="btn btn-secondary" value="Tambah Baris" onclick="tambah_baris()" /> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="Submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>