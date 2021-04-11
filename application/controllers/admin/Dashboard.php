<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }
    public function index()
    {
        $data = [
            'judul'     => 'Dashboard',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/index');
        $this->load->view('templates/admin_footer');
    }
}
