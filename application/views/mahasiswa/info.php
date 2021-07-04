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
                            <a class="nav-link js-scroll-trigger" href="<?= base_url('mahasiswa/biodata') ?>">Biodata</a>
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
            <div class="col-xl-10 col-sm-12 mx-auto my-5">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('message'); ?>
                        <h4 class="mt-3 text-center ">Informasi</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aliquam error ipsum maxime ab corporis accusantium praesentium, omnis, officia tempore minima quidem necessitatibus eaque ratione, voluptate natus vero nam dolorem. Voluptatibus, culpa. Iure, suscipit. Accusantium porro, enim, totam deleniti quo laudantium architecto facere nulla excepturi unde eaque maiores labore esse.</p>
                        <ul>
                            <li>Lorem ipsum dolor sit amet.</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt, natus.</li>
                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut.</li>
                            <li>Lorem ipsum dolor sit.</li>
                        </ul>
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