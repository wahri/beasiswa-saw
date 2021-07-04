<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('user_id')) {
            redirect('kaprodi');
        }
        $this->form_validation->set_rules('user_id', 'id', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('loginadmin');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['user_id' => $user_id])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'user_id' => $user['user_id'],
                    'nama' => $user['nama'],
                    'level' => $user['level']
                ];
                $this->session->set_userdata($data);
                redirect('kaprodi');
            } else {
                redirect('home');
            }
        } else {
            redirect('home');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('level');
        redirect('home');
    }
}
