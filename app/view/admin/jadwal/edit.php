<?php include __DIR__ . '/../../partials/header.php'; ?>


<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>
    <section class="flex-1 p-4 md:p-6 max-w-4xl">
        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Edit Jadwal <?= htmlspecialchars(ucfirst($jenis)); ?>
        </h1>
        <p class="text-xs md:text-sm text-slate-500 mb-4">
            <?= htmlspecialchars($jadwal['nama_mhs']); ?> (<?= htmlspecialchars($jadwal['nim']); ?>) •
            <?= htmlspecialchars($jadwal['nama_prodi']); ?><br>
            Judul: <?= htmlspecialchars($jadwal['judul']); ?><br>
            Pembimbing: <?= htmlspecialchars($jadwal['nama_pembimbing'] ?? '-'); ?>
        </p>

        <form action="<?= BASE_URL; ?>/?r=admin/jadwal<?= ucfirst($jenis); ?>Update" method="post"
              class="bg-white shadow-md rounded-lg p-4 space-y-3">
            <input type="hidden" name="id" value="<?= (int)$jadwal['id']; ?>">

            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= htmlspecialchars($jadwal['tanggal']); ?>"
                           class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                           required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Ruangan</label>
                    <input type="text" name="ruangan" value="<?= htmlspecialchars($jadwal['ruangan']); ?>"
                           class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                           required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="<?= htmlspecialchars($jadwal['jam_mulai']); ?>"
                           class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                           required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="<?= htmlspecialchars($jadwal['jam_selesai'] ?? ''); ?>"
                           class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Penguji 1</label>
                    <select name="dosen_penguji_id"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                        <option value="0">-- Pilih Penguji 1 --</option>
                        <?php foreach ($dosenList as $d): ?>
                            <option value="<?= (int)$d['id']; ?>"
                                <?= (int)$jadwal['dosen_penguji_id'] === (int)$d['id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($d['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Penguji 2</label>
                    <select name="dosen_penguji_2_id"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                        <option value="0">-- Pilih Penguji 2 --</option>
                        <?php foreach ($dosenList as $d): ?>
                            <option value="<?= (int)$d['id']; ?>"
                                <?= (int)($jadwal['dosen_penguji_2_id'] ?? 0) === (int)$d['id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($d['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
                <select name="status"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                    <option value="dijadwalkan" <?= $jadwal['status'] === 'dijadwalkan' ? 'selected' : ''; ?>>
                        Dijadwalkan
                    </option>
                    <option value="dikonfirmasi" <?= $jadwal['status'] === 'dikonfirmasi' ? 'selected' : ''; ?>>
                        Dikonfirmasi
                    </option>
                    <option value="ditolak" <?= $jadwal['status'] === 'ditolak' ? 'selected' : ''; ?>>
                        Ditolak
                    </option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Catatan</label>
                <textarea name="catatan" rows="3"
                          class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"><?= htmlspecialchars($jadwal['catatan'] ?? ''); ?></textarea>
            </div>

            <div class="flex justify-between items-center pt-2">
                <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= ucfirst($jenis); ?>Index"
                   class="text-xs md:text-sm text-slate-600 hover:underline">
                    &larr; Kembali ke daftar jadwal
                </a>
                <button type="submit"
                        class="bg-[#DB2777] text-white font-semibold text-xs md:text-sm px-4 py-2 rounded hover:bg-pink-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
