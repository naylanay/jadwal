<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public $db;
    public $Mapel_model;
    public $Kelas_model;
    public $Detail_jadwal_model;
    public function __construct()
    {
        parent::__construct();
         $this->load->database(); 
        
        $this->load->model('Mapel_model');
        $this->load->model('Kelas_model'); // untuk dropdown kelas
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Data Mata Pelajaran';
        $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
        ])->row_array();
        $data['mapel'] = $this->Mapel_model->getAllMapel();
        $data['kelas'] = $this->Kelas_model->getAllKelas(); // <--- tambahkan ini

        // load view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('masterdata/mapel', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('name_mapel', 'Nama Mapel', 'required|trim');
        $this->form_validation->set_rules('code_mapel', 'Kode Mapel', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tambah Mata Pelajaran';
            $data['kelas'] = $this->Kelas_model->getAllKelas();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('mapel/add', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'id_kelas' => $this->input->post('id_kelas'),
                'name_mapel' => $this->input->post('name_mapel'),
                'code_mapel' => $this->input->post('code_mapel')
            ];

            $this->Mapel_model->insertMapel($data);
            $this->session->set_flashdata('message', 'Data mapel berhasil ditambahkan!');
            redirect('mapel');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Mata Pelajaran';
        $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
        ])->row_array();
        $data['mapel'] = $this->Mapel_model->getMapelById($id);
        $data['kelas'] = $this->Kelas_model->getAllKelas();

        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('name_mapel', 'Nama Mapel', 'required|trim');
        $this->form_validation->set_rules('code_mapel', 'Kode Mapel', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('masterdata/edit_mapel', $data);
            $this->load->view('templates/footer');
        } else {
            $updateData = [
                'id_kelas' => $this->input->post('id_kelas'),
                'name_mapel' => $this->input->post('name_mapel'),
                'code_mapel' => $this->input->post('code_mapel')
            ];

            $this->Mapel_model->updateMapel($id, $updateData);
            $this->session->set_flashdata('message', 'Data mapel berhasil diubah!');
            redirect('mapel');
        }
    }

    public function delete($id)
    {
        $this->Mapel_model->deleteMapel($id);
        $this->session->set_flashdata('message', 'Data mapel berhasil dihapus!');
        redirect('mapel');
    }

   public function detail($id_mapel = null)
{
    if (!$id_mapel) show_404();

    $this->load->model('Detail_jadwal_model');

    $data['title'] = 'Detail Deskripsi Mapel';
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
        ])->row_array();
    $data['mapel'] = $this->db->get_where('m_mapel', ['id' => $id_mapel])->row_array();
    $data['deskripsi_list'] = $this->Detail_jadwal_model->getDeskripsiByMapelId($id_mapel);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('masterdata/detail', $data); // view di folder masterdata
    $this->load->view('templates/footer');
}


public function tambah_deskripsi($id_mapel)
{
    $deskripsi = $this->input->post('deskripsi');
    $data = [
        'id_mapel' => $id_mapel,
        'deskripsi' => $deskripsi
    ];

    $this->load->model('Detail_jadwal_model');
    $this->Detail_jadwal_model->insertDeskripsi($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Deskripsi berhasil ditambahkan!</div>');
    redirect('mapel/detail/' . $id_mapel);
}

public function hapus_deskripsi($id, $id_mapel)
{
    $this->load->model('Detail_jadwal_model');
    $this->Detail_jadwal_model->deleteDeskripsi($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Deskripsi berhasil dihapus!</div>');
    redirect('mapel/detail/' . $id_mapel);
}

public function edit_deskripsi($id_deskripsi, $id_mapel)
{
    $this->load->model('Detail_jadwal_model');

    $deskripsi_baru = $this->input->post('deskripsi');

    $data = [
        'deskripsi' => $deskripsi_baru
    ];

    $this->Detail_jadwal_model->updateDeskripsi($id_deskripsi, $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Deskripsi berhasil diubah!</div>');
    redirect('mapel/detail/' . $id_mapel);
}

// di Mapel.php (controller)
public function ajax_filter_mapel()
{
    $id_kelas = $this->input->post('id_kelas');
    $mapel = $this->Mapel_model->getMapelByKelas($id_kelas);

    if (!empty($mapel)) {
        $no = 1;
        foreach ($mapel as $m) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($m['name']) . '</td>';
            echo '<td>' . htmlspecialchars($m['name_mapel']) . '</td>';
            echo '<td>' . htmlspecialchars($m['code_mapel']) . '</td>';
            echo '<td>
                    <a href="' . base_url('mapel/detail/' . $m['id']) . '" class="btn btn-sm btn-info">Detail</a>
                    <a href="'.base_url('mapel/edit/'.$m['id']).'" class="btn btn-sm btn-warning">Edit</a> 
                    <a href="'.base_url('mapel/delete/'.$m['id']).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\');">Delete</a>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="5" class="text-center">Tidak ada data mapel</td></tr>';
    }
}




}
