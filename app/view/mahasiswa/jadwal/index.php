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
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100">
    <div class="max-w-4xl mx-auto px-4 py-4">
        <h1 class="text-xl md:text-2xl font-semibold mb-2">
            Jadwal Seminar & Sidang
        </h1>
        <p class="text-sm text-slate-500 mb-4">
            <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
        </p>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Jam</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Ruangan</th>
                    <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-slate-500">
                            Belum ada jadwal seminar / sidang untuk Anda.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $row): ?>
                        <?php
                        $jenisLabel = $labelJenis[$row['jenis']] ?? ucfirst($row['jenis']);
                        $status     = $row['status'];
                        $badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
                        ?>
                        <tr class="border-t">
                            <td class="px-4 py-2 text-sm">
                                <?= htmlspecialchars($jenisLabel); ?>
                            </td>
                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= htmlspecialchars($row['tanggal']); ?>
                            </td>
                            <td class="px-4 py-2 text-xs text-slate-500">
                                <?= htmlspecialchars($row['jam_mulai']); ?><?= $row['jam_selesai'] ? ' - ' . htmlspecialchars($row['jam_selesai']) : ''; ?>
                            </td>
                            <td class="px-4 py-2 text-sm text-slate-800">
                                <?= htmlspecialchars($row['ruangan']); ?>
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                    <?= htmlspecialchars($status); ?>
                                </span>
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
