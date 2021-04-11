<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }
    public function index()
    {
        $data = [
            'judul'     => 'Data User',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'data_user' => $this->user_model->getData()->result_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/user/data_user');
        $this->load->view('templates/admin_footer');
    }

    public function proses($id_user = null)
    {
        $user = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        $fotoLama = $user['foto'];
        if (isset($_POST['tambah'])) {
            $this->user_model->tambah_user();
        } elseif (isset($_POST['edit'])) {
            $this->user_model->edit_user($id_user, $fotoLama);
        }
        redirect('admin/user/index');
    }

    public function edit_password($id_user)
    {
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->db->set('password', $password);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password user berhasil diubah</div>');
        redirect('admin/user/index');
    }

    public function hapus_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat! kamu berhasil menghapus data user</div>');
        redirect('admin/user/index');
    }

    // public function cetak_data()
    // {
    //     $data['user'] = $this->db->get_where('tb_user', ['id_role !=' => 1])->result_array();
    //     $this->load->view('admin/user/cetak_data', $data);
    // }

    public function cetak_data()
    {
        $this->load->library('dompdf_gen');
        $data['user']   = $this->db->get_where('tb_user', ['id_role !=' => 1])->result_array();
        $data['profil'] = $this->db->get('tb_profil')->row_array();
        $this->load->view('admin/user/cetak_data', $data);
        // menentukan ukuran kertas
        $paper_size     = 'A4';
        $orientation    = 'potrait';
        $html           = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_data_user.pdf', ['Attachment' => 0]);
    }
}
