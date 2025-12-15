<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends CI_Controller {
    public $Reminder_model;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Reminder_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = "Kirim Pengingat Jadwal";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['status'] = "";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('reminder/reminder', $data);
        $this->load->view('templates/footer');
    }

    public function kirim_jadwal_besok()
{
    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $hariBesok = $days[date('l', strtotime('+1 day'))];

     // 🔥 CEK: Jika besok Sabtu atau Minggu → LIBUR
    if ($hariBesok === 'Sabtu' || $hariBesok === 'Minggu') {
        $this->session->set_flashdata(
            'success',
            "Besok hari $hariBesok, tidak dapat mengirim jadwal karena libur."
        );
        redirect('reminder');
        return; // stop fungsi, tidak kirim WA
    }

    $semester = "Ganjil";
    $tahunAjaran = "2025/2026";

   $kelasList = $this->db
    ->distinct()
    ->select('id_kelas')
    ->where('hari', $hariBesok)
    ->where('semester', $semester)
    ->where('tahun_ajaran', $tahunAjaran)
    ->get('m_jadwal')
    ->result();


    foreach ($kelasList as $kelas) {

        // ambil siswa
        $siswaList = $this->Reminder_model->get_siswa_by_kelas($kelas->id_kelas);

        foreach ($siswaList as $siswa) {

            $no_wa = preg_replace('/[^0-9]/', '', $siswa->no_wa);
            $no_wa = preg_replace('/^0/', '62', $no_wa);

            // 🔥 buat pesan sekali per siswa
            $pesan = $this->_buat_pesan(
                $siswa->name,
                $kelas->id_kelas,
                $hariBesok,
                $semester,
                $tahunAjaran
            );

            // kirim WA
            $response = $this->_kirim_wa_local($no_wa, $pesan);

            // log
            $this->_log_wa($no_wa, $pesan, $response);
        }
    }

    //echo "Pengingat jadwal besok sudah dikirim!";
    $this->session->set_flashdata('success', 'Pengingat jadwal besok sudah dikirim!');
    redirect('reminder'); // kembali ke halaman reminder

}


    private function _buat_pesan($namaSiswa, $id_kelas, $hari, $semester, $tahunAjaran)
{
    $jadwalKelas = $this->Reminder_model->get_jadwal_siswa($id_kelas, $hari, $semester, $tahunAjaran);

    // 🔥 SORT jadwal berdasarkan jam_mulai
    usort($jadwalKelas, function($a, $b) {
        return strtotime($a->jam_mulai) - strtotime($b->jam_mulai);
    });

    // 🔥 Format list jadwal
    $list = "";
    foreach ($jadwalKelas as $i => $j) {
        // hilangkan detik → 08:20:00 jadi 08:20
        $mulai   = date('H:i', strtotime($j->jam_mulai));
        $selesai = date('H:i', strtotime($j->jam_selesai));

        $list .= ($i+1) . ". {$j->name_mapel} ({$mulai}-{$selesai})\n";
    }

    return "
Hai *{$namaSiswa}* 👋🤓

Berikut jadwal pelajaranmu untuk *besok ($hari)*:

{$list}
Semangat belajar ya! ✨(✿◡‿◡)
    ";
}


    private function _kirim_wa_local($no_wa, $pesan)
    {
        $data = [
            'number' => $no_wa,
            'message' => $pesan
        ];

        $ch = curl_init('http://localhost:3000/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function _log_wa($no_wa, $pesan, $response)
    {
        $log = date('Y-m-d H:i:s') . " | $no_wa | $response\n";
        file_put_contents(APPPATH.'logs/wa_log.txt', $log, FILE_APPEND);
    }
}
