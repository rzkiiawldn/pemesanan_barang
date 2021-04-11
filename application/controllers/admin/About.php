<?php

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }
    public function index()
    {
        $data = [
            'judul'     => 'About Us',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'about'     => $this->db->get('tb_profil')->result_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/about/index');
        $this->load->view('templates/admin_footer');
    }

    public function proses($id)
    {
        $data['about']      = $this->db->get_where('tb_profil', ['id' => $id])->row_array();
        $tentang_perusahaan = $this->input->post('tentang_perusahaan');
        $nama_website       = $this->input->post('nama_website');
        $logo_website       = $_FILES['logo_website'];
        if ($logo_website = '') {
        } else {
            $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
            $config['max_size']         = '2048';
            $config['upload_path']      = './assets/user/img/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo_website')) {
                $old_gambar         = $data['about']['logo_website'];
                if ($old_gambar     != 'default.jpg') {
                    unlink(FCPATH . 'assets/user/img/' . $old_gambar);
                }
                $logo_website   = $this->upload->data('file_name');
                $this->db->set('logo_website', $logo_website);
            } else {
                $this->db->set('tentang_perusahaan', $tentang_perusahaan);
                $this->db->set('nama_website', $nama_website);
                $this->db->where('id', $id);
                $this->db->update('tb_profil');
            }
        }
        $this->db->set('tentang_perusahaan', $tentang_perusahaan);
        $this->db->set('nama_website', $nama_website);
        $this->db->where('id', $id);
        $this->db->update('tb_profil');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">About Us berhasil diubah</div>');
        redirect('admin/about/index');
    }
}
