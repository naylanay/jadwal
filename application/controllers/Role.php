<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Role extends CI_Controller {
    public $db;
    public $roleModel;
    

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Role_model', 'roleModel'); // ✅ pakai alias
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Role Management';
        $data['role'] = $this->roleModel->getAllRoles(); // ✅ pakai alias

        $data['user'] = $this->db->get_where(
        'user',
        ['email' => $this->session->userdata('email')]
        )->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view( 'templates/sidebar', $data);
        $this->load->view( 'templates/topbar', $data);
        $this->load->view('admin/role', $data); // ✅ pastikan file ini ada
        $this->load->view('templates/footer');
    }

    public function add() {
        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]', [
            'required' => 'Role harus diisi!',
            'is_unique' => 'Role sudah ada!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = ['role' => htmlspecialchars($this->input->post('role', true))];
            $this->roleModel->addRole($data); // ✅ pakai alias
            $this->session->set_flashdata('message', 'Role successfully added!');
            redirect('role');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $data['role'] = $this->roleModel->getRoleById($id);

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->roleModel->updateRole();
            $this->session->set_flashdata('message', 'Role successfully edited');
            redirect('role');
        }
    }

    public function delete($id)
    {
        // Pastikan ID valid
        if (!$id) {
            show_404();
        }

        // Cek apakah role dengan ID itu ada
        $role = $this->roleModel->getRoleById($id);
        if (!$role) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role not found!</div>');
            redirect('role');
        }

        // Hapus dari database
        $this->roleModel->deleteRole($id);

        // Pesan sukses
        $this->session->set_flashdata('message', 'Role successfully deleted!');

        redirect('role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', [
        'email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if($result->num_rows() <1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Access Changed!');
    }


}
