<?php

class Barang_model extends CI_Model
{
    public function getBarang($id_brg = null)
    {
        if ($id_brg != null) {
            return $this->db->get_where('tb_barang', ['id_brg' => $id_brg]);
        }
        $this->db->order_by('id_brg', 'DESC');
        return $this->db->get('tb_barang');
    }

    public function getVariasiBarang($id_brg = null)
    {
        if ($id_brg != null) {
            return $this->db->get_where('tb_variasi', ['id_brg' => $id_brg]);
        }
    }
    public function getVariasiBarangById($id)
    {
        return $this->db->get_where('tb_variasi', ['id_variasi' => $id])->result();
    }

    public function getPemesanan($id_pemesanan = null)
    {
        if ($id_pemesanan != null) {
            $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
            return $this->db->get_where('tb_pemesanan ', ['id_pemesanan' => $id_pemesanan]);
        }
        $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get_where('tb_pemesanan', ['status_pemesanan !=' => 'Selesai']);
    }

    public function getPemesananUser($id_user, $id_pemesanan = null)
    {
        if ($id_pemesanan != null) {
            $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
            return $this->db->get_where('tb_pemesanan ', [
                'tb_pemesanan.id_pemesanan'  => $id_pemesanan,
                'tb_pemesanan.id_user'       => $id_user
            ]);
        }
        $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get_where('tb_pemesanan ', ['tb_pemesanan.id_user' => $id_user]);
    }

    public function notif_pemesanan()
    {
        $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get_where('tb_pemesanan', ['status_pemesanan !=' => 'Selesai']);
    }

    public function transaksi_selesai()
    {
        $this->db->join('tb_user', 'tb_pemesanan.id_user = tb_user.id_user');
        $this->db->order_by('id_pemesanan', 'DESC');
        return $this->db->get_where('tb_pemesanan', ['status_pemesanan' => 'Selesai']);
    }

    public function tambah_barang()
    {
        $data = [
            'nama_barang'       => htmlspecialchars($this->input->post('nama_barang')),
            'harga_barang'      => htmlspecialchars($this->input->post('harga_barang')),
            'keterangan'        => $this->input->post('keterangan'),
            'foto_barang'       => htmlspecialchars($this->input->post('foto_barang')),
        ];
        $this->db->insert('tb_barang', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data barang berhasil ditambah</div>');
    }

    public function edit_barang($id_brg)
    {
        $nama_barang            = htmlspecialchars($this->input->post('nama_barang'));
        $harga_barang           = htmlspecialchars($this->input->post('harga_barang'));
        $keterangan             = $this->input->post('keterangan');
        $foto_barang            = htmlspecialchars($this->input->post('foto_barang'));
        $this->db->set('nama_barang', $nama_barang);
        $this->db->set('harga_barang', $harga_barang);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('foto_barang', $foto_barang);
        $this->db->where('id_brg', $id_brg);
        $this->db->update('tb_barang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data barang berhasil di edit</div>');
    }

    // User
    public function pesan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = [
            'id_user'           => htmlspecialchars($this->input->post('id_user')),
            'alamat_pemasangan'  => $this->input->post('alamat_pemasangan'),
            'tanggal_pemesanan' => date('Y-m-d H:m:s'),
            'nama_barang'       => htmlspecialchars($this->input->post('nama_barang')),
            'harga_barang'      => htmlspecialchars($this->input->post('harga_barang')),
            'panjang'           => htmlspecialchars($this->input->post('panjang')),
            'lebar'             => htmlspecialchars($this->input->post('lebar')),
            'total_harga'       => htmlspecialchars($this->input->post('total_harga')),
            'status_pemesanan'  => 'Menunggu Pembayaran',
            'bukti_pembayaran'  => null
        ];
        $this->db->insert('tb_pemesanan', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pesanan anda berhasil, silahkan lakukan pembarayan</div>');
    }

    public function batalkan_pesanan($id_pemesanan)
    {
        $this->db->delete('tb_pemesanan', ['id_pemesanan' => $id_pemesanan]);
    }
}
