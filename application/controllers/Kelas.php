<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public $db;
    public $Kelas_model;
    public $Jurusan_model;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['kelas'] = $this->Kelas_model->getAllKelas();
        $data['jurusan'] = $this->Jurusan_model->getAllJurusan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('masterdata/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('name', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('code_kelas', 'Kode Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '❌ Gagal menambahkan kelas, periksa kembali input Anda!');
            redirect('kelas');
        } else {
            $data = [
                'name' => $this->input->post('name', true),
                'id_jurusan' => $this->input->post('id_jurusan', true),
                'code_kelas' => $this->input->post('code_kelas', true)
            ];

            $this->Kelas_model->addKelas($data);
            $this->session->set_flashdata('message', '✅ Data kelas berhasil ditambahkan!');
            redirect('kelas');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Kelas';
        $data['user'] = $this->db->get_where('user', array(
            'email' => $this->session->userdata('email')
        ))->row_array();
        $data['kelas'] = $this->Kelas_model->getKelasById($id);
        $data['jurusan'] = $this->Jurusan_model->getAllJurusan();

        $this->form_validation->set_rules('name', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('code_kelas', 'Kode Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('masterdata/edit_kelas', $data);
            $this->load->view('templates/footer');
        } else {
            $update = [
                'name' => $this->input->post('name', true),
                'id_jurusan' => $this->input->post('id_jurusan', true),
                'code_kelas' => $this->input->post('code_kelas', true)
            ];

            $this->Kelas_model->updateKelas($id, $update);
            $this->session->set_flashdata('message', '✅ Data kelas berhasil diubah!');
            redirect('kelas');
        }
    }

    public function delete($id)
    {
        $this->Kelas_model->deleteKelas($id);
        $this->session->set_flashdata('message', '🗑️ Data kelas berhasil dihapus!');
        redirect('kelas');
    }

    public function ajax_filter_kelas()
{
    $id_jurusan = $this->input->post('id_jurusan');

    $kelas = $this->Kelas_model->getKelasByJurusan($id_jurusan);

    if (!empty($kelas)) {
        $no = 1;
        foreach ($kelas as $k) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($k['name']) . '</td>';
            echo '<td>' . htmlspecialchars($k['nama_jurusan']) . '</td>';
            echo '<td>' . htmlspecialchars($k['code_kelas']) . '</td>';
            echo '<td>
                    <a href="'.base_url('kelas/edit/'.$k['id']).'" class="btn btn-sm btn-warning">Edit</a> 
                    <a href="'.base_url('kelas/delete/'.$k['id']).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Delete</a>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="5" class="text-center">Tidak ada data kelas</td></tr>';
    }
}

}
