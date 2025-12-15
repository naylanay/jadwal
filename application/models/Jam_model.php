<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jam_model extends CI_Model {

    public function getAllJam() {
        return $this->db->order_by('jam_mulai', 'ASC')->get('m_jam_pelajaran')->result();
    }

    public function simpanJam($data) {
        return $this->db->insert('m_jam_pelajaran', $data);
    }

    public function getJamById($id) {
        return $this->db->get_where('m_jam_pelajaran', ['id' => $id])->row();
    }

    public function updateJam($id, $data) {
        return $this->db->where('id', $id)->update('m_jam_pelajaran', $data);
    }

    public function deleteJam($id) {
        return $this->db->delete('m_jam_pelajaran', ['id' => $id]);
    }
}
