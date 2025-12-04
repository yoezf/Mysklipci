<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-4">
        <h1 class="text-xl md:text-2xl font-semibold mb-2">Tambah Log PKL</h1>
        <p class="text-sm text-slate-500 mb-4">
            <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
        </p>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="mb-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_error']); ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL; ?>/?r=mahasiswa/logPklStore" method="post" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Tanggal
                </label>
                <input type="date" name="tanggal"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Kegiatan
                </label>
                <textarea name="kegiatan" rows="4"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]"
                          placeholder="Jelaskan kegiatan yang dilakukan hari ini..." required></textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Lokasi
                    </label>
                    <input type="text" name="lokasi"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]"
                           placeholder="Nama instansi / divisi / lokasi kerja">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Jam Mulai - Jam Selesai
                    </label>
                    <div class="flex gap-2">
                        <input type="time" name="jam_mulai"
                               class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]">
                        <input type="time" name="jam_selesai"
                               class="w-1/2 border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Output / Hasil
                </label>
                <textarea name="output" rows="3"
                          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]"
                          placeholder="Mis: laporan harian, modul yang dikerjakan, dsb."></textarea>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit"
                        class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                    Simpan Log
                </button>
                <a href="<?= BASE_URL; ?>/?r=mahasiswa/logPklIndex"
                   class="text-sm text-slate-600 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <?php include __DIR__ . '/../../partials/mahasiswa/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
