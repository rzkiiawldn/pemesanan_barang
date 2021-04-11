<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        $data = [
            'judul'     => 'User',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'about'     => $this->db->get('tb_profil')->result_array(),
            'barang'    => $this->db->query("SELECT * FROM tb_barang ORDER BY id_brg DESC LIMIT 0, 4 ")
        ];
        $this->load->view('templates/user_header', $data);
        $this->load->view('user/index');
        $this->load->view('templates/user_footer');
    }
}
