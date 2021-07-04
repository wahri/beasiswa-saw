<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Detail Mahasiswa</h1>
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="card">
                            <h5 class="card-header bg-warning">Biodata Mahasiswa</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="<?= base_url('assets/img/mahasiswa/') . $mahasiswa['foto'] ?>" alt="mahasiswa" class="img-fluid" width="200px">

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h5 class="card-title mb-0"><?= $mahasiswa['nama'] ?></h5>
                                        <span class="badge badge-secondary mb-3"><?= $mahasiswa['nim'] ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">Tempat, Tanggal lahir</div>
                                    <hr>
                                    <div class="col-lg-7">
                                        <p class="card-text">: <?= $mahasiswa['tempat_lahir'] ?>, <?= $mahasiswa['tanggal_lahir'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">Alamat</div>
                                    <hr>
                                    <div class="col-lg-7">
                                        <p class="card-text">: <?= $mahasiswa['alamat'] ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">Angkatan</div>
                                    <hr>
                                    <div class="col-lg-7">
                                        <p class="card-text">: <?= $mahasiswa['angkatan'] ?></p>
                                    </div>
                                </div>
                                <?php
                                $qInput = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Input'";
                                $input = $this->db->query($qInput)->result_array();
                                foreach ($input as $i) :
                                ?>
                                    <div class="row">
                                        <div class="col-lg-5"><?= $i['judul_kriteria'] ?></div>
                                        <hr>
                                        <div class="col-lg-7">
                                            <p class="card-text">: <?= $mahasiswa[$i['id_kriteria']] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php
                                $qPilihan = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Pilihan'";
                                $pilihan = $this->db->query($qPilihan)->result_array();
                                foreach ($pilihan as $p) :
                                ?>

                                    <div class="row">
                                        <div class="col-lg-5"><?= $p['judul_kriteria'] ?></div>
                                        <hr>
                                        <div class="col-lg-7">
                                            <p class="card-text">:
                                                <?php
                                                $opt = $this->db->get_where('pilihan_kriteria', ['id_kriteria' => $p['id_kriteria']])->result_array();
                                                $baris = count($opt) - 1;
                                                foreach ($opt as $j) :
                                                    $qrel = 'SELECT * from rel_mhs_kriteria where nim = "' . $mahasiswa['nim'] . '" AND id_kriteria = "' . $j['id_kriteria'] . '"';
                                                    $rel_mhs = $this->db->query($qrel)->row_array();
                                                    $nilai = $rel_mhs['nilai'] * $baris;
                                                ?>
                                                <?php endforeach;
                                                $isi = $this->db->get_where('pilihan_kriteria', ['urutan' => number_format($nilai), 'id_kriteria' => $p['id_kriteria']])->row_array();
                                                echo $isi['nama_pilihan'];
                                                // echo "<pre>";
                                                // print_r($rel_mhs);
                                                // echo "</pre>"; 
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                                <?php if ($mahasiswa['berkas'] != null) : ?>
                                    <div class="row">
                                        <div class="col-lg-5">Berkas</div>
                                        <hr>
                                        <div class="col-lg-7">
                                            <p class="card-text mb-1">: <a class="text-info" href="<?= base_url('assets/berkas/mahasiswa/') . $mahasiswa['berkas'] ?>">Download</a></p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="row">
                                        <div class="col-lg-5">Berkas</div>
                                        <hr>
                                        <div class="col-lg-7">
                                            <p class="card-text text-danger mb-1">: Berkas belum di upload.</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <a href="<?= base_url('kaprodi/seleksi'); ?>" class="btn btn-secondary mt-3">Back</a>
                                <a href="<?= base_url('kaprodi/accept/') . $mahasiswa['nim'] ?>" type="submit" class="btn btn-success float-right">Terima</a>
                                <a href="<?= base_url('kaprodi/banned/') . $mahasiswa['nim'] ?>" type="submit" class="btn btn-danger mr-3 float-right">Tolak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Detail Mahasiswa
            </div>
            <div class="card-body">
                <h5 class="card-title font-weight-bold"><?= $mahasiswa['nama'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $mahasiswa['nim'] ?></h6>

                <?php
                $qPilihan = "SELECT id_kriteria, judul_kriteria FROM kriteria";
                $pilihan = $this->db->query($qPilihan)->result_array();
                foreach ($pilihan as $p) :
                ?>

                    <div class="row">
                        <div class="col-lg-4"><?= $p['judul_kriteria'] ?></div>
                        <div class="col-lg-8">:
                            <?php
                            $opt = $this->db->get_where('pilihan_kriteria', ['id_kriteria' => $p['id_kriteria']])->result_array();
                            $baris = count($opt) - 1;
                            foreach ($opt as $j) :
                                $qrel = 'SELECT * from rel_mhs_kriteria where nim = "' . $mahasiswa['nim'] . '" AND id_kriteria = "' . $j['id_kriteria'] . '"';
                                $rel_mhs = $this->db->query($qrel)->row_array();
                                $nilai = $rel_mhs['nilai'] * $baris;
                            ?>
                            <?php endforeach;
                            $isi = $this->db->get_where('pilihan_kriteria', ['urutan' => number_format($nilai), 'id_kriteria' => $p['id_kriteria']])->row_array();
                            echo $isi['nama_pilihan'];
                            // echo "<pre>";
                            // print_r($rel_mhs);
                            // echo "</pre>"; 
                            ?>
                        </div>
                    </div>

                <?php endforeach; ?>
                <a href="<?= base_url('admin/pemakalah'); ?>" class="btn btn-secondary mt-3">Back</a>
            </div>

        </div>
    </div> -->