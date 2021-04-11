<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
