<?php

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }

    public function edit_profil()
    {
        $data = [
            'judul'     => 'Edit Profil',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
        ];
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('telepon', 'Nomor Telepon', 'required|trim', [
            'required' => 'Nomor Telepon tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/edit_profil');
            $this->load->view('templates/user_footer');
        } else {
            $nama             = $this->input->post('nama');
            $email            = $this->input->post('email');
            $telepon          = $this->input->post('telepon');
            $alamat           = $this->input->post('alamat');
            // foto
            $foto             = $_FILES['foto']['name'];

            if ($foto) {
                $config['allowed_types']    = 'gif|png|jpg|PNG|JPEG|jpeg';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/user/img/profil/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $old_foto = $data['user']['foto'];
                    if ($old_foto != 'default.jpg') {
                        unlink(FCPATH . 'assets/user/img/profil/' . $old_foto);
                    }

                    $new_foto = $this->upload->data('file_name');
                    $this->db->set('foto', $new_foto);
                } else {
                    $this->db->set('nama', $nama);
                    $this->db->set('telepon', $telepon);
                    $this->db->set('alamat', $alamat);
                    $this->db->where('email', $email);
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Profil berhasil diubah</div>');
                    redirect('user/profil/edit_profil');
                }
            }


            $this->db->set('nama', $nama);
            $this->db->set('telepon', $telepon);
            $this->db->set('alamat', $alamat);
            $this->db->where('email', $email);
            $this->db->update('tb_user');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Profil berhasil diubah</div>');
            redirect('user/profil/edit_profil');
        }
    }

    public function edit_password()
    {
        $data['judul']          = 'Edit Password';
        $data['user']           = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['tb_user']        = $this->session->userdata('nama');

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim', ['required' => 'Password Tidak boleh kosong']);
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[4]|matches[konfirmasi_password]', [
            'required'          => 'Password Tidak boleh kosong',
            'min_length'        => 'Password terlalu pendek',
            'matches'           => 'Password tidak sama',
        ]);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|trim|min_length[4]|matches[password_baru]', [
            'required'          => 'Password Tidak boleh kosong',
            'min_length'        => 'Password terlalu pendek',
            'matches'           => 'Password tidak sama',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('user/edit_password');
            $this->load->view('templates/user_footer');
        } else {
            $password_lama    = $this->input->post('password_lama');
            $password_baru    = $this->input->post('password_baru');

            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password Lama Salah!</div>');
                redirect('user/profil/edit_password');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('user/profil/edit_password');
                } else {
                    // jika password sudah benar
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password Berhasil diubah!</div>');
                    redirect('user/profil/edit_profil');
                }
            }
        }
    }
}
