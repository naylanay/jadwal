<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{
    public function getAllJurusan()
    {
        return $this->db->get('m_jurusan')->result_array();
    }

    public function getJurusanById($id)
    {
        return $this->db->get_where('m_jurusan', ['id' => $id])->row_array();
    }

    public function deleteJurusan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('m_jurusan');
    }

    public function addJurusan($data)
    {
        $this->db->insert('m_jurusan', $data);
    }

     public function updateJurusan($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('m_jurusan', $data);
    }

}
