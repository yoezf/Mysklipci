<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$badgeStatus = [
    'diajukan'  => 'bg-yellow-100 text-yellow-800',
    'diterima'  => 'bg-green-100 text-green-800',
    'ditolak'   => 'bg-red-100 text-red-800',
];

$status     = $laporan['status'];
$badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6 max-w-3xl">
            <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirIndex"
                class="text-xs text-slate-500 hover:text-pink-600 inline-flex items-center mb-3">
                ← Kembali ke daftar laporan
            </a>

            <h1 class="text-xl md:text-2xl font-semibold mb-2">
                Detail Laporan Akhir
            </h1>

            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    <?= htmlspecialchars($_SESSION['flash_success']); ?>
                </div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>

            <div class="bg-white shadow-md rounded-lg p-4 space-y-3 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500">Mahasiswa</p>
                        <p class="text-sm font-semibold text-slate-800">
                            <?= htmlspecialchars($laporan['nim']); ?> – <?= htmlspecialchars($laporan['nama_mhs']); ?>
                        </p>
                        <p class="text-xs text-slate-500">
                            <?= htmlspecialchars($laporan['nama_prodi']); ?>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-500">Tanggal Upload</p>
                        <p class="text-sm text-slate-800">
                            <?= htmlspecialchars($laporan['created_at']); ?>
                        </p>
                        <span class="inline-flex mt-1 px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                            <?= htmlspecialchars($status); ?>
                        </span>
                    </div>
                </div>

                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">Judul Skripsi</p>
                    <p class="text-sm font-semibold text-slate-800">
                        <?= htmlspecialchars($laporan['judul_skripsi']); ?>
                    </p>
                </div>

                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">Judul Laporan Akhir</p>
                    <p class="text-sm text-slate-800">
                        <?= htmlspecialchars($laporan['judul']); ?>
                    </p>
                </div>

                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">File Laporan</p>
                    <a href="<?= BASE_URL . '/' . htmlspecialchars($laporan['file_path']); ?>"
                        target="_blank"
                        class="inline-flex items-center text-sm text-blue-600 hover:underline">
                        Buka PDF
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-sm font-semibold text-slate-800 mb-3">
                    Verifikasi Laporan Akhir
                </h2>

                <form action="<?= BASE_URL; ?>/?r=admin/laporanAkhirUpdateStatus" method="post" class="space-y-4">
                    <input type="hidden" name="id" value="<?= (int)$laporan['id']; ?>">

                    <div>
                        <p class="text-xs text-slate-500 mb-1">Status</p>
                        <div class="flex flex-wrap gap-4 text-sm">
                            <label class="inline-flex items-center gap-1">
                                <input type="radio" name="status" value="diajukan"
                                    <?= $status === 'diajukan' ? 'checked' : ''; ?>>
                                <span>Diajukan (belum diproses)</span>
                            </label>
                            <label class="inline-flex items-center gap-1">
                                <input type="radio" name="status" value="diterima"
                                    <?= $status === 'diterima' ? 'checked' : ''; ?>>
                                <span>DITERIMA (masuk arsip)</span>
                            </label>
                            <label class="inline-flex items-center gap-1">
                                <input type="radio" name="status" value="ditolak"
                                    <?= $status === 'ditolak' ? 'checked' : ''; ?>>
                                <span>DITOLAK</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-slate-500 mb-1">
                            Catatan untuk Mahasiswa
                        </label>
                        <textarea
                            name="catatan_admin"
                            rows="3"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                            placeholder="Tulis alasan diterima/ditolak, perbaikan yang diminta, dsb."><?= htmlspecialchars($laporan['catatan_admin'] ?? ''); ?></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                            Simpan Perubahan
                        </button>
                        <span class="text-[11px] text-slate-400">
                            Jika status <strong>DITERIMA</strong>, laporan akan tampil di menu Arsip.
                        </span>
                    </div>
                </form>
            </div>
        </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>