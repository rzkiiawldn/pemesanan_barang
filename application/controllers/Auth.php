<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        // jika user sudah login, tampilan halaman login tidak bisa di akses
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['judul']  = 'Halaman Login';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/admin_footer');
        } else {
            // validasi login berhasil
            $this->_login();
        }
    }

    public function _login()
    {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $user       = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        if ($user) {
            // jika email benar, di cek passwordnya
            if (password_verify($password, $user['password'])) {
                // jika password benar siapkan data
                $data = [
                    'email'     => $user['email'],
                    'id_role'   => $user['id_role']
                ];
                // kemudian simpan data kedalam session
                $this->session->set_userdata($data);
                if ($user['id_role'] == 1) {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password yang anda masukan salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email tidak terdaftar, silahkan registrasi terlebih dahulu</div>');
            redirect('auth');
        }
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique'     => 'email sudah digunakan',
            'valid_email'   => 'email tidak valid'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'min_length' => 'password minimal 4 karakter',
            'matches'    => 'password tidak sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $data['judul']  = 'Halaman Registrasi';
            $this->load->view('templates/admin_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/admin_footer');
        } else {
            $this->auth_model->registrasi();
            // pesan dengan flash_data
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Registrasi berhasil, silahkan login</div>');
            redirect('auth');
        }
    }

    public function blocked()
    {
        $data['judul']  = 'Akses dilarang';
        $this->load->view('templates/admin_header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/admin_footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda berhasil keluar</div>');
        redirect('welcome');
    }
}
