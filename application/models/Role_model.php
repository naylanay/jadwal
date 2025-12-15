<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
    private $table = 'user_role';

    public function getAllRoles() {
        return $this->db->get('user_role')->result_array();
    }

    public function addRole($data) {
        return $this->db->insert('user_role', $data);
    }

    public function getRoleById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function updateRole()
    {
        $data = [
            'role' => $this->input->post('role', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update($this->table, $data);
    }
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_role');
    }
}
