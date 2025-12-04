<?php

class DosenController extends Controller
{
    private function getDosenAktif(): ?array
    {
        if (!isset($_SESSION['user'])) {
            return null;
        }

        $userId = (int)$_SESSION['user']['id'];
        $conn   = db();

        $stmt = $conn->prepare("
            SELECT d.*
            FROM dosen d
            WHERE d.user_id = ?
            LIMIT 1
        ");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $dosen  = $result->fetch_assoc();
        $stmt->close();

        return $dosen ?: null;
    }

    public function dashboard(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen tidak ditemukan.";
            exit;
        }

        $conn = db();
        $dosenId = (int)$dosen['id'];

        /* ====================================================
     * 1. Jumlah Mahasiswa Bimbingan
     * ==================================================== */
        $stmt = $conn->prepare("
        SELECT COUNT(DISTINCT mahasiswa_id) AS c
        FROM pengajuan
        WHERE pembimbing_id = ?
          AND status = 'diterima'
    ");
        $stmt->bind_param('i', $dosenId);
        $stmt->execute();
        $mhsBimbinganCount = $stmt->get_result()->fetch_assoc()['c'] ?? 0;
        $stmt->close();

        /* ====================================================
     * 2. Log bimbingan menunggu ACC dosen
     * ==================================================== */
        $stmt = $conn->prepare("
        SELECT COUNT(*) AS c
        FROM log_bimbingan
        WHERE dosen_id = ?
          AND status = 'diajukan'
    ");
        $stmt->bind_param('i', $dosenId);
        $stmt->execute();
        $logPending = $stmt->get_result()->fetch_assoc()['c'] ?? 0;
        $stmt->close();

        /* ====================================================
     * 3. Jadwal terdekat (seminar/sidang)
     *    - Jika dosen adalah pembimbing
     *    - Atau dosen penguji 1
     *    - Atau dosen penguji 2
     * ==================================================== */
        $stmt = $conn->prepare("
        SELECT 
            j.*,
            m.nama AS nama_mhs,
            m.nim,
            pr.nama_prodi,
            p.judul
        FROM jadwal j
        JOIN pengajuan p ON j.pengajuan_id = p.id
        JOIN mahasiswa m ON j.mahasiswa_id = m.id
        JOIN prodi pr ON m.prodi_id = pr.id
        WHERE (j.dosen_pembimbing_id = ?
            OR j.dosen_penguji_id = ?
            OR j.dosen_penguji_2_id = ?)
          AND j.tanggal >= CURDATE()
        ORDER BY j.tanggal ASC, j.jam_mulai ASC
        LIMIT 5
    ");
        $stmt->bind_param('iii', $dosenId, $dosenId, $dosenId);
        $stmt->execute();
        $jadwalTerdekat = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        /* ====================================================
     * 4. Log bimbingan terbaru (5 terakhir)
     * ==================================================== */
        $stmt = $conn->prepare("
        SELECT lb.*, m.nama AS nama_mhs, m.nim
        FROM log_bimbingan lb
        JOIN mahasiswa m ON lb.mahasiswa_id = m.id
        WHERE lb.dosen_id = ?
        ORDER BY lb.created_at DESC
        LIMIT 5
    ");
        $stmt->bind_param('i', $dosenId);
        $stmt->execute();
        $logTerbaru = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        /* ====================================================
     * View
     * ==================================================== */
        $title = 'Dashboard Dosen';
        $this->view('dosen/dashboard', compact(
            'title',
            'dosen',
            'mhsBimbinganCount',
            'logPending',
            'jadwalTerdekat',
            'logTerbaru'
        ));
    }



    /* ===========================
     *  LOG BIMBINGAN - DOSEN
     * =========================== */

    public function logBimbinganIndex(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia. Minta admin mengisi data dosen.";
            exit;
        }

        $conn = db();
        $stmt = $conn->prepare("
            SELECT lb.*, m.nim, m.nama AS nama_mhs
            FROM log_bimbingan lb
            JOIN mahasiswa m ON lb.mahasiswa_id = m.id
            WHERE lb.dosen_id = ?
            ORDER BY lb.tanggal DESC, lb.created_at DESC
        ");
        $stmt->bind_param('i', $dosen['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items  = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $title = 'Log Bimbingan Mahasiswa';
        $this->view('dosen/log_bimbingan/index', compact('title', 'items', 'dosen'));
    }

    public function logBimbinganDetail(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia.";
            exit;
        }

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header('Location: ' . BASE_URL . '/?r=dosen/logBimbinganIndex');
            exit;
        }

        $conn = db();
        $stmt = $conn->prepare("
            SELECT lb.*, m.nim, m.nama AS nama_mhs
            FROM log_bimbingan lb
            JOIN mahasiswa m ON lb.mahasiswa_id = m.id
            WHERE lb.id = ? AND lb.dosen_id = ?
            LIMIT 1
        ");
        $stmt->bind_param('ii', $id, $dosen['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $log    = $result->fetch_assoc();
        $stmt->close();

        if (!$log) {
            header('Location: ' . BASE_URL . '/?r=dosen/logBimbinganIndex');
            exit;
        }

        $title = 'Detail Log Bimbingan';
        $this->view('dosen/log_bimbingan/detail', compact('title', 'log', 'dosen'));
    }

    public function logBimbinganUpdate(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia.";
            exit;
        }

        $id     = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'diajukan';
        $catatan_dosen = trim($_POST['catatan_dosen'] ?? '');

        if ($id <= 0 || !in_array($status, ['diajukan', 'disetujui', 'direvisi'], true)) {
            header('Location: ' . BASE_URL . '/?r=dosen/logBimbinganIndex');
            exit;
        }

        $conn = db();
        $stmt = $conn->prepare("
            UPDATE log_bimbingan
            SET status = ?, catatan_dosen = ?, updated_at = NOW()
            WHERE id = ? AND dosen_id = ?
        ");
        $stmt->bind_param('ssii', $status, $catatan_dosen, $id, $dosen['id']);
        $stmt->execute();
        $stmt->close();

        $_SESSION['flash_success'] = 'Log bimbingan sudah diperbarui.';
        header('Location: ' . BASE_URL . '/?r=dosen/logBimbinganDetail&id=' . $id);
        exit;
    }

    /* ===========================
     *  JADWAL SEMINAR & SIDANG - DOSEN
     * =========================== */

    public function jadwalIndex(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia.";
            exit;
        }

        $conn = db();
        $stmt = $conn->prepare("
            SELECT j.*, m.nim, m.nama AS nama_mhs
            FROM jadwal j
            JOIN mahasiswa m ON j.mahasiswa_id = m.id
            WHERE j.dosen_pembimbing_id = ?
               OR j.dosen_penguji_id = ?
            ORDER BY j.tanggal DESC, j.jam_mulai DESC
        ");
        $stmt->bind_param('ii', $dosen['id'], $dosen['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items  = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $title = 'Jadwal Seminar & Sidang';
        $this->view('dosen/jadwal/index', compact('title', 'items', 'dosen'));
    }

    public function jadwalDetail(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia.";
            exit;
        }

        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header('Location: ' . BASE_URL . '/?r=dosen/jadwalIndex');
            exit;
        }

        $conn = db();
        $stmt = $conn->prepare("
            SELECT j.*, 
                   m.nim, m.nama AS nama_mhs, pr.nama_prodi,
                   dp.nama AS nama_pembimbing,
                   dpg.nama AS nama_penguji
            FROM jadwal j
            JOIN mahasiswa m ON j.mahasiswa_id = m.id
            JOIN prodi pr ON m.prodi_id = pr.id
            LEFT JOIN dosen dp ON j.dosen_pembimbing_id = dp.id
            LEFT JOIN dosen dpg ON j.dosen_penguji_id = dpg.id
            WHERE j.id = ?
              AND (j.dosen_pembimbing_id = ? OR j.dosen_penguji_id = ?)
            LIMIT 1
        ");
        $stmt->bind_param('iii', $id, $dosen['id'], $dosen['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $jadwal = $result->fetch_assoc();
        $stmt->close();

        if (!$jadwal) {
            header('Location: ' . BASE_URL . '/?r=dosen/jadwalIndex');
            exit;
        }

        $title = 'Detail Jadwal';
        $this->view('dosen/jadwal/detail', compact('title', 'jadwal', 'dosen'));
    }

    public function jadwalKonfirmasiUpdate(): void
    {
        $this->requireRole(['dosen']);
        $dosen = $this->getDosenAktif();
        if (!$dosen) {
            echo "Data dosen untuk akun ini belum tersedia.";
            exit;
        }

        $id     = (int)($_POST['id'] ?? 0);
        $status = $_POST['status'] ?? 'dijadwalkan';
        $catatan = trim($_POST['catatan'] ?? '');

        if ($id <= 0 || !in_array($status, ['dijadwalkan', 'dikonfirmasi', 'ditolak'], true)) {
            header('Location: ' . BASE_URL . '/?r=dosen/jadwalIndex');
            exit;
        }

        $conn = db();

        // Pastikan jadwal milik dosen ini
        $stmt = $conn->prepare("
            SELECT id
            FROM jadwal
            WHERE id = ?
              AND (dosen_pembimbing_id = ? OR dosen_penguji_id = ?)
            LIMIT 1
        ");
        $stmt->bind_param('iii', $id, $dosen['id'], $dosen['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->fetch_assoc();
        $stmt->close();

        if (!$exists) {
            header('Location: ' . BASE_URL . '/?r=dosen/jadwalIndex');
            exit;
        }

        $stmtUpd = $conn->prepare("
            UPDATE jadwal
            SET status = ?, catatan = ?, updated_at = NOW()
            WHERE id = ?
        ");
        $stmtUpd->bind_param('ssi', $status, $catatan, $id);
        $stmtUpd->execute();
        $stmtUpd->close();

        $_SESSION['flash_success'] = 'Status jadwal berhasil diperbarui.';
        header('Location: ' . BASE_URL . '/?r=dosen/jadwalDetail&id=' . $id);
        exit;
    }
}
