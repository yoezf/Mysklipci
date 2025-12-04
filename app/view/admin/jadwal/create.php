<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$labelJenis = [
    'seminar' => 'Seminar',
    'sidang'  => 'Sidang',
];
$jenisLabel = $labelJenis[$jenis] ?? ucfirst($jenis);
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
    <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

    <section class="flex-1 p-4 md:p-6 max-w-3xl">
        <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= $jenisLabel; ?>Index"
            class="text-xs text-slate-500 hover:text-pink-600 inline-flex items-center mb-3">
            ← Kembali ke daftar
        </a>

        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Tambah Jadwal <?= htmlspecialchars($jenisLabel); ?>
        </h1>
        <p class="text-sm text-slate-500 mb-4">
            Pilih pengajuan yang sudah diterima, lalu atur tanggal, jam, dan ruangan.
        </p>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="mb-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_error']); ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL; ?>/?r=admin/jadwal<?= $jenisLabel; ?>Store" method="post" class="space-y-4">
            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">
                    Pengajuan <?= htmlspecialchars($jenisLabel); ?>
                </label>
                <select name="pengajuan_id"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                    <option value="">-- Pilih pengajuan yang sudah diterima --</option>
                    <?php foreach ($pengajuanList as $p): ?>
                        <option value="<?= $p['id']; ?>">
                            <?= htmlspecialchars($p['nim']); ?> – <?= htmlspecialchars($p['nama_mhs']); ?> (<?= htmlspecialchars($p['nama_prodi']); ?>)
                            | <?= htmlspecialchars(mb_strimwidth($p['judul'], 0, 50, '...')); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">
                        Tanggal
                    </label>
                    <input type="date" name="tanggal"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">
                        Jam Mulai - Jam Selesai
                    </label>
                    <div class="flex gap-2">
                        <input type="time" name="jam_mulai"
                            class="w-1/2 border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                        <input type="time" name="jam_selesai"
                            class="w-1/2 border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">
                    Ruangan
                </label>
                <input type="text" name="ruangan"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                    placeholder="Mis: Ruang Seminar A, Lab 2, Auditorium" required>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">
                    Dosen Penguji (opsional)
                </label>
                <select name="dosen_penguji_id"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                    <option value="0">-- Belum / tidak ditetapkan --</option>
                    <?php foreach ($dosenList as $d): ?>
                        <option value="<?= $d['id']; ?>">
                            <?= htmlspecialchars($d['nama']); ?> (<?= htmlspecialchars($d['nama_prodi']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="dosen_penguji_2_id"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777] mt-2">
                    <option value="0">-- Belum / tidak ditetapkan --</option>
                    <?php foreach ($dosenList as $d): ?>
                        <option value="<?= $d['id']; ?>">
                            <?= htmlspecialchars($d['nama']); ?> (<?= htmlspecialchars($d['nama_prodi']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-700 mb-1">
                    Catatan (opsional)
                </label>
                <textarea name="catatan" rows="3"
                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                    placeholder="Keterangan tambahan, misalnya: pakaian hitam putih, hadir 15 menit sebelum acara, dll."></textarea>
            </div>

            <div class="flex items-center gap-2 mt-2">
                <button type="submit"
                    class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                    Simpan Jadwal
                </button>
                <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= $jenisLabel; ?>Index"
                    class="text-sm text-slate-600 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>