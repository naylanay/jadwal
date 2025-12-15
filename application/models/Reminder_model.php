<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil jadwal besok berdasarkan hari, semester, tahun ajaran
    public function get_jadwal_besok($hari, $semester, $tahunAjaran)
    {
        return $this->db
            ->where('hari', $hari)
            ->where('semester', $semester)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get('m_jadwal')
            ->result();
    }

    // Ambil daftar siswa di kelas tertentu
    public function get_siswa_by_kelas($id_kelas)
    {
        return $this->db
            ->select('m_siswa.*, user.name, user.no_wa')
            ->from('m_siswa')
            ->join('user', 'user.id = m_siswa.id_user')
            ->where('m_siswa.id_kelas', $id_kelas)
            ->get()
            ->result();
    }

    // Ambil jadwal lengkap mapel + jam untuk siswa
   public function get_jadwal_siswa($id_kelas, $hari, $semester, $tahunAjaran)
{
    return $this->db
        ->distinct() // tambahkan DISTINCT di sini, bukan di select
        ->select('m_mapel.name_mapel, m_jam_pelajaran.jam_mulai, m_jam_pelajaran.jam_selesai')
        ->from('m_jadwal')
        ->join('m_mapel', 'm_mapel.id = m_jadwal.id_mapel')
        ->join('m_jam_pelajaran', 'm_jam_pelajaran.id = m_jadwal.id_jam')
        ->where('m_jadwal.hari', $hari)
        ->where('m_jadwal.id_kelas', $id_kelas)
        ->where('m_jadwal.semester', $semester)
        ->where('m_jadwal.tahun_ajaran', $tahunAjaran)
        ->order_by('m_jadwal.id_jam', 'ASC')
        ->get()
        ->result();
}


    
}
