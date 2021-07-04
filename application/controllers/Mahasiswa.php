<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function index()
    {
        $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();
        $data['judul'] = "Biodata Mahasiswa";
        $this->load->view('mahasiswa/index', $data);
    }

    public function biodata()
    {
        $qPilihan = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Pilihan'";
        $data['pilihan'] = $this->db->query($qPilihan)->result_array();
        $qInput = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Input'";
        $data['input'] = $this->db->query($qInput)->result_array();
        $data['error'] = '';
        $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();
        $data['judul'] = "Biodata";
        $this->load->view('mahasiswa/biodata', $data);
    }
    public function daftarBiodata()
    {
        $nim = $this->session->userdata('nim');
        $qPilihan = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Pilihan'";
        $pilihan = $this->db->query($qPilihan)->result_array();
        $qInput = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Input'";
        $input = $this->db->query($qInput)->result_array();
        $mahasiswa = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();

        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $alamat = $this->input->post('alamat');
        $angkatan = $this->input->post('angkatan');

        $config['upload_path'] = './assets/img/mahasiswa/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|';
        $config['max_size'] = '1000000';
        $config['file_name'] = $nim;

        $this->load->library('upload', $config, 'foto');
        $this->foto->initialize($config);

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|trim');

        if ($mahasiswa['foto'] == NULL) {
            if ($this->foto->do_upload('foto')) {
                $data['foto'] = $this->foto->data('file_name');
                $this->db->update('mahasiswa', $data, ['nim' => $nim]);
            }
        }
        if ($this->form_validation->run()) {
            $data = [
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat,
                'angkatan' => $angkatan
            ];
            $this->db->update('mahasiswa', $data, ['nim' => $nim]);

            // PERULANGAN UNTUK KRITERIA PILIHAN
            foreach ($pilihan as $p) {
                $cek = $this->db->get_where('rel_mhs_kriteria', ['nim' => $mahasiswa['nim'], 'id_kriteria' => $p['id_kriteria']])->row_array();
                $data = [
                    'nim' => $nim,
                    'id_kriteria' => $p['id_kriteria'],
                    'nilai' => $this->input->post($p['id_kriteria'])
                ];
                if ($cek) {
                    $this->db->update('rel_mhs_kriteria', $data, ['nim' => $nim, 'id_kriteria' => $p['id_kriteria']]);
                } else {
                    $this->db->insert('rel_mhs_kriteria', $data);
                }
            }

            // PERULANGAN UNTUK KRITERIA INPUT
            foreach ($input as $i) {
                $cek = $this->db->get_where('rel_mhs_kriteria', ['nim' => $mahasiswa['nim'], 'id_kriteria' => $i['id_kriteria']])->row_array();

                // MENCARI NILAI BERDASARKAN URUTAN
                $nilai = $this->db->get_where('input_kriteria', ['id_kriteria' => $i['id_kriteria']])->result_array();
                $verifikasi = $this->input->post($i['id_kriteria']);
                foreach ($nilai as $n) {
                    if ($verifikasi >= $n['min']) {
                        if ($verifikasi <= $n['max']) {
                            $urutan = $n['urutan'];
                        }
                    }
                }
                $opt = $this->db->get_where('input_kriteria', ['id_kriteria' => $i['id_kriteria']])->result_array();
                $baris = count($opt);
                $nilai = $urutan / ($baris - 1);
                $data = [
                    'nim' => $nim,
                    'id_kriteria' => $i['id_kriteria'],
                    'nilai' => $nilai
                ];
                if ($cek) {
                    $this->db->update('rel_mhs_kriteria', $data, ['nim' => $nim, 'id_kriteria' => $i['id_kriteria']]);
                } else {
                    $this->db->insert('rel_mhs_kriteria', $data);
                }
                $upd = [$i['id_kriteria'] => $verifikasi];
                $this->db->update('mahasiswa', $upd, ['nim' => $nim]);
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan!</div>');
            redirect('mahasiswa');
        } else {
            $qPilihan = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Pilihan'";
            $data['pilihan'] = $this->db->query($qPilihan)->result_array();
            $qInput = "SELECT id_kriteria, judul_kriteria FROM kriteria where jenis_pertanyaan = 'Input'";
            $data['input'] = $this->db->query($qInput)->result_array();
            $data['error'] = '';
            $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();
            $data['judul'] = "Biodata";
            $this->load->view('mahasiswa/biodata', $data);
        }
    }


    public function uploadBerkas()
    {
        $nim = $this->session->userdata('nim');

        $config['upload_path'] = './assets/berkas/mahasiswa/';
        $config['allowed_types'] = 'doc|docx|odt|pdf';
        $config['max_size'] = '1000000';
        $config['file_name'] = $nim;

        $this->load->library('upload', $config, 'berkas');
        $this->berkas->initialize($config);

        if ($this->berkas->do_upload('berkas')) {
            $data['berkas'] = $this->berkas->data('file_name');
            $this->db->update('mahasiswa', $data, ['nim' => $nim]);
            redirect('mahasiswa');
        } else {
            redirect('mahasiswa');
        }
    }

    public function hapusBerkas()
    {
        $nim = $this->session->userdata('nim');
        $mahasiswa = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();
        $link = "./assets/berkas/mahasiswa/";
        $data['berkas'] = NULL;
        unlink($link . $mahasiswa['berkas']);
        $this->db->update('mahasiswa', $data, ['nim' => $nim]);

        redirect('mahasiswa');
    }
    public function hapusFoto()
    {
        $nim = $this->session->userdata('nim');
        $mahasiswa = $this->db->get_where('mahasiswa', ['nim' => $nim = $this->session->userdata('nim')])->row_array();
        $link = "./assets/berkas/mahasiswa/";
        $data['foto'] = NULL;
        unlink($link . $mahasiswa['foto']);
        $this->db->update('mahasiswa', $data, ['nim' => $nim]);
        redirect('mahasiswa/biodata');
    }

    public function info()
    {
        $data['judul'] = "Informasi";
        $this->load->view('mahasiswa/info', $data);
    }
}
