<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_jadwal_model extends CI_Model
{
    // ambil semua deskripsi berdasarkan id_mapel
    public function getDeskripsiByMapelId($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('detail_jadwal');
        $this->db->where('id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->result_array(); // karena banyak baris deskripsi
    }

    // tambah deskripsi baru
    public function insertDeskripsi($data)
    {
        $this->db->insert('detail_jadwal', $data);
    }

    // hapus deskripsi
    public function deleteDeskripsi($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('detail_jadwal');
    }

    public function updateDeskripsi($id, $data)
{
    $this->db->where('id', $id);
    $this->db->update('detail_jadwal', $data);
}

}
