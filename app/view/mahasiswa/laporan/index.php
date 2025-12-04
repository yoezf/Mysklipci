<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$badgeStatus = [
    'diajukan'  => 'bg-yellow-100 text-yellow-800',
    'diterima'  => 'bg-green-100 text-green-800',
    'ditolak'   => 'bg-red-100 text-red-800',
];
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-4xl mx-auto px-4 py-4">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-xl md:text-2xl font-semibold">Laporan Akhir</h1>
                <p class="text-sm text-slate-500">
                    <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
                </p>
            </div>
            <a href="<?= BASE_URL; ?>/?r=mahasiswa/laporanAkhirCreateForm"
               class="bg-[#DB2777] text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-pink-700">
                + Upload Laporan
            </a>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="mb-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_error']); ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Judul</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Catatan Admin</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">File</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-slate-500">
                            Belum ada laporan akhir yang diunggah.
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
                                <?= htmlspecialchars($row['created_at']); ?>
                            </td>
                            <td class="px-4 py-2">
                                <div class="text-sm font-semibold text-slate-800">
                                    <?= htmlspecialchars($row['judul']); ?>
                                </div>
                                <div class="text-xs text-slate-500">
                                    Skripsi: <?= htmlspecialchars($row['judul_skripsi']); ?>
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                    <?= htmlspecialchars($status); ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= nl2br(htmlspecialchars($row['catatan_admin'] ?? '-')); ?>
                            </td>
                            <td class="px-4 py-2 text-xs">
                                <a href="<?= BASE_URL . '/' . htmlspecialchars($row['file_path']); ?>"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    Lihat PDF
                                </a>
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
