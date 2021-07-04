<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="<?= base_url('kaprodi') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="<?= base_url('kaprodi/setelan') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        Pengaturan Akun
                    </a>
                    <a class="nav-link" href="<?= base_url('kaprodi/datakriteria') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        Data Kriteria
                    </a>
                    <a class="nav-link" href="<?= base_url('kaprodi/perhitungan') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        Perhitungan SAW
                    </a>
                    <a class="nav-link" href="<?= base_url('kaprodi/seleksi') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        Seleksi Mahasiswa
                    </a>
                    <a class="nav-link" href="<?= base_url('kaprodi/finalisasi') ?>">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-area"></i>
                        </div>
                        Finalisasi
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $user['nama'] ?>
            </div>
        </nav>
    </div>