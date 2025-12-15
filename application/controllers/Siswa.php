<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
    public $db;
    public $Siswa_model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        
        $data['siswa'] = $this->Siswa_model->get_all();

        // Ambil data user dari tabel user (bukan users)
        $data['users'] = $this->db->get('user')->result();

        // Ambil data kelas dan jurusan dari tabel m_kelas dan m_jurusan
        $data['kelas'] = $this->db->select('m_kelas.id, m_kelas.name AS nama_kelas, m_jurusan.name AS nama_jurusan')
                                 ->from('m_kelas')
                                 ->join('m_jurusan', 'm_kelas.id_jurusan = m_jurusan.id')
                                 ->get()
                                 ->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('masterdata/siswa', $data);
        $this->load->view('templates/footer');
    }

 public function tambah()
    {
        $this->form_validation->set_rules('id_user', 'Nama Siswa', 'required', [
            'required' => 'Nama siswa wajib dipilih!'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas wajib dipilih!'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal lahir wajib diisi!'
        ]);
        // $this->form_validation->set_rules('no_wa', 'No WA', 'required|numeric', [
        //     'required' => 'No WhatsApp wajib diisi!',
        //     'numeric' => 'No WhatsApp harus angka!'
        // ]);

        if ($this->form_validation->run() == FALSE) {
            // ❌ Validasi gagal, tampilkan pesan error
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect('siswa');
        } else {
            // ✅ Validasi lolos, simpan data
            $data = [
                'id_user' => $this->input->post('id_user'),
                'id_kelas' => $this->input->post('id_kelas'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                // 'no_wa' => $this->input->post('no_wa') 
            ];
            $this->Siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Data siswa berhasil ditambahkan!');
            redirect('siswa');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('id_user', 'Nama Siswa', 'required', [
            'required' => 'Nama siswa wajib dipilih!'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required', [
            'required' => 'Kelas wajib dipilih!'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal lahir wajib diisi!'
        ]);
        // $this->form_validation->set_rules('no_wa', 'No WhatsApp', 'required', [
        //     'required' => 'Nomor WhatsApp wajib diisi!'
        // ]);


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect('siswa');
        } else {
            $data = [
                'id_user' => $this->input->post('id_user'),
                'id_kelas' => $this->input->post('id_kelas'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                //'no_wa' => $this->input->post('no_wa')
            ];
        $this->Siswa_model->update($id, $data);
            $this->session->set_flashdata('message', 'Data siswa berhasil diperbarui!');
            redirect('siswa');
        }

    }

    public function hapus($id)
    {
        $this->Siswa_model->delete($id);
        $this->session->set_flashdata('message', 'Data siswa berhasil dihapus!');
        redirect('siswa');
    }

    public function ajax_filter_siswa()
{
    $id_kelas = $this->input->post('id_kelas');
    $jurusan  = $this->input->post('jurusan');

    $siswa = $this->Siswa_model->get_filtered($id_kelas, $jurusan);

    if (!empty($siswa)) {
        $no = 1;
        foreach ($siswa as $row) {
            // Replikasi tombol modal Edit dari view utama
            $btn_edit = '
                <button class="btn btn-sm btn-warning btn-edit"
                    data-id="' . $row->id . '"
                    data-id_user="' . $row->id_user . '"
                    data-id_kelas="' . $row->id_kelas . '"
                    data-tanggal_lahir="' . $row->tanggal_lahir . '"
                    
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditSiswa">
                    Edit
                </button>';
            $btn_hapus = '
                <a href="' . site_url('siswa/hapus/'.$row->id) . '"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Yakin ingin hapus data ini?\');">
                    Hapus
                </a>';
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($row->nama_siswa) . '</td>';
            echo '<td>' . htmlspecialchars($row->tanggal_lahir) . '</td>';
            echo '<td>' . htmlspecialchars($row->nama_kelas) . '</td>';
            echo '<td>' . htmlspecialchars($row->nama_jurusan) . '</td>';
            echo '<td>' . htmlspecialchars($row->email) . '</td>';
            echo '<td>' . htmlspecialchars($row->password) . '</td>';
            echo '<td>' . htmlspecialchars($row->no_wa) . '</td>';

            echo '<td>
                    ' . $btn_edit . $btn_hapus . '
                    </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="8" class="text-center">Tidak ada data siswa</td></tr>';
    }
}



}