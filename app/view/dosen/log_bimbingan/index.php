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
        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Log Bimbingan Mahasiswa
        </h1>
        <p class="text-sm text-slate-500 mb-4">
            Dosen: <?= htmlspecialchars($dosen['nama'] ?? ''); ?>
        </p>

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
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Topik</th>
                        <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                        <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-slate-500">
                                Belum ada log bimbingan dari mahasiswa.
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
                                <td class="px-4 py-2 text-sm">
                                    <?= htmlspecialchars($row['nim']); ?> – <?= htmlspecialchars($row['nama_mhs']); ?>
                                </td>
                                <td class="px-4 py-2 text-sm">
                                    <?= htmlspecialchars($row['topik']); ?>
                                </td>
                                <td class="px-4 py-2">
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                        <?= htmlspecialchars($status); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-right">
                                    <a href="<?= BASE_URL; ?>/?r=dosen/logBimbinganDetail&id=<?= $row['id']; ?>"
                                        class="text-xs text-blue-600 hover:underline">
                                        Detail / ACC
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/dosen/bottom-nav.php'; // kalau sudah ada 
    ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>