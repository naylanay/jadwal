<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManajemenJadwal extends CI_Controller {

    public $Jadwal_model;
    public $db;
    public function __construct() {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->library('form_validation');
    }

    // Menampilkan formulir input jadwal
    public function index() {
    $data['title'] = 'Input Jadwal Baru';
    $data['user'] = [$this->db->get_where('user', [
             'email' => $this->session->userdata('email')
         ])->row_array()];
    
    // 1. Matikan dulu pemanggilan model
    // $data['kelas'] = $this->Jadwal_model->getKelasWithJurusan(); 
    // $data['mapel'] = $this->Jadwal_model->getAllMapel(); 
    
    // 2. Matikan dulu pemanggilan data user
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
    // 3. Set variabel agar view tidak error karena variabel kosong
    $data['kelas'] = $this->Jadwal_model->getKelasWithJurusan(); 
    $data['mapel'] = $this->Jadwal_model->getAllMapel(); 
    $data['jam_pelajaran'] = $this->Jadwal_model->getJamPelajaran(); // 🔹 Tambahkan ini
    //$data['user'] = ['email' => '', 'nama' => 'Guest']; // Minimal array agar tidak error

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('masterdata/input_jadwal', $data); 
    $this->load->view('templates/footer');
}

    // Memproses data dari formulir
    public function tambah_jadwal() {
        // ... (Logika validasi dan penyimpanan tidak berubah) ...
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('id_mapel', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('id_jam', 'Jam Pelajaran', 'required'); // 🔹 Ganti validasi jam

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'id_kelas'      => $this->input->post('id_kelas', TRUE),
                'id_mapel'      => $this->input->post('id_mapel', TRUE),
                'hari'          => $this->input->post('hari', TRUE),
                'id_jam'        => $this->input->post('id_jam', TRUE), // 🔹 Ambil dari dropdown
                'tahun_ajaran'  => $this->input->post('tahun_ajaran', TRUE),
                'semester'      => $this->input->post('semester', TRUE)
            ];

            $this->Jadwal_model->simpanJadwal($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jadwal berhasil ditambahkan!</div>');
            redirect('jadwal'); 
        }
    }

    public function edit($id)
{
    $data['title'] = 'Edit Jadwal Pelajaran';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
     ])->row_array();

     // 👇 Tambahkan Baris Ini SEBELUM load view 👇
    if (!$data['user']) {
        // Jika data user tidak ditemukan, set array minimal agar template tidak crash
        $data['user'] = ['nama' => 'User Tidak Ditemukan', 'role_id' => 0];
    }
    // Ambil data jadwal beserta nama kelas dan nama mapel
    $data['jadwal'] = $this->Jadwal_model->getJadwalById($id);

    // Ambil data jam dan mapel untuk dropdown
    $data['jam_pelajaran'] = $this->Jadwal_model->getJamPelajaran();
    $data['mapel']        = $this->Jadwal_model->getAllMapel();
    // 🔒 Cek role_id
     if ($data['user']['role_id'] == 2) {
        $this->session->set_flashdata('message', 
             '<div class="alert alert-danger" role="alert">
                 Kamu tidak memiliki akses ke halaman ini!
             </div>');
         redirect('jadwal'); // kembali ke halaman utama
     }

    if($this->input->post()) {
        $update = [
            'id_mapel' => $this->input->post('id_mapel', TRUE),
            'id_jam'   => $this->input->post('id_jam', TRUE)
        ];
        $this->Jadwal_model->updateJadwal($id, $update);
        $this->session->set_flashdata('message', 
            '<div class="alert alert-success">Jadwal berhasil diupdate</div>');
        redirect('jadwal');
    }

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('manajemenjadwal/edit_jadwal', $data);
    $this->load->view('templates/footer');
}



public function delete($id)
{
    $this->Jadwal_model->deleteJadwal($id);
    $this->session->set_flashdata('message','Jadwal berhasil dihapus');
    redirect('manajemenjadwal');
}

public function getJadwalById($id) {
    $this->db->select('m_jadwal.*, m_kelas.nama_kelas, m_mapel.nama_mapel');
    $this->db->from('m_jadwal');
    $this->db->join('m_kelas', 'm_jadwal.id_kelas = m_kelas.id');
    $this->db->join('m_mapel', 'm_jadwal.id_mapel = m_mapel.id');
    $this->db->where('m_jadwal.id', $id);
    $query = $this->db->get();
    return $query->row_array();
}



}