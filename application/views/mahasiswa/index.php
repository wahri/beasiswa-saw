<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/') ?>css/agency.min.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-dark">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="<?= base_url('assets/') ?>img/logo.png" alt="" class="img-fluid" width="20%"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <?php if ($this->session->userdata('nim')) : ?>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('mahasiswa ') ?>">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('login/logout') ?>">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('login/daftar') ?>">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('login') ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- isi -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 mx-auto my-5">
                <div class="card">
                    <h5 class="card-header bg-warning">Biodata</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if ($mahasiswa['foto'] != NULL) : ?>
                                    <img src="<?= base_url('assets/img/mahasiswa/') . $mahasiswa['foto'] ?>" alt="mahasiswa" class="img-fluid" width="200px">
                                <?php endif; ?>
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
                                    <a href="<?= base_url('mahasiswa/hapusberkas') ?>" class="btn btn-danger btn-sm ml-2 text-light">Ganti Berkas</a>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php echo form_open_multipart('mahasiswa/uploadberkas'); ?>
                            <div class="row">
                                <div class="col-md-8 justify-content-center">
                                    <div class="form mt-3 pl-4 pt-2">
                                        <div class="form-group mb-2">
                                            <label for="exampleFormControlFile1">Upload berkas persyaratan</label>
                                            <input type="file" class="form-control-file" id="berkas" name="berkas">
                                        </div>
                                        <button class="btn btn-danger text-light" type="submit">Upload Berkas</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                        <a href="<?= base_url('mahasiswa/biodata') ?>" class="btn btn-primary mt-3 float-right text-dark">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <span class="copyright">Copyright &copy; UMRI <?= date('Y') ?></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="<?= base_url('assets/') ?>js/jqBootstrapValidation.js"></script>
    <script src="<?= base_url('assets/') ?>js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?= base_url('assets/') ?>js/agency.min.js"></script>

</body>

</html>