<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$labelJenis = [
    'seminar' => 'Seminar',
    'sidang'  => 'Sidang',
];
$badgeStatus = [
    'dijadwalkan'  => 'bg-yellow-100 text-yellow-800',
    'dikonfirmasi' => 'bg-green-100 text-green-800',
    'ditolak'      => 'bg-red-100 text-red-800',
];

$jenisLabel = $labelJenis[$jadwal['jenis']] ?? ucfirst($jadwal['jenis']);
$status     = $jadwal['status'];
$badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-3xl mx-auto px-4 py-4">
        <a href="<?= BASE_URL; ?>/?r=dosen/jadwalIndex"
           class="text-xs text-slate-500 hover:text-pink-600 inline-flex items-center mb-3">
            ← Kembali ke jadwal
        </a>

        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Detail Jadwal <?= htmlspecialchars($jenisLabel); ?>
        </h1>

        <div class="bg-white shadow-md rounded-lg p-4 space-y-3 mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-500">Mahasiswa</p>
                    <p class="text-sm font-semibold text-slate-800">
                        <?= htmlspecialchars($jadwal['nim']); ?> – <?= htmlspecialchars($jadwal['nama_mhs']); ?>
                    </p>
                    <p class="text-xs text-slate-500">
                        <?= htmlspecialchars($jadwal['nama_prodi']); ?>
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-500">Tanggal & Jam</p>
                    <p class="text-sm text-slate-800">
                        <?= htmlspecialchars($jadwal['tanggal']); ?>,
                        <?= htmlspecialchars($jadwal['jam_mulai']); ?><?= $jadwal['jam_selesai'] ? ' - ' . htmlspecialchars($jadwal['jam_selesai']) : ''; ?>
                    </p>
                    <span class="inline-flex mt-1 px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                        <?= htmlspecialchars($status); ?>
                    </span>
                </div>
            </div>

            <div class="border-t pt-3">
                <p class="text-xs text-slate-500 mb-1">Ruangan</p>
                <p class="text-sm text-slate-800">
                    <?= htmlspecialchars($jadwal['ruangan']); ?>
                </p>
            </div>

            <div class="border-t pt-3 grid md:grid-cols-2 gap-3">
                <div>
                    <p class="text-xs text-slate-500 mb-1">Pembimbing</p>
                    <p class="text-sm text-slate-800">
                        <?= htmlspecialchars($jadwal['nama_pembimbing'] ?? '-'); ?>
                    </p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 mb-1">Penguji</p>
                    <p class="text-sm text-slate-800">
                        <?= htmlspecialchars($jadwal['nama_penguji'] ?? '-'); ?>
                    </p>
                </div>
            </div>

            <?php if (!empty($jadwal['catatan'])): ?>
                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">Catatan (admin / sistem)</p>
                    <p class="text-sm text-slate-800 whitespace-pre-line">
                        <?= nl2br(htmlspecialchars($jadwal['catatan'])); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-sm font-semibold text-slate-800 mb-3">
                Konfirmasi Jadwal
            </h2>

            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    <?= htmlspecialchars($_SESSION['flash_success']); ?>
                </div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL; ?>/?r=dosen/jadwalKonfirmasiUpdate" method="post" class="space-y-4">
                <input type="hidden" name="id" value="<?= (int)$jadwal['id']; ?>">

                <div>
                    <p class="text-xs text-slate-500 mb-1">Status Jadwal</p>
                    <div class="flex flex-wrap gap-4 text-sm">
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="dijadwalkan"
                                <?= $status === 'dijadwalkan' ? 'checked' : ''; ?>>
                            <span>Dijadwalkan (belum konfirmasi)</span>
                        </label>
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="dikonfirmasi"
                                <?= $status === 'dikonfirmasi' ? 'checked' : ''; ?>>
                            <span>Dikonfirmasi</span>
                        </label>
                        <label class="inline-flex items-center gap-1">
                            <input type="radio" name="status" value="ditolak"
                                <?= $status === 'ditolak' ? 'checked' : ''; ?>>
                            <span>Tidak bisa hadir</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-slate-500 mb-1">
                        Catatan untuk Admin / Mahasiswa
                    </label>
                    <textarea
                        name="catatan"
                        rows="3"
                        class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                        placeholder="Tulis catatan jika perlu, misalnya usulan penggantian jadwal / ruangan..."
                    ><?= htmlspecialchars($jadwal['catatan'] ?? ''); ?></textarea>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                            class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                        Simpan Konfirmasi
                    </button>
                    <span class="text-[11px] text-slate-400">
                        Status ini akan terlihat oleh admin & mahasiswa.
                    </span>
                </div>
            </form>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/dosen/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
