<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jam extends CI_Controller {
    public $Jam_model;
    public $db;

    public function __construct() {
        parent::__construct();
        $this->load->model('Jam_model');
    }

    public function index() {
        $data['title'] = "Jam Pelajaran";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['jam'] = $this->Jam_model->getAllJam();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('masterdata/jam', $data);
        $this->load->view('templates/footer');
    }

public function tambah() {
    if ($this->input->post()) {
        $data = [
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai')
        ];
        $this->db->insert('m_jam_pelajaran', $data);
        $this->session->set_flashdata('message', 'Jam berhasil ditambahkan');
    }
    redirect('jam'); // redirect kembali ke halaman index
}




    public function edit($id) {
    if ($this->input->post()) {
        $data = [
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
        ];
        $this->Jam_model->updateJam($id, $data);
        $this->session->set_flashdata('message', 'Jam berhasil diUpdate');
        redirect('jam');
    }

    // Ambil data user dan judul halaman
    $data['title'] = "Edit Jam Pelajaran";
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();
    $data['jam'] = $this->Jam_model->getJamById($id);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('masterdata/jam_edit', $data);
    $this->load->view('templates/footer');

    
}


    public function hapus($id) {
        $this->Jam_model->deleteJam($id);
        $this->session->set_flashdata('message', 'Jam berhasil diHapus');
        redirect('jam');
    }
}
