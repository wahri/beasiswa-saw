<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Perhitungan SAW</h1>
            <hr>
            <?php
            $awal = $this->db->get('rel_mhs_kriteria')->result_array();
            if ($awal) :
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        $q = "SELECT * FROM rel_mhs_kriteria ORDER BY id_kriteria";
                        $awal = $this->db->query($q)->result_array();
                        foreach ($awal as $k => $v) {
                            $data[$v['nim']][$v['id_kriteria']] = $v['nilai'];
                        }

                        $kriteria = $this->db->get('kriteria')->result_array();
                        // $data = $this->db->query('SELECT * from rel_mhs_kriteria order by id_kriteria')->result_array();
                        ?>
                        <h3 class="h3 mt-3">Matriks Awal</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th scope="col">NIM</th>
                                    <?php foreach ($kriteria as $kr) : ?>
                                        <th scope="col"><?= $kr['nama_kriteria'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $nm => $value) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $nm ?></th>
                                        <?php
                                        foreach ($value as $kr => $nl) :
                                        ?>
                                            <td><?= number_format($nl, 2) ?></td>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>

                        <?php
                        // $kriteria = $this->db->get('rel_mhs_kriteria')->result_array();
                        // foreach ($kriteria as $nm => $value) {
                        //     foreach ($value as $kr => $nl) {
                        //         $data[$nm][$kr] = $nl;
                        //     }
                        // }

                        //transpose matriks
                        $temp = [];
                        foreach ($data as $nm => $value) {
                            foreach ($value as $kr => $nl) {
                                $temp[$kr][] = $nl;
                            }
                        }
                        //mencari pembagi data
                        $pembagi = [];
                        foreach ($temp as $key => $value) {
                            $cek = $this->db->get_where('kriteria', ['id_kriteria' => $key])->row_array();
                            if ($cek['b/c'] == "b") {
                                $pembagi[$key] = max($value);
                            } else {
                                $pembagi[$key] = min($value);
                            }
                        }

                        //normalisasi data
                        foreach ($data as $nm => $value) {
                            foreach ($value as $kr => $nl) {
                                $cek = $this->db->get_where('kriteria', ['id_kriteria' => $kr])->row_array();
                                $ini = $pembagi[$cek['id_kriteria']];
                                if ($cek['b/c'] == "b") {
                                    if ($ini >= 0) {
                                        $ini = 1;
                                        $data[$nm][$kr] = $nl / $ini;
                                    } else {
                                        echo "gagal";
                                    }
                                } else {
                                    if ($nl >= 0) {
                                        $nl = 1;
                                        $data[$nm][$kr] = $ini / $nl;
                                    } else {
                                        echo "gagal";
                                    }
                                }
                            }
                        }
                        ?>
                        <h3 class="h3 mt-5">Normalisasi Matriks</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th scope="col">NIM</th>
                                    <?php foreach ($kriteria as $kr) : ?>
                                        <th scope="col"><?= $kr['nama_kriteria'] ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $nm => $value) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $nm ?></th>
                                        <?php
                                        foreach ($value as $kr => $nl) :
                                        ?>
                                            <td><?= number_format($nl, 2) ?></td>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>


                        <?php
                        //perangkingan
                        foreach ($data as $nm => $value) {
                            $sum = [];
                            foreach ($value as $kr => $nl) {
                                $bobot = $this->db->get_where('kriteria', ['id_kriteria' => $kr])->row_array();
                                // echo $nl . " * " . $bobot['bobot'] . " = ";
                                // echo $nl * $bobot['bobot'] . "<br>";
                                $sum[] = $nl * $bobot['bobot'];
                            }
                            $upd = ['total' => array_sum($sum)];
                            $this->db->update('mahasiswa', $upd, ['nim' => $nm]);
                            // echo "<br><br><br>";
                        }
                        $rank = $this->db->query('SELECT nim, total from mahasiswa order by total DESC')->result_array();
                        $i = 1;
                        foreach ($rank as $k => $t) {
                            $this->db->update('mahasiswa', ['rank' => $i], ['nim' => $t['nim']]);
                            $i++;
                        }
                        $ranking = $this->db->query('SELECT * FROM mahasiswa order by rank')->result_array();
                        // echo "<pre>";
                        // print_r($ranking);
                        // echo "</pre>";
                        // die;
                        ?>
                        <h3 class="h3 mt-5">Perangkingan</h3>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>

                                    <th scope="col" width="20%">NIM</th>
                                    <th scope="col" width="50%">Nama</th>
                                    <th scope="col" width="20%">Skor</th>
                                    <th scope="col" width="10%">Rank</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($ranking as $nm => $value) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $value['nim'] ?></th>
                                        <th scope="row"><?= $value['nama'] ?></th>
                                        <td><?= number_format($value['total'], 2) ?></td>
                                        <td><?= $value['rank'] ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger" role="alert">
                    Belum ada yang mendaftar atau mahasiswa belum melengkapi data!
                </div>
            <?php endif; ?>
        </div>
    </main>