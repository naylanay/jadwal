<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    public $Reminder_model;
    public $db;

    public function __construct() {
        parent::__construct();
        $this->load->model('Reminder_model');
    }

    // Kirim jadwal besok
    public function kirim_jadwal_besok()
    {
        // Tentukan hari besok
        $hariBesok = date('l', strtotime('+1 day'));

        // Mapping Inggris → Indonesia
        $hariMap = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu'
        ];

        $hariBesokIndo = $hariMap[$hariBesok];

        // ❌ Tidak dijalankan pada hari: Jumat & Sabtu
        $bolehJalan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Minggu'];

        if (!in_array($hariBesokIndo, $bolehJalan)) {
            echo "CRON dilewati karena besok adalah hari: {$hariBesokIndo}";
            return;
        }

        // Semester dan tahun ajaran (isi sesuai data kamu)
        $semester = 1;
        $tahunAjaran = '2024/2025';

        // Ambil semua kelas
        $kelasList = $this->db->get('m_kelas')->result();

        foreach ($kelasList as $kelas) {

            // Ambil jadwal besok untuk kelas tersebut
            $jadwal = $this->Reminder_model->get_jadwal_siswa(
                $kelas->id,
                $hariBesokIndo,
                $semester,
                $tahunAjaran
            );

            if (empty($jadwal)) continue;

            // Ambil daftar siswa di kelas itu
            $siswaList = $this->Reminder_model->get_siswa_by_kelas($kelas->id);

            foreach ($siswaList as $s) {

                // Personal message
                $pesan = "Halo *{$s->name}* 👋\n";
                $pesan .= "Berikut jadwal pelajaran kamu untuk besok (*{$hariBesokIndo}*):\n\n";

                foreach ($jadwal as $j) {
                    $pesan .= "• {$j->name_mapel} ({$j->jam_mulai} - {$j->jam_selesai})\n";
                }

                $pesan .= "\nSemangat belajar ya! 😊";

                // Format nomor WA
                $no_wa = preg_replace('/[^0-9]/', '', $s->no_wa);
                $no_wa = preg_replace('/^0/', '62', $no_wa);

                // Kirim ke WHATSAPP API
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

                // Tulis log
                file_put_contents(APPPATH.'logs/cron_jadwal.txt',
                    date('Y-m-d H:i:s') . " | {$s->name} | $no_wa | $response\n",
                    FILE_APPEND
                );
            }
        }

        echo "CRON selesai: " . date('Y-m-d H:i:s');
    }
}
