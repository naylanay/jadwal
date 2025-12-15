<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    public function getAllMapel()
    {
        $this->db->select('m_mapel.*, m_kelas.name');  // ganti alias kelas jadi m_kelas
        $this->db->from('m_mapel');
        $this->db->join('m_kelas', 'm_mapel.id_kelas = m_kelas.id', 'left');
        return $this->db->get()->result_array();
    }

    public function getMapelById($id)
    {
        return $this->db->get_where('m_mapel', ['id' => $id])->row_array();
    }

    public function insertMapel($data)
    {
        $this->db->insert('m_mapel', $data);
    }

    public function updateMapel($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('m_mapel', $data);
    }

    public function deleteMapel($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('m_mapel');
    }

    // di Mapel_model.php
public function getMapelByKelas($id_kelas = null)
{
    $this->db->select('m_mapel.*, m_kelas.name');
    $this->db->from('m_mapel');
    $this->db->join('m_kelas', 'm_mapel.id_kelas = m_kelas.id', 'left');

    if ($id_kelas) {
        $this->db->where('m_mapel.id_kelas', $id_kelas);
    }

    $query = $this->db->get();
    return $query->result_array();
}

}


