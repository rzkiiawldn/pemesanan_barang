<?php

class Barang extends CI_Controller
{
    public function data_barang()
    {
        $data = [
            'judul'     => 'Data Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'barang'    => $this->barang_model->getBarang()
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/data_barang');
        $this->load->view('templates/user_footer');
    }

    public function detail_barang($id_brg)
    {
        $data = [
            'judul'     => 'Detail Barang',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'barang'    => $this->barang_model->getBarang($id_brg)->row_array(),
            'variasi'   => $this->barang_model->getVariasiBarang($id_brg)
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/detail_barang');
        $this->load->view('templates/user_footer');
    }

    public function pesan($id_brg)
    {
        belum_login();
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul'     => 'Form Pemesanan',
                'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
                'barang'    => $this->barang_model->getBarang($id_brg)->row_array(),
                'variasi'   => $this->barang_model->getVariasiBarang($id_brg)
            ];

            $this->load->view('templates/user_header', $data);
            $this->load->view('user/pesan_barang');
            $this->load->view('templates/user_footer');
        } else {
            print "berhasil";
        }
    }

    public function proses()
    {
        belum_login();
        $id_brg = $this->input->post('id_brg');
        $this->form_validation->set_rules('alamat_pemasangan', 'Alamat Pemasangan', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->pesan($id_brg);
        } else {
            $this->barang_model->pesan();
            redirect('user/barang/data_pemesanan');
        }
    }

    public function data_pemesanan()
    {
        belum_login();
        $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $user['id_user'];
        $data = [
            'judul'     => 'Riwayat Pemesanan',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'pemesanan' => $this->barang_model->getPemesananUser($id_user)
            // 'pemesanan' => $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user WHERE tb_pemesanan.id_user = $id_user")
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/data_pemesanan');
        $this->load->view('templates/user_footer');
    }

    public function batalkan($id_pemesanan)
    {
        belum_login();
        $this->barang_model->batalkan_pesanan($id_pemesanan);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pemesanan berhasil dibatalkan</div>');
        redirect('user/barang/data_pemesanan');
    }

    public function upload_bukti($id_pemesanan)
    {
        belum_login();
        // Mengambil data user untuk menghapus gambar yang lama 
        $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $user['id_user'];
        $pemesanan = $this->db->get_where('tb_pemesanan', [
            'id_user' => $id_user,
            'id_pemesanan' => $id_pemesanan
        ])->row_array();
        // end

        $bukti_pembayaran = $_FILES['bukti_pembayaran'];
        if ($bukti_pembayaran = '') {
        } else {
            $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
            $config['max_size']         = '2048';
            $config['upload_path']      = './assets/user/img/bukti_pembayaran/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $old_gambar         = $pemesanan['bukti_pembayaran'];
                if ($old_gambar     != 'default.jpg') {
                    unlink(FCPATH . 'assets/user/img/bukti_pembayaran/' . $old_gambar);
                }
                $bukti_pembayaran   = $this->upload->data('file_name');
                $this->db->set('bukti_pembayaran', $bukti_pembayaran);
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Upload bukti gagal, silahkan cek file yang anda masukan</div>');
                redirect('user/barang/data_pemesanan');
            }
        }
        $this->db->set('status_pemesanan', 'Menunggu Konfirmasi');
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->update('tb_pemesanan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Upload bukti berhasil, pesanan segera diproses</div>');
        redirect('user/barang/data_pemesanan');
    }

    public function detail_pemesanan($id_pemesanan)
    {
        belum_login();
        $user = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $user['id_user'];
        $data = [
            'judul'     => 'Detail Pemesanan',
            'user'      => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'pemesanan' => $this->barang_model->getPemesananUser($id_user, $id_pemesanan)->row_array(),
            'data_pemesanan' => $this->barang_model->getPemesananUser($id_user)
            // 'pemesanan' => $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user WHERE tb_pemesanan.id_user = $id_user")
        ];

        $this->load->view('templates/user_header', $data);
        $this->load->view('user/detail_pemesanan');
        $this->load->view('templates/user_footer');
    }

    public function  invoice($id_pemesanan)
    {
        $this->load->library('dompdf_gen');
        $data['judul']      = "Cetak Data";
        $data['pemesanan']  = $this->db->query("SELECT * FROM tb_pemesanan JOIN tb_user ON tb_pemesanan.id_user = tb_user.id_user WHERE id_pemesanan = $id_pemesanan")->row_array();
        $this->load->view('user/invoice', $data);
        // menentukan ukuran kertas
        $paper_size     = 'A4';
        $orientation    = 'landscape';
        $html           = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('invoice.pdf', ['Attachment' => 0]);
    }
}
