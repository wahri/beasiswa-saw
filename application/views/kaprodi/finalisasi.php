<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Finalisasi Data</h1>
            <hr>
            <div class="row">
                <div class="col-lg-8">

                    <h3 class="h3 mt-3">Daftar Mahasiswa Penerima Beasiswa</h3>
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" width="30%">NIM</th>
                                <th scope="col" width="70%">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($mahasiswa as $mhs) :
                            ?>
                                <tr>
                                    <td><?= $mhs['nim'] ?></td>
                                    <td><?= $mhs['nama'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                    $hitung = count($cek);
                    if ($hitung > 0) :
                    ?>
                        <a href="<?= base_url('kaprodi/stoppublish') ?>" class="btn btn-danger float-right">Stop Publish</a>
                    <?php else : ?>
                        <a href="<?= base_url('kaprodi/publish') ?>" class="btn btn-success float-right">Publish</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>