<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
$labelJenis = [
    'pkl'     => 'PKL',
    'skripsi' => 'Skripsi',
    'seminar' => 'Seminar',
    'sidang'  => 'Sidang',
];
$badgeStatus = [
    'diajukan' => 'bg-yellow-100 text-yellow-800',
    'diterima' => 'bg-green-100 text-green-800',
    'ditolak'  => 'bg-red-100 text-red-800',
];
$jenisLabel = $labelJenis[$jenis] ?? strtoupper($jenis);
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6">
            <h1 class="text-xl md:text-2xl font-semibold mb-2">
                Pengajuan <?= htmlspecialchars($jenisLabel); ?>
            </h1>
            <p class="text-sm text-slate-500 mb-4">
                Daftar pengajuan <?= htmlspecialchars($jenisLabel); ?> oleh mahasiswa.
            </p>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Tgl</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">NIM</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Prodi</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Judul</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Status</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-slate-500">
                                    Belum ada pengajuan.
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
                                    <td class="px-4 py-2 font-mono text-xs"><?= htmlspecialchars($row['nim']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['nama_mhs']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['judul']); ?></td>
                                    <td class="px-4 py-2">
                                        <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                            <?= htmlspecialchars($status); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <a href="<?= BASE_URL; ?>/?r=admin/pengajuan<?= $jenisLabel; ?>Detail&id=<?= $row['id']; ?>"
                                            class="flex items-center justify-end text-xs text-blue-600 gap-1 px-2 py-1 rounded hover:bg-blue-50 transition-all duration-200">
                                            <!-- Icon: Eye (Detail) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="transition-transform duration-200 group-hover:translate-x-1">Detail</span>
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