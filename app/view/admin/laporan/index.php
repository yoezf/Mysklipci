<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$badgeStatus = [
    'diajukan'  => 'bg-yellow-100 text-yellow-800',
    'diterima'  => 'bg-green-100 text-green-800',
    'ditolak'   => 'bg-red-100 text-red-800',
];
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
    <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

    <section class="flex-1 p-4 md:p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl md:text-2xl font-semibold">Laporan Akhir Mahasiswa</h1>
                <p class="text-sm text-slate-500">
                    Daftar semua laporan akhir yang diunggah mahasiswa.
                </p>
            </div>
            <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirArsip"
               class="text-xs md:text-sm text-pink-600 hover:underline">
                Lihat Arsip (diterima)
            </a>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Mahasiswa</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Prodi</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Judul</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">File</th>
                    <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-slate-500">
                            Belum ada laporan akhir.
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
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['nim']); ?> – <?= htmlspecialchars($row['nama_mhs']); ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['nama_prodi']); ?>
                            </td>
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($row['judul']); ?>
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                    <?= htmlspecialchars($status); ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 text-xs">
                                <a href="<?= BASE_URL . '/' . htmlspecialchars($row['file_path']); ?>"
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    Lihat PDF
                                </a>
                            </td>
                            <td class="px-4 py-2 text-right text-xs">
                                <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirDetail&id=<?= $row['id']; ?>"
                                   class="text-blue-600 hover:underline">
                                    Detail / ACC
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
