<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('nim')) {
            redirect('home');
        }
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {
        $nim = $this->input->post('nim');
        $password = $this->input->post('password');
        $mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();

        if ($mhs) {
            if (password_verify($password, $mhs['password'])) {
                $data = [
                    'nim' => $mhs['nim'],
                    'nama' => $mhs['nama']
                ];

                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIM atau Password salah!</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIM atau Password salah!</div>');
            redirect('login');
        }
    }

    public function daftar()
    {
        if ($this->session->userdata('nim')) {
            redirect('home');
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim|is_unique[mahasiswa.nim]|is_unique[penerima_beasiswa.nim]', [
            'is_unique' => 'NIM sudah terdaftar sebelumnya'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('daftar');
        } else {
            $data = [
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];
            $this->db->insert('mahasiswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mendaftar!</div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('nama');
        redirect('home');
    }
}
