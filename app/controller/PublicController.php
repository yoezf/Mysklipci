<?php

class PublicController extends Controller
{
    public function home(): void
    {
        $conn = db();

        // ============== 1. Ambil daftar prodi untuk filter ==============
        $prodiList = [];
        $resProdi = $conn->query("SELECT id, nama_prodi FROM prodi ORDER BY nama_prodi ASC");
        if ($resProdi) {
            $prodiList = $resProdi->fetch_all(MYSQLI_ASSOC);
        }

        // prodi yang dipilih dari dropdown (boleh kosong = semua prodi)
        $selectedProdi = isset($_GET['prodi_id']) ? (int)$_GET['prodi_id'] : 0;

        // helper kecil buat bikin potongan filter prodi
        $filterProdiSql = '';
        if ($selectedProdi > 0) {
            // aman karena sudah di-cast ke int
            $filterProdiSql = " AND pr.id = " . $selectedProdi . " ";
        }

        // ============== 2. Jadwal SEMINAR (hanya dikonfirmasi & >= hari ini) ==============
        $jadwalSeminar = [];
        $sqlSeminar = "
            SELECT 
                j.*,
                m.nim,
                m.nama AS nama_mhs,
                pr.nama_prodi,
                p.judul,
                dpb.nama  AS nama_pembimbing,
                dpg1.nama AS nama_penguji1,
                dpg2.nama AS nama_penguji2
            FROM jadwal j
            JOIN pengajuan p ON j.pengajuan_id = p.id
            JOIN mahasiswa m ON j.mahasiswa_id = m.id
            JOIN prodi pr ON m.prodi_id = pr.id
            LEFT JOIN dosen dpb  ON j.dosen_pembimbing_id = dpb.id
            LEFT JOIN dosen dpg1 ON j.dosen_penguji_id    = dpg1.id
            LEFT JOIN dosen dpg2 ON j.dosen_penguji_2_id  = dpg2.id
            WHERE j.jenis   = 'seminar'
              AND j.status  = 'dikonfirmasi'
              AND j.tanggal >= CURDATE()
              $filterProdiSql
            ORDER BY j.tanggal ASC, j.jam_mulai ASC
            LIMIT 50
        ";
        $resSeminar = $conn->query($sqlSeminar);
        if ($resSeminar) {
            $jadwalSeminar = $resSeminar->fetch_all(MYSQLI_ASSOC);
        }

        // ============== 3. Jadwal SIDANG (hanya dikonfirmasi & >= hari ini) ==============
        $jadwalSidang = [];
        $sqlSidang = "
            SELECT 
                j.*,
                m.nim,
                m.nama AS nama_mhs,
                pr.nama_prodi,
                p.judul,
                dpb.nama  AS nama_pembimbing,
                dpg1.nama AS nama_penguji1,
                dpg2.nama AS nama_penguji2
            FROM jadwal j
            JOIN pengajuan p ON j.pengajuan_id = p.id
            JOIN mahasiswa m ON j.mahasiswa_id = m.id
            JOIN prodi pr ON m.prodi_id = pr.id
            LEFT JOIN dosen dpb  ON j.dosen_pembimbing_id = dpb.id
            LEFT JOIN dosen dpg1 ON j.dosen_penguji_id    = dpg1.id
            LEFT JOIN dosen dpg2 ON j.dosen_penguji_2_id  = dpg2.id
            WHERE j.jenis   = 'sidang'
              AND j.status  = 'dikonfirmasi'
              AND j.tanggal >= CURDATE()
              $filterProdiSql
            ORDER BY j.tanggal ASC, j.jam_mulai ASC
            LIMIT 50
        ";
        $resSidang = $conn->query($sqlSidang);
        if ($resSidang) {
            $jadwalSidang = $resSidang->fetch_all(MYSQLI_ASSOC);
        }

        // ============== 4. Kirim ke view ==============
        $title = 'Beranda SIPKS – Jadwal Seminar & Sidang';

        $this->view('public/home', compact(
            'title',
            'prodiList',
            'selectedProdi',
            'jadwalSeminar',
            'jadwalSidang'
        ));
    }
}
