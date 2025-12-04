<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
    <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

    <section class="flex-1 p-4 md:p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl md:text-2xl font-semibold">Arsip Laporan Akhir</h1>
                <p class="text-sm text-slate-500">
                    Laporan akhir yang sudah diterima (status DITERIMA).
                </p>
            </div>
            <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirIndex"
               class="text-xs md:text-sm text-pink-600 hover:underline">
                Kembali ke semua laporan
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tgl Diterima</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Mahasiswa</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Prodi</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Judul Skripsi</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">File</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-slate-500">
                            Belum ada arsip laporan akhir.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $row): ?>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= htmlspecialchars($row['updated_at'] ?: $row['created_at']); ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['nim']); ?> – <?= htmlspecialchars($row['nama_mhs']); ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['nama_prodi']); ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['judul_skripsi']); ?>
                            </td>
                            <td class="px-4 py-2 text-xs">
                                <a href="<?= BASE_URL . '/' . htmlspecialchars($row['file_path']); ?>"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    Download PDF
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
