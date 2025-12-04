<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$badgeStatus = [
    'diajukan'   => 'bg-yellow-100 text-yellow-800',
    'disetujui'  => 'bg-green-100 text-green-800',
    'direvisi'   => 'bg-red-100 text-red-800',
];
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-4xl mx-auto px-4 py-4">

        <!-- Header -->
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-xl md:text-2xl font-semibold">Log Bimbingan Skripsi</h1>
                <p class="text-sm text-slate-500">
                    <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
                </p>

                <?php if (!empty($skripsiAktif)): ?>
                    <p class="text-xs text-slate-500 mt-1">
                        Pembimbing:
                        <span class="font-semibold text-slate-800">
                            <?= htmlspecialchars($skripsiAktif['nama_pembimbing']); ?>
                        </span>
                    </p>
                <?php else: ?>
                    <p class="text-xs text-red-600 mt-1">
                        ⚠️ Skripsi belum diterima / pembimbing belum ditetapkan.
                    </p>
                <?php endif; ?>
            </div>

            <?php if (!empty($skripsiAktif)): ?>
                <div class="flex gap-2">
                    <a href="<?= BASE_URL; ?>/?r=mahasiswa/logBimbinganPdf"
                       class="border border-pink-500 text-pink-600 text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-pink-50">
                        Cetak PDF
                    </a>
                    <a href="<?= BASE_URL; ?>/?r=mahasiswa/logBimbinganCreateForm"
                       class="bg-[#DB2777] text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-pink-700">
                        + Tambah Log
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Flash Success -->
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Topik</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Catatan Dosen</th>
                </tr>
                </thead>

                <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-slate-500">
                            Belum ada log bimbingan.
                        </td>
                    </tr>

                <?php else: ?>
                    <?php foreach ($items as $row): ?>
                        <?php
                        $status     = $row['status'];
                        $badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
                        ?>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= htmlspecialchars($row['tanggal']); ?>
                            </td>

                            <td class="px-4 py-2">
                                <div class="text-sm text-slate-800">
                                    <?= htmlspecialchars($row['topik']); ?>
                                </div>

                                <?php if (!empty($row['catatan_mahasiswa'])): ?>
                                    <div class="text-xs text-slate-500 mt-1">
                                        Catatan: <?= nl2br(htmlspecialchars($row['catatan_mahasiswa'])); ?>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                    <?= htmlspecialchars($status); ?>
                                </span>
                            </td>

                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= nl2br(htmlspecialchars($row['catatan_dosen'] ?? '-')); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/mahasiswa/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
