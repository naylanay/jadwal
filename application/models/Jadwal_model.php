<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    /**
     * Mengambil data kelas beserta nama jurusannya (join)
     *
     * @return array objek kelas dengan jurusan
     */
    public function getKelasWithJurusan() {
        $this->db->select('m_kelas.id, m_kelas.name AS nama_kelas, m_jurusan.name AS nama_jurusan');
        $this->db->from('m_kelas');
        $this->db->join('m_jurusan', 'm_kelas.id_jurusan = m_jurusan.id', 'left');
        $this->db->order_by('m_kelas.name', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Mendapatkan jadwal pelajaran berdasarkan kelas, semester, dan tahun ajaran
     *
     * Output format array multidimensi seperti:
     * [
     *   '07:00-08:30' => [
     *       'Senin' => ['mapel' => 'Matematika'],
     *       'Selasa' => ['mapel' => 'Bahasa Inggris'],
     *       ...
     *   ],
     *   ...
     * ]
     *
     * @param int $id_kelas
     * @param string $semester
     * @param string $tahun_ajaran
     * @return array jadwal terstruktur
     */
    public function getJadwalByKelasSemesterTahun($id_kelas, $semester, $tahun_ajaran) {
        $this->db->select('m_jadwal.id,m_jadwal.hari, m_jam_pelajaran.jam_mulai, m_jam_pelajaran.jam_selesai, m_mapel.name_mapel AS nama_mapel');
        $this->db->from('m_jadwal');
        $this->db->join('m_mapel', 'm_jadwal.id_mapel = m_mapel.id', 'left');
        $this->db->join('m_jam_pelajaran', 'm_jadwal.id_jam = m_jam_pelajaran.id', 'left');
        $this->db->where('m_jadwal.id_kelas', $id_kelas);
        $this->db->where('m_jadwal.semester', $semester);
        $this->db->where('m_jadwal.tahun_ajaran', $tahun_ajaran);
        $this->db->order_by('FIELD(m_jadwal.hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat")');
        $this->db->order_by('m_jam_pelajaran.jam_mulai', 'ASC');

        $query = $this->db->get();

        $jadwal = [];

        foreach ($query->result() as $row) {
            $jamMulai = $row->jam_mulai ? date('H:i', strtotime($row->jam_mulai)) : '--:--';
            $jamSelesai = $row->jam_selesai ? date('H:i', strtotime($row->jam_selesai)) : '--:--';
            $jam = $jamMulai . '-' . $jamSelesai;

            // $jam = date('H:i', strtotime($row->jam_mulai)) . '-' . date('H:i', strtotime($row->jam_selesai));
            $jadwal[$jam][$row->hari] = [
                'id' => $row->id, // 🔹 tambahkan ID di sini
                'mapel' => $row->nama_mapel ?? '-'
            ];
        }

        return $jadwal;
    }

    // Pastikan fungsi ini juga ada
    public function getAllMapel() {
        return $this->db->get('m_mapel')->result_array(); 
    }
    
    // Pastikan fungsi ini juga ada
    public function simpanJadwal($data) {
        return $this->db->insert('m_jadwal', $data); 
    }

    public function getJamPelajaran()
{
    $this->db->select('id, jam_mulai, jam_selesai');
    $this->db->from('m_jam_pelajaran');
    $this->db->order_by('jam_mulai', 'ASC');
    $query = $this->db->get();

    // Bentuk format jam: "07:00-08:30"
    $result = [];
    foreach ($query->result() as $row) {
        // Cek apakah jam_mulai dan jam_selesai ada/null
        $jamMulai = $row->jam_mulai ? date('H:i', strtotime($row->jam_mulai)) : '--:--';
        $jamSelesai = $row->jam_selesai ? date('H:i', strtotime($row->jam_selesai)) : '--:--';

        $result[$row->id] = $jamMulai . '-' . $jamSelesai;
    }
    return $result;
}

public function getJadwalById($id) {
    $this->db->select('m_jadwal.*, m_kelas.name AS nama_kelas, m_mapel.name_mapel AS nama_mapel');
    $this->db->from('m_jadwal');
    $this->db->join('m_kelas', 'm_jadwal.id_kelas = m_kelas.id');
    $this->db->join('m_mapel', 'm_jadwal.id_mapel = m_mapel.id');
    $this->db->where('m_jadwal.id', $id);
    return $this->db->get()->row_array();
}

public function updateJadwal($id, $data)
{
    $this->db->where('id', $id);
    $this->db->update('m_jadwal', $data);
}




}
