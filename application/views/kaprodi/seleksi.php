<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Seleksi Mahasiswa</h1>
            <hr>
            <?php
            $awal = $this->db->get('rel_mhs_kriteria')->result_array();
            if ($awal) :
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        $awal = $this->db->get('rel_mhs_kriteria')->result_array();
                        foreach ($awal as $k => $v) {
                            $data[$v['nim']][$v['id_kriteria']] = $v['nilai'];
                        }
                        $kriteria = $this->db->get('kriteria')->result_array();
                        // $data = $this->db->query('SELECT * from rel_mhs_kriteria order by id_kriteria')->result_array();
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                        ?>

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
                            // echo array_sum($sum);
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
                        <h3 class="h3 mt-3">Perangkingan</h3>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">Rank</th>
                                    <th scope="col" width="15%">NIM</th>
                                    <th scope="col" width="35%">Nama</th>
                                    <th scope="col" width="10%">Skor</th>
                                    <th scope="col" width="15%">Accept</th>
                                    <th scope="col" width="15%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($ranking as $nm => $value) :
                                ?>
                                    <tr>
                                        <td><?= $value['rank'] ?></td>
                                        <th scope="row"><?= $value['nim'] ?></th>
                                        <th scope="row"><?= $value['nama'] ?></th>
                                        <td><?= number_format($value['total'], 2) ?></td>
                                        <td><a href="<?= base_url('kaprodi/detail/') . $value['nim'] ?>" class="btn btn-primary">Detail</a></td>
                                        <?php
                                        if ($value['accept'] == 1) :
                                        ?>
                                            <td><span class="btn btn-success">Diterima</span></td>
                                        <?php
                                        elseif ($value['accept'] == 2) :
                                        ?>
                                            <td><span class="btn btn-danger">Ditolak</span></td>
                                        <?php
                                        else :
                                        ?>
                                            <td><span class="btn btn-secondary">Menunggu</span></td>
                                        <?php
                                        endif;
                                        ?>
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