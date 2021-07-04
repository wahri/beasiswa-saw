<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kaprodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('home');
        }
    }
    public function index()
    {
        $i = 1;
        $data['cek'] = $this->db->query('SELECT pendaftaran FROM user where pendaftaran =' . $i)->result_array();
        $data['user'] = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $this->load->view('kaprodi/template/header');
        $this->load->view('kaprodi/template/topbar');
        $this->load->view('kaprodi/template/sidebar', $data);
        $this->load->view('kaprodi/index', $data);
        $this->load->view('kaprodi/template/footer');
    }

    public function hapusBerkas()
    {
        $id = $this->session->userdata('user_id');
        $user = $this->db->get_where('user', ['user_id' => $id])->row_array();
        $link = "./assets/berkas/";
        $data['berkas'] = NULL;
        unlink($link . $user['berkas']);
        $this->db->update('user', $data, ['user_id' => $id]);

        redirect('kaprodi');
    }

    public function dataKriteria()
    {
        $this->load->dbforge();
        $this->load->model('Kode_model');
        $data['kode'] = $this->Kode_model->kode_kriteria();
        $data['user'] = $this->db->get('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $data['kriteria'] = $this->db->get('kriteria')->result_array();

        $this->form_validation->set_rules('nama_kriteria', 'nama_kriteria', 'required');
        $this->form_validation->set_rules('judul_kriteria', 'judul_kriteria', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
        $this->form_validation->set_rules('bc', 'Jenis', 'required');
        $this->form_validation->set_rules('jenis_pertanyaan', 'Pilihan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kaprodi/template/header');
            $this->load->view('kaprodi/template/topbar');
            $this->load->view('kaprodi/template/sidebar', $data);
            $this->load->view('kaprodi/datakriteria', $data);
            $this->load->view('kaprodi/template/footer');
        } else {
            $data = [
                'id_kriteria' => $this->input->post('id_kriteria'),
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'judul_kriteria' => $this->input->post('judul_kriteria'),
                'bobot' => $this->input->post('bobot'),
                'b/c' => $this->input->post('bc'),
                'jenis_pertanyaan' => $this->input->post('jenis_pertanyaan')
            ];
            $this->db->insert('kriteria', $data);

            // $pilihan = $this->input->post('nama_pilihan');
            // foreach ($pilihan as $v => $i) {
            //     $data_pilihan = [
            //         'id_kriteria' => $this->input->post('id_kriteria'),
            //         'nama_pilihan' => $this->input->post('nama_pilihan[' . $v . ']'),
            //         'urutan' => $this->input->post('urutan[' . $v . ']')
            //     ];
            //     $this->db->insert('pilihan_kriteria', $data_pilihan);
            // }
            if ($this->input->post('jenis_pertanyaan') == "Input") {
                $fields = [
                    $this->input->post('id_kriteria') => [
                        'type' => 'DOUBLE',
                        'null' => TRUE
                    ]
                ];
                $this->dbforge->add_column('mahasiswa', $fields);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kriteria Berhasil di tambahkan!</div>');
            redirect('kaprodi/datakriteria');
        }
    }

    public function perhitungan()
    {
        $data['user'] = $this->db->get('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $this->load->view('kaprodi/template/header');
        $this->load->view('kaprodi/template/topbar');
        $this->load->view('kaprodi/template/sidebar', $data);
        $this->load->view('kaprodi/perhitungan', $data);
        $this->load->view('kaprodi/template/footer');
    }

    public function seleksi()
    {
        $data['user'] = $this->db->get('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $this->load->view('kaprodi/template/header');
        $this->load->view('kaprodi/template/topbar');
        $this->load->view('kaprodi/template/sidebar', $data);
        $this->load->view('kaprodi/seleksi', $data);
        $this->load->view('kaprodi/template/footer');
    }

    public function detail($nim)
    {
        $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $data['user'] = $this->db->get('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $this->load->view('kaprodi/template/header');
        $this->load->view('kaprodi/template/topbar');
        $this->load->view('kaprodi/template/sidebar', $data);
        $this->load->view('kaprodi/detail', $data);
        $this->load->view('kaprodi/template/footer');
    }

    public function accept($nim)
    {
        $mahasiswa = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $upd['accept'] = "1";
        $isi = [
            'nim' => $nim,
            'tahun' => date("Y")
        ];
        $this->db->update('mahasiswa', $upd, ['nim' => $nim]);
        $this->db->insert('penerima_beasiswa', $isi);
        redirect('kaprodi/seleksi');
    }
    public function banned($nim)
    {
        $upd['accept'] = "2";
        $this->db->update('mahasiswa', $upd, ['nim' => $nim]);
        // $cek = $this->db->get_where('penerima_beasiswa', ['nim' => $nim])->row_array();
        $this->db->delete('penerima_beasiswa', ['nim' => $nim]);
        // if ($cek > 0) {
        // }
        redirect('kaprodi/seleksi');
    }


    public function finalisasi()
    {
        $i = 1;
        $data['cek'] = $this->db->query('SELECT publish FROM user where publish =' . $i)->result_array();
        $data['user'] = $this->db->get('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $data['mahasiswa'] = $this->db->get_where('mahasiswa', ['accept' => '1'])->result_array();
        $this->load->view('kaprodi/template/header');
        $this->load->view('kaprodi/template/topbar');
        $this->load->view('kaprodi/template/sidebar', $data);
        $this->load->view('kaprodi/finalisasi', $data);
        $this->load->view('kaprodi/template/footer');
    }

    public function publish()
    {
        $upd['publish'] = 1;
        $user = $this->session->userdata('user_id');
        $this->db->update('user', $upd, ['user_id' => $user]);
        redirect('kaprodi/finalisasi');
    }
    public function stopPublish()
    {
        $upd['publish'] = 0;
        $user = $this->session->userdata('user_id');
        $this->db->update('user', $upd, ['user_id' => $user]);
        redirect('kaprodi/finalisasi');
    }

    public function uploadBerkas()
    {
        $config['upload_path'] = './assets/berkas/';
        $config['allowed_types'] = 'doc|docx|odt|pdf';
        $config['max_size'] = '1000000';
        $config['file_name'] = 'berkas';

        $this->load->library('upload', $config, 'berkas');
        $this->berkas->initialize($config);

        $user = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        if ($this->berkas->do_upload('berkas')) {
            $data['berkas'] = $this->berkas->data('file_name');
            $this->db->update('user', $data, ['user_id' => $user['user_id']]);
            $this->session->set_flashdata('message', '<div class="alert alert-success mt-4" role="alert">Berhasil mengupload berkas!</div>');
            redirect('kaprodi');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mt-4" role="alert">Gagal mengupload berkas!</div>');
            redirect('kaprodi');
        }
    }

    public function bukaPendaftaran()
    {
        $upd['pendaftaran'] = 1;
        $user = $this->session->userdata('user_id');
        $this->db->update('user', $upd, ['user_id' => $user]);
        redirect('kaprodi');
    }
    public function stopPendaftaran()
    {
        $upd['pendaftaran'] = 0;
        $user = $this->session->userdata('user_id');
        $this->db->update('user', $upd, ['user_id' => $user]);
        redirect('kaprodi');
    }

    public function deleteKriteria($id)
    {
        $this->load->dbforge();
        $cek = $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
        if ($cek['jenis_pertanyaan'] == "Input") {
            $this->dbforge->drop_column('mahasiswa', $id);
        }
        $this->db->delete('kriteria', ['id_kriteria' => $id]);
        $this->db->delete('rel_mhs_kriteria', ['id_kriteria' => $id]);
        $this->db->delete('pilihan_kriteria', ['id_kriteria' => $id]);
        $this->db->delete('input_kriteria', ['id_kriteria' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kriteria dihapus!</div>');
        redirect('kaprodi/datakriteria');
    }

    public function setelan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
            $this->load->view('kaprodi/template/header');
            $this->load->view('kaprodi/template/topbar');
            $this->load->view('kaprodi/template/sidebar', $data);
            $this->load->view('kaprodi/setelan', $data);
            $this->load->view('kaprodi/template/footer');
        } else {
            $this->_setelan();
        }
    }
    public function _setelan()
    {
        $user = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
        $id = $this->input->post('user_id');
        $nama = $this->input->post('nama');
        $passwordlama = $this->input->post('password_lama');
        $pass = $this->input->post('password1');
        $password = password_hash($pass, PASSWORD_DEFAULT);

        if ($pass) {
            if (password_verify($passwordlama, $user['password'])) {
                $data = [
                    'nama' => $nama,
                    'password' => $password
                ];
                $this->db->update('user', $data, ['user_id' => $id]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Berhasil Di Ubah!</div>');
                redirect('kaprodi/setelan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('kaprodi/setelan');
            }
        } else {
            $data = [
                'nama' => $nama,
            ];
            $this->db->update('user', $data, ['user_id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Berhasil Di Ubah!</div>');
            redirect('kaprodi/setelan');
        }
    }

    public function reset()
    {
        $this->db->empty_table('mahasiswa');
        $this->db->empty_table('rel_mhs_kriteria');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil di reset!</div>');
        redirect('kaprodi');
    }

    public function editKriteria($id)
    {
        $this->form_validation->set_rules('nama_kriteria', 'nama_kriteria', 'required');
        $this->form_validation->set_rules('judul_kriteria', 'judul_kriteria', 'required');
        $this->form_validation->set_rules('bobot', 'bobot', 'required');
        $this->form_validation->set_rules('bc', 'Benefit/Cost', 'required');
        $this->form_validation->set_rules('jenis_pertanyaan', 'Pilihan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kriteria'] = $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
            $data['user'] = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
            $this->load->view('kaprodi/template/header');
            $this->load->view('kaprodi/template/topbar');
            $this->load->view('kaprodi/template/sidebar', $data);
            $this->load->view('kaprodi/editkriteria', $data);
            $this->load->view('kaprodi/template/footer');
        } else {
            $data = [
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'judul_kriteria' => $this->input->post('judul_kriteria'),
                'bobot' => $this->input->post('bobot'),
                'b/c' => $this->input->post('bc'),
                'jenis_pertanyaan' => $this->input->post('jenis_pertanyaan')
            ];
            $this->db->update('kriteria', $data, ['id_kriteria' => $id]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kriteria Berhasil di Ubah!</div>');
            redirect('kaprodi/datakriteria');
        }
    }

    public function tambahPertanyaan($id)
    {
        $this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kriteria'] = $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
            $data['user'] = $this->db->get_where('user', ['user_id' => $this->session->userdata('user_id')])->row_array();
            $this->load->view('kaprodi/template/header');
            $this->load->view('kaprodi/template/topbar');
            $this->load->view('kaprodi/template/sidebar', $data);
            $this->load->view('kaprodi/tambahpertanyaan', $data);
            $this->load->view('kaprodi/template/footer');
        } else {
            $kriteria = $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
            if ($kriteria['jenis_pertanyaan'] == "Pilihan") {
                $pilihan = $this->input->post('nama_pilihan');
                // print_r($pilihan);
                // die;
                foreach ($pilihan as $v => $i) {
                    $q = "SELECT * FROM pilihan_kriteria where id_kriteria ='" . $this->input->post('id_kriteria') . "' and urutan = '" . $this->input->post('urutan[' . $v . ']') . "'";
                    $cek = $this->db->query($q)->row_array();
                    $data_pilihan = [
                        'id_kriteria' => $this->input->post('id_kriteria'),
                        'nama_pilihan' => $this->input->post('nama_pilihan[' . $v . ']'),
                        'urutan' => $this->input->post('urutan[' . $v . ']')
                    ];
                    if ($cek) {
                        $this->db->update('pilihan_kriteria', $data_pilihan, ['id_kriteria' => $this->input->post('id_kriteria'), 'urutan' => $this->input->post('urutan[' . $v . ']')]);
                    } else {
                        $this->db->insert('pilihan_kriteria', $data_pilihan);
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pilihan Kriteria Berhasil di Tambah!</div>');
                redirect('kaprodi/datakriteria');
            } else {
                $urutan = $this->input->post('min');
                // print_r($urutan);
                // die;
                foreach ($urutan as $v => $i) {
                    $q = "SELECT * FROM input_kriteria where id_kriteria ='" . $this->input->post('id_kriteria') . "' and urutan = '" . $this->input->post('urutan[' . $v . ']') . "'";
                    $cek = $this->db->query($q)->row_array();
                    $data_pilihan = [
                        'id_kriteria' => $this->input->post('id_kriteria'),
                        'min' => $this->input->post('min[' . $v . ']'),
                        'max' => $this->input->post('max[' . $v . ']'),
                        'urutan' => $this->input->post('urutan[' . $v . ']')
                    ];
                    if ($cek) {
                        $this->db->update('input_kriteria', $data_pilihan, ['id_kriteria' => $this->input->post('id_kriteria'), 'urutan' => $this->input->post('urutan[' . $v . ']')]);
                    } else {
                        $this->db->insert('input_kriteria', $data_pilihan);
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Input Kriteria Berhasil di Tambah!</div>');
                redirect('kaprodi/datakriteria');
            }
        }
    }

    public function hapusPertanyaan($id, $urutan)
    {
        $kriteria = $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
        if ($kriteria['jenis_pertanyaan'] == "Pilihan") {
            $this->db->delete('pilihan_kriteria', ['id_kriteria' => $id, 'urutan' => $urutan]);
        } else {
            $this->db->delete('input_kriteria', ['id_kriteria' => $id, 'urutan' => $urutan]);
        }
        redirect('kaprodi/tambahpertanyaan/' . $id);
    }
}
