<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    // Ambil semua data siswa dengan join tabel user, m_kelas, m_jurusan
   public function get_all()
{
    $this->db->select('
        m_siswa.id,
        m_siswa.id_user,
        m_siswa.id_kelas,
        m_kelas.id_jurusan,
        user.name AS nama_siswa,
        user.email,
        user.password,
        user.no_wa,
        m_siswa.tanggal_lahir,
        m_kelas.name AS nama_kelas,
        m_jurusan.name AS nama_jurusan
    ');
    $this->db->from('m_siswa');
    $this->db->join('user', 'm_siswa.id_user = user.id');   // <== Ganti id_user jadi id
    $this->db->join('m_kelas', 'm_siswa.id_kelas = m_kelas.id');
    $this->db->join('m_jurusan', 'm_kelas.id_jurusan = m_jurusan.id');
    $this->db->order_by('m_siswa.id', 'ASC');

    $query = $this->db->get();
    return $query->result();
}


     /**
     * Tambah data siswa baru.
     */
    public function insert($data)
    {
        // Pastikan array valid
        if (isset($data['id_user']) && isset($data['id_kelas'])) {
            return $this->db->insert('m_siswa', $data);
        }
        return false;
    }

    /**
     * Update data siswa berdasarkan ID.
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('m_siswa', $data);
    }

    /**
     * Hapus data siswa berdasarkan ID.
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('m_siswa');
    }

    public function get_filtered($kelas = null, $jurusan = null)
{
    $this->db->select('
        m_siswa.id,
        m_siswa.id_user,
        m_siswa.id_kelas,
        m_kelas.id_jurusan,
        user.name AS nama_siswa,
        user.email,
        user.password,
        user.no_wa, 
        m_siswa.tanggal_lahir,
        m_kelas.name AS nama_kelas,
        m_jurusan.name AS nama_jurusan
    ');
    $this->db->from('m_siswa');
    $this->db->join('user', 'm_siswa.id_user = user.id');
    $this->db->join('m_kelas', 'm_siswa.id_kelas = m_kelas.id');
    $this->db->join('m_jurusan', 'm_kelas.id_jurusan = m_jurusan.id');

    if (!empty($kelas)) {
        $this->db->where('m_kelas.id', $kelas); // ✅ pakai id
    }

    if (!empty($jurusan)) {
        $this->db->where('m_jurusan.name', $jurusan); // masih bisa pakai name karena dropdown-nya memang name
    }

    $this->db->order_by('m_siswa.id', 'ASC');
    return $this->db->get()->result();
}


}
