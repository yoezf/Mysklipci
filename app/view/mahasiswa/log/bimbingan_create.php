<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-4">
        <h1 class="text-xl md:text-2xl font-semibold mb-2">Tambah Log Bimbingan Skripsi</h1>
        <p class="text-sm text-slate-500 mb-1">
            <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
        </p>
        <p class="text-xs text-slate-500 mb-4">
            Pembimbing: <span class="font-semibold text-slate-800"><?= htmlspecialchars($skripsiAktif['nama_pembimbing']); ?></span>
        </p>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="mb-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_error']); ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL; ?>/?r=mahasiswa/logBimbinganStore" method="post" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Tanggal Bimbingan
                </label>
                <input type="date" name="tanggal"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Topik / Materi Bimbingan
                </label>
                <input type="text" name="topik"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]"
                       placeholder="Mis: Revisi Bab II, diskusi metodologi..." required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Catatan dari Mahasiswa
                </label>
                <textarea name="catatan_mahasiswa" rows="4"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]"
                          placeholder="Ringkas hasil diskusi, poin revisi, komitmen perbaikan, dsb."></textarea>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit"
                        class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                    Kirim ke Pembimbing
                </button>
                <a href="<?= BASE_URL; ?>/?r=mahasiswa/logBimbinganIndex"
                   class="text-sm text-slate-600 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <?php include __DIR__ . '/../../partials/mahasiswa/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
