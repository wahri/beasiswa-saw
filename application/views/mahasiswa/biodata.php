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
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('mahasiswa') ?>">Biodata</a>
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
            <div class="col-md-8 mx-auto my-5">
                <div class="card">
                    <h4 class="card-header bg-warning">Edit Biodata
                    </h4>
                    <div class="card-body">
                        <?php echo form_open_multipart('mahasiswa/daftarbiodata'); ?>
                        <?= $this->session->flashdata('message'); ?>
                        <br>
                        <?php
                        if ($mahasiswa['foto'] != null) : ?>
                            <img src="<?= base_url('assets/img/mahasiswa/') . $mahasiswa['foto'] ?>" alt="mahasiswa" class="img-fluid" width="200px">
                            <a href="<?= base_url('mahasiswa/hapusfoto') ?>" class="btn btn-danger btn-sm ml-2 text-light">Ganti Foto</a>
                        <?php else : ?>
                            <div class="form-group">
                                <label for="foto">Upload foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                                <small class="form-text text-danger"><?= $error ?></small>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mt-3">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" value="<?= $mahasiswa['nama'] ?>">
                            <small class="form-text text-danger"><?= form_error('nama') ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" aria-describedby="nim" value="<?= $mahasiswa['nim'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" aria-describedby="tempat_lahir" value="<?= $mahasiswa['tempat_lahir'] ?>">
                            <small class="form-text text-danger"><?= form_error('tempat_lahir') ?></small>
                        </div>
                        <script>
                            function My_Date() {
                                document.getElementById("tanggal").value = "<?= $mahasiswa['tanggal_lahir'] ?>";
                            }
                        </script>
                        <div class="form-group">
                            <label for="tanggal">Tanggal lahir</label>
                            <input type="date" id="tanggal" class="form-control" id="tanggal_lahir" name="tanggal_lahir" aria-describedby="tanggal_lahir" value="111" value="<?= set_value('tanggal_lahir'); ?>">
                        </div>

                        <small class="form-text text-danger"><?= form_error('tanggal_lahir') ?></small>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" placeholder="Alamat" name="alamat" rows="2"><?= $mahasiswa['alamat'] ?></textarea>
                            <small class="form-text text-danger"><?= form_error('alamat') ?></small>
                        </div>
                        <div class="form-group">
                            <label for="angkatan">Tahun Angkatan</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Tahun Angkatan" aria-describedby="angkatan" value="<?= $mahasiswa['angkatan'] ?>">
                            <small class="form-text text-danger"><?= form_error('angkatan') ?></small>
                        </div>
                        <?php foreach ($input as $i) : ?>
                            <div class="form-group">
                                <label for="<?= $i['judul_kriteria'] ?>"><?= $i['judul_kriteria'] ?></label>
                                <input type="number" step="any" class="form-control col-md-3" id="<?= $i['id_kriteria'] ?>" name="<?= $i['id_kriteria'] ?>" value="<?= $mahasiswa[$i['id_kriteria']] ?>">
                            </div>
                        <?php endforeach; ?>
                        <?php foreach ($pilihan as $p) : ?>
                            <div class=" form-group">
                                <label for="nama"><?= $p['judul_kriteria'] ?></label>
                                <input type="text" value="<?= $p['id_kriteria'] ?>" name="id_kriteria" hidden>
                                <select name="<?= $p['id_kriteria'] ?>" id="<?= $p['id_kriteria'] ?>" class="form-control">

                                    <?php
                                    $opt = $this->db->get_where('pilihan_kriteria', ['id_kriteria' => $p['id_kriteria']])->result_array();
                                    $baris = count($opt);
                                    $cek = $this->db->get_where('rel_mhs_kriteria', ['nim' => $mahasiswa['nim'], 'id_kriteria' => $p['id_kriteria']])->row_array();
                                    $nilai = $cek['nilai'];
                                    $urutan = number_format($nilai * ($baris - 1));
                                    $opt2 = $this->db->get_where('pilihan_kriteria', ['id_kriteria' => $p['id_kriteria'], 'urutan' => $urutan])->row_array();
                                    if ($cek) : ?>
                                        <option value="<?= $opt2['urutan'] / ($baris - 1) ?>"><?= $opt2['nama_pilihan'] ?></option>
                                        <?php
                                        foreach ($opt as $j) :
                                        ?>
                                            <option value="<?= $j['urutan'] / ($baris - 1) ?>"><?= $j['nama_pilihan'] ?></option>
                                        <?php endforeach;
                                    else :
                                        ?>
                                        <option value="">...</option>
                                        <?php
                                        foreach ($opt as $j) :
                                        ?>
                                            <option value="<?= $j['urutan'] / ($baris - 1) ?>"><?= $j['nama_pilihan'] ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-warning float-right">Simpan</button>
                        </form>
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