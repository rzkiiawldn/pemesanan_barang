<?php

class User_model extends CI_Model
{
    public function getData($id_user = null)
    {
        if ($id_user != null) {
            return $this->db->get_where('tb_user', ['id_user' => $id_user]);
        }
        return $this->db->get_where('tb_user', ['id_role !=' => 1]);
    }

    public function tambah_user()
    {
        $foto = $_FILES['foto'];
        if ($foto = '') {
        } else {
            $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
            $config['max_size']         = '2048';
            $config['upload_path']      = './assets/user/img/profil/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $foto   = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Tambah Foto gagal, silahkan cek file yang anda masukan</div>');
                redirect('admin/user');
            }
        }
        $data = [
            'nama'          => htmlspecialchars($this->input->post('nama')),
            'email'         => htmlspecialchars($this->input->post('email')),
            'telepon'       => htmlspecialchars($this->input->post('telepon')),
            'alamat'        => htmlspecialchars($this->input->post('alamat')),
            'password'      => htmlspecialchars(password_hash($this->input->post('password'), PASSWORD_DEFAULT)),
            'foto'          => $foto,
            'id_role'       => 2,
            'date_created'  => time()
        ];
        $this->db->insert('tb_user', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user berhasil ditambah</div>');
    }

    public function edit_user($id_user, $fotoLama)
    {
        $nama            = htmlspecialchars($this->input->post('nama'));
        $telepon         = htmlspecialchars($this->input->post('telepon'));
        $alamat          = htmlspecialchars($this->input->post('alamat'));
        $foto = $_FILES['foto'];
        if ($foto = '') {
            $config['allowed_types']    = 'jpg|PNG|png|jpeg|JPG|JPEG';
            $config['max_size']         = '2048';
            $config['upload_path']      = './assets/user/img/profil/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $old_gambar         = $fotoLama;
                if ($old_gambar     != 'default.jpg') {
                    unlink(FCPATH . 'assets/user/img/profil/' . $old_gambar);
                }
                $foto   = $this->upload->data('file_name');
                $this->db->set('foto', $foto);
            } else {
                $this->db->set('nama', $nama);
                $this->db->set('telepon', $telepon);
                $this->db->set('alamat', $alamat);
                $this->db->where('id_user', $id_user);
                $this->db->update('tb_user');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user berhasil di edit</div>');
            }
        }
        $this->db->set('nama', $nama);
        $this->db->set('telepon', $telepon);
        $this->db->set('alamat', $alamat);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data user berhasil di edit</div>');
    }
}
