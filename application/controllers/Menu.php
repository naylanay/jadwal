<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public $db;
    public $menu;
    public $menu_model;
    
    
    public function __construct()
    {
        parent::__construct();

         is_logged_in();
        // Load library form validation (pastikan sudah autoload atau load manual)
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';

        // Ambil data user berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        // Ambil semua menu dari tabel user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // Aturan validasi input
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Tampilkan halaman jika validasi gagal (belum submit form)
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');

        } else {
            // Jika validasi berhasil, tambahkan menu baru
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu', true)
            ]);

            // Flash message
            $this->session->set_flashdata('message', 'New Menu Add!');
            redirect('menu'); 

            // Redirect kembali ke halaman menu
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', 'Menu deleted!');
        redirect('menu');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Menu';

        // Ambil data user
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        // Ambil menu berdasarkan ID
        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

        // Validasi input
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Tampilkan form edit
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit', $data); // view baru
            $this->load->view('templates/footer');
        } else {
            // Proses update
            $this->db->set('menu', $this->input->post('menu', true));
            $this->db->where('id', $id);
            $this->db->update('user_menu');

            $this->session->set_flashdata('message', 'Menu updated successfully!');
            redirect('menu');
        }
    }

    public function submenu()

    {
        $data['title'] = 'Submenu Management';

        // Ambil data user berdasarkan email dari session
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $this->load->model('Menu_model', 'menu_model');

        $data['subMenu'] = $this->menu_model->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');


        if( $this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data); // view baru
            $this->load->view('templates/footer');

        } else {
        // Jika validasi berhasil, simpan ke database
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        $this->db->insert('user_sub_menu', $data);

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');

        // Redirect kembali ke halaman submenu
        redirect('menu/submenu');
        }

    }
    public function delete_submenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu deleted!</div>');
        redirect('menu/submenu');
    }
    
    public function edit_submenu($id)
{
    $data['title'] = 'Edit Submenu';

    // Ambil data user login
    $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')
    ])->row_array();

    // Ambil submenu berdasarkan ID
    $data['submenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

    // Ambil semua menu untuk dropdown
    $data['menu'] = $this->db->get('user_menu')->result_array();

    // Validasi
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'URL', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');

    if ($this->form_validation->run() == false) {
        // Tampilkan view edit
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_submenu', $data);
        $this->load->view('templates/footer');
    } else {
        // Simpan perubahan
        $dataUpdate = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $dataUpdate);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu updated!</div>');
        redirect('menu/submenu');
    }
}


}
