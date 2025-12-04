<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$badgeStatus = [
    'diajukan'   => 'bg-yellow-100 text-yellow-800',
    'disetujui'  => 'bg-green-100 text-green-800',
    'direvisi'   => 'bg-red-100 text-red-800',
];
$status     = $log['status'];
$badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-4">
        <a href="<?= BASE_URL; ?>/?r=dosen/logBimbinganIndex"
           class="text-xs text-slate-500 hover:text-pink-600 inline-flex items-center mb-3">
            ← Kembali ke daftar
        </a>

        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Detail Log Bimbingan
        </h1>
        <p class="text-sm text-slate-500 mb-4">
            Mahasiswa: <?= htmlspecialchars($log['nim']); ?> – <?= htmlspecialchars($log['nama_mhs']); ?>
        </p>

        <div class="bg-white shadow-md rounded-lg p-4 space-y-3 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-500 mb-1">Tanggal Bimbingan</p>
                    <p class="text-sm text-slate-800">
                        <?= htmlspecialchars($log['tanggal']); ?>
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500 mb-1">Status</p>
                    <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                        <?= htmlspecialchars($status); ?>
                    </span>
                </div>
            </div>

            <div class="border-t pt-3">
                <p class="text-xs text-slate-500 mb-1">Topik</p>
                <p class="text-sm font-semibold text-slate-800">
                    <?= htmlspecialchars($log['topik']); ?>
                </p>
            </div>

            <div class="border-t pt-3">
                <p class="text-xs text-slate-500 mb-1">Catatan dari Mahasiswa</p>
                <p class="text-sm text-slate-800 whitespace-pre-line">
                    <?= nl2br(htmlspecialchars($log['catatan_mahasiswa'] ?? '-')); ?>
                </p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-sm font-semibold text-slate-800 mb-3">
                ACC / Revisi Log Bimbingan
            </h2>

            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    <?= htmlspecialchars($_SESSION['flash_success']); ?>
                </div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL; ?>/?r=dosen/logBimbinganUpdate" method="post" class="space-y-4">
                <input type="hidden" name="id" value="<?= (int)$log['id']; ?>">

                <div>
                    <p class="text-xs text-slate-500 mb-1">Status</p>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="diajukan"
                                <?= $status === 'diajukan' ? 'checked' : ''; ?>>
                            <span>Diajukan</span>
                        </label>
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="disetujui"
                                <?= $status === 'disetujui' ? 'checked' : ''; ?>>
                            <span>Disetujui</span>
                        </label>
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="direvisi"
                                <?= $status === 'direvisi' ? 'checked' : ''; ?>>
                            <span>Perlu Revisi</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-slate-500 mb-1">
                        Catatan untuk Mahasiswa
                    </label>
                    <textarea
                        name="catatan_dosen"
                        rows="4"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                        placeholder="Tulis masukan, persetujuan, atau revisi yang diminta..."
                    ><?= htmlspecialchars($log['catatan_dosen'] ?? ''); ?></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                        Simpan
                    </button>
                    <span class="text-[11px] text-slate-400">
                        Perubahan akan terlihat di halaman log bimbingan mahasiswa.
                    </span>
                </div>
            </form>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/dosen/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
