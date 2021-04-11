<?php

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }

    public function index()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom %s Tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'     => 'Menu Management',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'dataMenu'  => $this->menu_model->get()->result_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/index');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->add();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan</div>');
            redirect('admin/menu/index');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'     => 'Menu Management',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'dataMenu'  => $this->menu_model->get()->result_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/index');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->edit($id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu berhasil di ubah</div>');
            redirect('admin/menu/index');
        }
    }

    public function delete($id)
    {
        $this->menu_model->del($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Menu berhasil dihapus</div>');
        redirect('admin/menu/index');
    }

    // SUBMENU
    public function submenu()
    {
        $this->form_validation->set_rules('submenu', 'submenu', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('urutan', 'urutan', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom %s Tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'         => 'Submenu Management',
                'user'          => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'dataMenu'      => $this->menu_model->get()->result_array(),
                'dataSubMenu'   => $this->menu_model->getSubMenu()->result_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/submenu');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->addSub();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu baru berhasil ditambahkan</div>');
            redirect('admin/menu/submenu');
        }
    }

    public function editSub($id_sub)
    {
        $this->form_validation->set_rules('submenu', 'submenu', 'required|trim');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        $this->form_validation->set_rules('urutan', 'urutan', 'required|trim');
        $this->form_validation->set_message('required', 'Kolom %s Tidak boleh kosong');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'     => 'Menu Management',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'dataMenu'  => $this->menu_model->get()->result_array(),
                'dataSubMenu'   => $this->menu_model->getSubMenu()->result_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/submenu');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->editSub($id_sub);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu berhasil di ubah</div>');
            redirect('admin/menu/submenu');
        }
    }

    public function deleteSub($id_sub)
    {
        $this->menu_model->delSub($id_sub);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">SubMenu berhasil dihapus</div>');
        redirect('admin/menu/submenu');
    }

    public function menu_akses()
    {
        $this->form_validation->set_rules('role', 'role', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'     => 'Menu Access',
                'dataRole'  => $this->db->get('tb_role')->result_array(),
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/menu_akses');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->addRole();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Nama Role berhasil di tambah</div>');
            redirect('admin/menu/menu_akses');
        }
    }

    public function editRole($id_role)
    {
        $this->form_validation->set_rules('role', 'role', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'judul'     => 'Role',
                'dataRole'  => $this->db->get('tb_role')->result_array(),
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/menu/menu_akses');
            $this->load->view('templates/admin_footer');
        } else {
            $this->menu_model->editRole($id_role);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Nama Role berhasil di ubah</div>');
            redirect('admin/menu/menu_akses');
        }
    }

    public function deleteRole($id_role)
    {
        $this->menu_model->delRole($id_role);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">role berhasil dihapus</div>');
        redirect('admin/menu/menu_akses');
    }

    public function hak_akses($id_role)
    {
        $data = [
            'judul'     => 'Menu Access',
            // query data menu, kecualikan data admin
            'dataMenu'  => $this->db->get_where('tb_user_menu', ['id_menu !=' => 1])->result_array(),
            'dataRole'  => $this->db->get_where('tb_role', ['id_role' => $id_role])->row_array(),
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/menu/hak_akses');
        $this->load->view('templates/admin_footer');
    }

    public function ubahAkses()
    {
        $id_menu    = $this->input->post('menuId');
        $id_role   = $this->input->post('roleId');

        $data = [
            'id_role'  => $id_role,
            'id_menu'   => $id_menu
        ];

        $result = $this->db->get_where('tb_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tb_user_access_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Hak akses berhasil ditambah</div>');
        } else {
            $this->db->delete('tb_user_access_menu', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Hak akses berhasil dihapus</div>');
        }
    }
}
