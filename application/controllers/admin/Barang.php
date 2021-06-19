<?php

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        belum_login();
    }
    public function index()
    {
        $data = [
            'judul'     => 'Data Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'barang'    => $this->barang_model->getBarang()->result_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/data_barang1');
        $this->load->view('templates/admin_footer');
    }

    public function tambah_barang()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan Barang', 'required|trim');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong');
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul'     => 'Data Barang',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'barang'    => $this->barang_model->getBarang()->result_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/barang/tambah_barang');
            $this->load->view('templates/admin_footer');
        } else {

            $foto_barang = $_FILES['foto_barang'];
            if ($foto_barang = '') {
            } else {
                $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/user/img/barang/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_barang')) {
                    $foto_barang   = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Tambah Foto_barang gagal, silahkan cek file yang anda masukan</div>');
                    redirect('admin/barang/index');
                }
            }
            $data_barang = [
                'nama_barang'       => $this->input->post('nama_barang'),
                'harga_barang'      => $this->input->post('harga_barang'),
                'keterangan'        => $this->input->post('keterangan'),
                'foto_barang'       => $foto_barang
            ];
            $id = $this->db->insert('tb_barang', $data_barang);

            $id_brg = $this->db->insert_id($id);

            $data_barang2 = [
                'id_brg'        => $id_brg,
                'nama_variasi'     => $this->input->post('nama_barang'),
                'harga_variasi'      => $this->input->post('harga_barang'),
                'foto_variasi'       => $foto_barang
            ];
            $this->db->insert('tb_variasi', $data_barang2);
            redirect('admin/barang/index');
        }
    }

    public function tambah_variasi($id_brg)
    {
        $this->form_validation->set_rules('nama_variasi', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga_variasi', 'Harga Barang', 'required|trim');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong');
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul'     => 'Data Barang',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'barang'    => $this->barang_model->getBarang($id_brg)->row_array()
            ];
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/barang/tambah_variasi');
            $this->load->view('templates/admin_footer');
        } else {
            $foto_variasi = $_FILES['foto_variasi'];
            if ($foto_variasi = '') {
            } else {
                $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/user/img/barang/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_variasi')) {
                    $foto_variasi   = $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Tambah foto variasi gagal, silahkan cek file yang anda masukan</div>');
                    redirect('admin/barang/index');
                }
            }
            $data_variasi = [
                'id_brg'             => $this->input->post('id_brg'),
                'nama_variasi'       => $this->input->post('nama_variasi'),
                'harga_variasi'      => $this->input->post('harga_variasi'),
                'foto_variasi'       => $foto_variasi
            ];
            $this->db->insert('tb_variasi', $data_variasi);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Barang berhasil ditambah</div>');
            redirect('admin/barang/detail_barang/' . $id_brg);
        }
    }

    public function detail_barang($id_brg)
    {
        $data = [
            'judul'     => 'Detail Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'barang'    => $this->barang_model->getBarang($id_brg)->row_array(),
            'variasi'   => $this->db->query("SELECT * FROM tb_variasi WHERE id_brg = $id_brg LIMIT 1, 200")
            // 'variasi'   => $this->db->get_where('tb_variasi', ['id_brg' => $id_brg])
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/detail_barang');
        $this->load->view('templates/admin_footer');
    }

    public function edit_barang($id_brg)
    {
        $data = [
            'judul'     => 'Data Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'barang'    => $this->barang_model->getBarang($id_brg)->row_array()
        ];
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan Barang', 'required|trim');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/barang/edit_barang');
            $this->load->view('templates/admin_footer');
        } else {
            $nama_barang       = $this->input->post('nama_barang');
            $harga_barang      = $this->input->post('harga_barang');
            $keterangan        = $this->input->post('keterangan');
            $foto_barang = $_FILES['foto_barang'];
            if ($foto_barang = '') {
            } else {
                $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/user/img/barang/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_barang')) {
                    $old_gambar         = $data['barang']['foto_barang'];
                    if ($old_gambar     != 'default.jpg') {
                        unlink(FCPATH . 'assets/user/img/barang/' . $old_gambar);
                    }
                    $foto_barang   = $this->upload->data('file_name');
                    $this->db->set('foto_barang', $foto_barang);
                } else {
                    $this->db->set('nama_barang', $nama_barang);
                    $this->db->set('harga_barang', $harga_barang);
                    $this->db->set('keterangan', $keterangan);
                    $this->db->where('id_brg', $id_brg);
                    $this->db->update('tb_barang');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Edit data barang berhasil</div>');
                    redirect('admin/barang/index');
                }
            }
            $this->db->set('nama_barang', $nama_barang);
            $this->db->set('harga_barang', $harga_barang);
            $this->db->set('keterangan', $keterangan);
            $this->db->where('id_brg', $id_brg);
            $this->db->update('tb_barang');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Edit data barang berhasil</div>');
            redirect('admin/barang/index');
        }
    }

    public function edit_variasi($id_variasi)
    {
        $id_brg = $this->input->post('id_brg');
        $data = [
            'judul'     => 'Data Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'variasi'    => $this->db->get_where('tb_variasi', ['id_variasi' => $id_variasi])->row_array()
        ];
        $this->form_validation->set_rules('nama_variasi', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('harga_variasi', 'Harga Barang', 'required|trim');
        $this->form_validation->set_message('required', '%s Tidak boleh kosong');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/barang/detail_barang/' . $id_brg);
            $this->load->view('templates/admin_footer');
        } else {
            $nama_variasi       = $this->input->post('nama_variasi');
            $harga_variasi      = $this->input->post('harga_variasi');
            $foto_variasi       = $_FILES['foto_variasi'];
            if ($foto_variasi = '') {
            } else {
                $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/user/img/barang/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto_variasi')) {
                    $old_gambar         = $data['barang']['foto_variasi'];
                    if ($old_gambar     != 'default.jpg') {
                        unlink(FCPATH . 'assets/user/img/barang/' . $old_gambar);
                    }
                    $foto_variasi   = $this->upload->data('file_name');
                    $this->db->set('foto_variasi', $foto_variasi);
                } else {
                    $this->db->set('nama_variasi', $nama_variasi);
                    $this->db->set('harga_variasi', $harga_variasi);
                    $this->db->where('id_variasi', $id_variasi);
                    $this->db->update('tb_variasi');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Edit data barang variasi berhasil</div>');
                    redirect('admin/barang/detail_barang/' . $id_brg);
                }
            }
            $this->db->set('nama_variasi', $nama_variasi);
            $this->db->set('harga_variasi', $harga_variasi);
            $this->db->where('id_variasi', $id_variasi);
            $this->db->update('tb_variasi');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Edit data barang variasi berhasil</div>');
            redirect('admin/barang/detail_barang/' . $id_brg);
        }
    }

    public function hapus_barang($id_brg)
    {
        $this->db->where('id_brg', $id_brg);
        $this->db->delete('tb_barang');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat! kamu berhasil menghapus data barang</div>');
        redirect('admin/barang/index');
    }

    public function hapus_variasi($id_variasi)
    {
        $id_brg = $this->input->post('id_brg');
        $this->db->where('id_variasi', $id_variasi);
        $this->db->delete('tb_variasi');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat! kamu berhasil menghapus data variasi</div>');
        redirect('admin/barang/detail_barang/' . $id_brg);
    }

    public function hapus_pemesanan($id_pemesanan)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->delete('tb_pemesanan');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat! kamu berhasil menghapus data pemesanan</div>');
        redirect('admin/barang/data_pemesanan/');
    }

    public function proses($id_brg = null)
    {
        if (isset($_POST['tambah'])) {
            $this->barang_model->tambah_barang();
        } elseif (isset($_POST['edit'])) {
            $this->barang_model->edit_barang($id_brg);
        }
        redirect('admin/barang/index');
    }

    public function billboard()
    {
        $data = [
            'judul'     => 'Bill Board',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/data_billboard');
        $this->load->view('templates/admin_footer');
    }
    public function neonboard()
    {
        $data = [
            'judul'     => 'Neon Board',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/data_neonboard');
        $this->load->view('templates/admin_footer');
    }
    public function data_pemesanan()
    {
        $data = [
            'judul'     => 'Data Pemesanan',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'pemesanan' => $this->barang_model->getPemesanan()->result_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/data_pemesanan');
        $this->load->view('templates/admin_footer');
    }

    public function transaksi_selesai()
    {
        $data = [
            'judul'     => 'Transaksi Selesai',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'pemesanan' => $this->barang_model->transaksi_selesai()->result_array()
        ];
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/transaksi_selesai');
        $this->load->view('templates/admin_footer');
    }

    public function detail_pemesanan($id_pemesanan)
    {
        $data = [
            'judul'     => 'Detail Pemesanan',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'pemesanan' => $this->barang_model->getPemesanan($id_pemesanan)->row_array()
            // 'pemesanan' => $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user WHERE tb_pemesanan.id_user = $id_user")
        ];

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/barang/detail_pemesanan');
        $this->load->view('templates/admin_footer');
    }

    public function download_desain($desain)
    {
        force_download('assets/user/img/desain/' . $desain, NULL);
    }

    public function selesai($id_pemesanan)
    {
        $this->db->set('status_pemesanan', $this->input->post('status_pemesanan'));
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->update('tb_pemesanan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pesanan selesai</div>');
        redirect('admin/barang/data_pemesanan');
    }

    // public function cetak_data()
    // {
    //     $data['pemesanan'] = $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user")->result_array();
    //     $this->load->view('admin/barang/cetak_data', $data);
    // }

    public function cetak_data()
    {
        $this->load->library('dompdf_gen');
        $data['judul']      = "Cetak Data";
        $data['user']       = $this->db->get_where('tb_user', ['id_role !=' => 1])->result_array();
        $data['pemesanan']  = $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user")->result_array();
        $this->load->view('admin/barang/cetak_data', $data);
        // menentukan ukuran kertas
        $paper_size     = 'A4';
        $orientation    = 'landscape';
        $html           = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_data_pemesanan.pdf', ['Attachment' => 0]);
    }
}
