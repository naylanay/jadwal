<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    public $db;
    public $jurusan_model;
    public $Jurusan_model;
    public $dataUpdate;
     public function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model'); // ✅ tambahkan baris ini

    }
    
        public function index()
    {
        
        // Ambil data jurusan dari tabel m_jurusan
        $data['title'] = 'Data Jurusan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['jurusan'] = $this->db->get('m_jurusan')->result_array();

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('masterdata/jurusan', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data = [
            'name' => $this->input->post('name', true),
            'deskripsi' => $this->input->post('deskripsi', true),
            'code_jurusan' => $this->input->post('code_jurusan', true),
        ];

        $this->Jurusan_model->addJurusan($data);
        $this->session->set_flashdata('message', 'Data jurusan berhasil ditambahkan');
        redirect('jurusan');
    }


    public function edit($id)
    {
        $data['title'] = 'Edit Jurusan';
        $data['user'] = $this->db->get_where('user', array(
            'email' => $this->session->userdata('email')
        ))->row_array();

        $data['jurusan'] = $this->Jurusan_model->getJurusanById($id);

        // Aturan validasi form
        $this->form_validation->set_rules('name', 'Nama Jurusan', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('code_jurusan', 'Kode Jurusan', 'required');

        if ($this->form_validation->run() == false) {
            // Tampilkan halaman edit
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('masterdata/edit_jurusan', $data);
            $this->load->view('templates/footer');
        } else {
            // Ambil data dari form
            $dataUpdate = array(
                'name' => $this->input->post('name', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'code_jurusan' => $this->input->post('code_jurusan', true)
            );

            // Update ke database
            $this->Jurusan_model->updateJurusan($id, $dataUpdate);

            $this->session->set_flashdata('message', 'Data berhasil diubah');
            redirect('jurusan');
        }
    }


    public function delete($id)
    {
        $this->Jurusan_model->deleteJurusan($id);
        $this->session->set_flashdata('message', 'Data deleted!');
        redirect('jurusan');
    }

}
