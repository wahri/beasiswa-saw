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

<body id="page-top">

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
  <?php if ($this->session->userdata('nim')) : ?>
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Selamat Datang <?= $mhs['nama'] ?>!</div>
          <div class="intro-heading">Silahkan Lengkapi Data Diri</div>
          <a class="btn btn-info btn-xl text-blue text-uppercase js-scroll-trigger" href="<?= base_url('mahasiswa/biodata') ?>">Lanjut Disini</a>
        </div>
      </div>
    </header>
  <?php else : ?>
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-heading text-uppercase">SISTEM INFORMASI<br>PENDAFTARAN dan SELEKSI BEASISWA<br>Universitas Muhammadiyah Riau</div>
          <?php
          $i = 1;
          $cek = $this->db->query('SELECT pendaftaran FROM user where pendaftaran =' . $i)->result_array();
          if (count($cek) > 0) :
          ?>
            <a class="btn btn-primary btn-xl text-uppercase text-dark js-scroll-trigger" href="<?= base_url('login/daftar') ?>">DAFTAR</a>
          <?php endif; ?>
        </div>
      </div>
    </header>
  <?php endif; ?>

  <!-- PUBLISH -->

  <section class="bg-warning page-section py-3" id="about">
    <div class="container-fluid mt-0 px-0">
      <div class="row h-100">
        <div class="col-md-7 pt-3 text-light">
          <div class="row ml-3">
            <div class="col-md-12 h-100 bg-dark py-3 rounded">
              <h4 class="mt-3 text-center ">Deskripsi Beasiswa</h4>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda aliquam error ipsum maxime ab corporis accusantium praesentium, omnis, officia tempore minima quidem necessitatibus eaque ratione, voluptate natus vero nam dolorem. Voluptatibus, culpa. Iure, suscipit. Accusantium porro, enim, totam deleniti quo laudantium architecto facere nulla excepturi unde eaque maiores labore esse.</p>
              <ul>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt, natus.</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut.</li>
                <li>Lorem ipsum dolor sit.</li>
              </ul>
              <center>
                <a href="<?= base_url('home/unduh') ?>" class="btn btn-primary text-dark">Unduh Berkas</a>
              </center>
            </div>
          </div>

        </div>

        <div class="col-md-5 pt-3 text-body">
          <div class="row h-100">
            <div class="col-md-11 ml-3 text-center border border-dark rounded">
              <?php
              $mahasiswa = $this->db->get_where('mahasiswa', ['accept' => '1'])->result_array();;
              $i = 1;
              $cek = $this->db->query('SELECT publish FROM user where publish =' . $i)->result_array();
              if (count($cek) > 0) :
              ?>
                <h4 class="mt-3">Pengumuman Lolos Seleksi</h4>
                <hr>
                <table class="table table-bordered table-striped bg-white text-dark mt-5">
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
              <?php else : ?>
                <h4 class="mt-3">Pengumuman Lolos Seleksi</h4>
                <hr>
                <img src="<?= base_url('assets/img/soon.png') ?>" class="img-fluid" width="50%">
              <?php endif; ?>

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>


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