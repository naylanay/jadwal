<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public $Jadwal_model;
    public $db;
    public function __construct() {
        parent::__construct();
        $this->load->model('Jadwal_model');
    }

    // Halaman utama untuk memilih kelas, semester, tahun ajaran
    public function index() {
        $data['title'] = 'jadwal';
        $data['kelas'] = $this->Jadwal_model->getKelasWithJurusan();
                $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemenjadwal/jadwal', $data);
        $this->load->view('templates/footer');
        // Load view dari folder masterdata
    }

    // Mendapatkan jadwal sesuai filter, via AJAX
    public function get_jadwal_filtered() {
        $id_kelas = $this->input->post('id_kelas');
        $semester = $this->input->post('semester');
        $tahun_ajaran = $this->input->post('tahun_ajaran');

        if (!$id_kelas || !$semester || !$tahun_ajaran) {
            echo '<div class="alert alert-danger">Parameter tidak lengkap.</div>';
            return;
        }

        $jadwal = $this->Jadwal_model->getJadwalByKelasSemesterTahun($id_kelas, $semester, $tahun_ajaran);

        $data['jadwal'] = $jadwal;
        $data['jam_pelajaran'] = $this->Jadwal_model->getJamPelajaran();

        // Load partial view dari folder masterdata
        $this->load->view('manajemenjadwal/partial_jadwal_table', $data);
    }
}
