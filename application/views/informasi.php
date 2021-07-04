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
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/') ?>css/agency.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
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
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('home/informasi') ?>">Informasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('mahasiswa') ?>">Biodata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('login/logout') ?>">Logout</a>
                        </li>
                    <?php else : ?>
                        <?php
                        $i = 1;
                        $cek = $this->db->query('SELECT pendaftaran FROM user where pendaftaran =' . $i)->result_array();
                        if (count($cek) > 0) :
                        ?>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= base_url('home') ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= base_url('home/informasi') ?>">Informasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= base_url('login/daftar') ?>">Daftar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link js-scroll-trigger" href="<?= base_url('login') ?>">Login</a>
                            </li>

                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section class="bg-light page-section mt-5" id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Daftar Pendaftar Beasiswa Bidikmisi</h2>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mt-3">
                <div class="col-md-8">
                    <table class="table table-dark" id="dataTable">
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
                </div>
            </div>
        </div>
    </section>

    <!-- PUBLISH -->




    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <span class="copyright">Copyright &copy; UMRI <?= date('Y') ?></span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="<?= base_url('assets/') ?>js/jqBootstrapValidation.js"></script>
    <script src="<?= base_url('assets/') ?>js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?= base_url('assets/') ?>js/agency.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/') ?>assets/demo/datatables-demo.js"></script>
</body>

</html>