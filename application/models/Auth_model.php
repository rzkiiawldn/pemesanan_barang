<?php

class Auth_model extends CI_Model
{
    public function registrasi()
    {
        $data = [
            'nama'          => htmlspecialchars($this->input->post('nama', TRUE)),
            'email'         => htmlspecialchars($this->input->post('email', TRUE)),
            'telepon'       => htmlspecialchars($this->input->post('telepon', TRUE)),
            'alamat'        => htmlspecialchars($this->input->post('alamat', TRUE)),
            'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'foto'          => 'default.jpg',
            'id_role'       => 2,
            'date_created'  => time()
        ];
        $this->db->insert("tb_user", $data);
    }
}
