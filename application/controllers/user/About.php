<?php

class About extends CI_Controller
{
    public function index()
    {
        $data = [
            'judul'     => 'About',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'about'     => $this->db->get('tb_profil')->result_array()
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/about');
        $this->load->view('templates/user_footer');
    }
}
