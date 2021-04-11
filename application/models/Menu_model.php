<?php

class Menu_model extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('tb_user_menu');
        if ($id != null) {
            $this->db->where('id_menu', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add()
    {
        $data = [
            'menu'          => htmlspecialchars($this->input->post('menu', TRUE))
        ];
        $this->db->insert("tb_user_menu", $data);
    }

    public function edit($id)
    {
        $data = [
            'menu'         => htmlspecialchars($this->input->post('menu', TRUE))
        ];
        $this->db->set($data);
        $this->db->where('id_menu', $id);
        $this->db->update('tb_user_menu');
    }

    public function del($id)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete('tb_user_menu');
    }

    // QUERY SUB MENU
    public function getSubMenu($id_sub = null)
    {
        if ($id_sub != null) {
            return $this->db->query("SELECT * FROM tb_user_sub_menu tusm JOIN tb_user_menu tum ON tusm.id_menu = tum.id_menu WHERE id_sub = '$id_sub'");
        }
        return $this->db->query("SELECT * FROM tb_user_sub_menu tusm JOIN tb_user_menu tum ON tusm.id_menu = tum.id_menu");
    }

    public function addSub()
    {
        $data = [
            'id_menu'        => htmlspecialchars($this->input->post('id_menu', TRUE)),
            'submenu'          => htmlspecialchars($this->input->post('submenu', TRUE)),
            'url'            => htmlspecialchars($this->input->post('url', TRUE)),
            'icon'           => htmlspecialchars($this->input->post('icon', TRUE)),
            'urutan'           => htmlspecialchars($this->input->post('urutan', TRUE)),
            'is_active'      => htmlspecialchars($this->input->post('is_active', TRUE))
        ];
        $this->db->insert("tb_user_sub_menu", $data);
    }

    public function editSub($id_sub)
    {
        $data = [
            'id_menu'        => htmlspecialchars($this->input->post('id_menu', TRUE)),
            'submenu'          => htmlspecialchars($this->input->post('submenu', TRUE)),
            'url'            => htmlspecialchars($this->input->post('url', TRUE)),
            'icon'           => htmlspecialchars($this->input->post('icon', TRUE)),
            'urutan'           => htmlspecialchars($this->input->post('urutan', TRUE)),
            'is_active'      => htmlspecialchars($this->input->post('is_active', TRUE))
        ];
        $this->db->set($data);
        $this->db->where('id_sub', $id_sub);
        $this->db->update('tb_user_sub_menu');
    }

    public function delSub($id_sub)
    {
        $this->db->where('id_sub', $id_sub);
        $this->db->delete('tb_user_sub_menu');
    }

    public function editRole($id_role)
    {
        $data = [
            'role'         => htmlspecialchars($this->input->post('role', TRUE))
        ];
        $this->db->set($data);
        $this->db->where('id_role', $id_role);
        $this->db->update('tb_role');
    }

    public function addRole()
    {
        $data = [
            'role'         => htmlspecialchars($this->input->post('role', TRUE))
        ];
        $this->db->insert('tb_role', $data);
    }

    public function delRole($id_role)
    {
        $this->db->where('id_role', $id_role);
        $this->db->delete('tb_role');
    }
}
