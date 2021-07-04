<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('nim')) {
            $data['mhs'] = $this->db->get_where('mahasiswa', ['nim' => $this->session->userdata('nim')])->row_array();
        }
        $data['judul'] = "Home";
        $this->load->view('home', $data);
    }

    public function unduh()
    {
        $berkas = $this->db->get('user')->row_array();
        force_download('assets/berkas/' . $berkas['berkas'], NULL);
        redirect('home');
    }

    public function informasi()
    {
        $data['judul'] = "Informasi";
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $this->load->view('informasi', $data);
    }
}
