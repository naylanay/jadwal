<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    public function getAllKelas()
    {
        // Join dengan jurusan untuk menampilkan nama jurusan
        $this->db->select('m_kelas.*, m_jurusan.name as nama_jurusan');
        $this->db->from('m_kelas');
        $this->db->join('m_jurusan', 'm_jurusan.id = m_kelas.id_jurusan');
        return $this->db->get()->result_array();
    }

    public function addKelas($data)
    {
        $this->db->insert('m_kelas', $data);
    }

    public function getKelasById($id)
    {
        return $this->db->get_where('m_kelas', ['id' => $id])->row_array();
    }

    public function updateKelas($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('m_kelas', $data);
    }

    public function deleteKelas($id)
    {
        $this->db->delete('m_kelas', ['id' => $id]);
    }

    public function getKelasByJurusan($id_jurusan = null)
{
    $this->db->select('m_kelas.*, m_jurusan.name as nama_jurusan');
    $this->db->from('m_kelas');
    $this->db->join('m_jurusan', 'm_kelas.id_jurusan = m_jurusan.id', 'left');

    if ($id_jurusan) {
        $this->db->where('m_kelas.id_jurusan', $id_jurusan);
    }

    $query = $this->db->get();
    return $query->result_array();
}

}
