<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Login Page';
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/auth_header');
            $this->load->view('auth/index');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }
    public function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $users = $this->db->get_where('users', ['email' => $email])->row_array();
        //jika usernya ada
        if ($users) {
            //jika usernya aktif
            if ($users['is_active'] == 1) {
                //cek password
                if (password_verify($password, $users['password'])) {
                    $data = [
                        'email' => $users['email'],
                        'role_id' => $users['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($users['role_id'] == 1) {
                        redirect('admin/index');
                    } else {
                        redirect('auth/index');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum aktif</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak terdaftar</div>');
            redirect('auth');
        }
    }
}
