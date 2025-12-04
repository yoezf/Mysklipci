<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-gradient-to-b from-slate-100 to-white min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-6 md:py-12">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-[#DB2777] mb-1">Log Harian PKL</h1>
                <p class="text-sm md:text-base text-slate-500">
                    <?= htmlspecialchars($mhs['nim'] ?? ''); ?> – <?= htmlspecialchars($mhs['nama'] ?? ''); ?>
                </p>
            </div>
            <div class="flex gap-2 mt-3 md:mt-0">
                <a href="<?= BASE_URL; ?>/?r=mahasiswa/logPklPdf"
                   class="bg-green-500 text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-green-700 transition shadow-sm">
                    Cetak PDF
                </a>
                <a href="<?= BASE_URL; ?>/?r=mahasiswa/logPklCreateForm"
                   class="bg-[#DB2777] text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-pink-700 transition shadow-sm">
                    + Tambah Log
                </a>
            </div>
        </div>

        <!-- Flash message -->
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 shadow animate-fadeIn">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm border-collapse">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Kegiatan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Lokasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500 italic">
                                Belum ada log PKL.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($items as $row): ?>
                            <tr class="border-t hover:bg-slate-50 transition">
                                <td class="px-4 py-2 text-xs text-slate-500"><?= htmlspecialchars($row['tanggal']); ?></td>
                                <td class="px-4 py-2">
                                    <div class="text-sm text-slate-800"><?= nl2br(htmlspecialchars($row['kegiatan'])); ?></div>
                                    <?php if (!empty($row['output'])): ?>
                                        <span class="inline-block mt-1 px-2 py-0.5 text-xs text-white bg-[#DB2777] rounded-full">
                                            Output: <?= nl2br(htmlspecialchars($row['output'])); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-2 text-sm text-slate-700"><?= htmlspecialchars($row['lokasi'] ?? '-'); ?></td>
                                <td class="px-4 py-2 text-xs text-slate-500">
                                    <?php if ($row['jam_mulai'] || $row['jam_selesai']): ?>
                                        <?= htmlspecialchars($row['jam_mulai'] ?? '-'); ?> - <?= htmlspecialchars($row['jam_selesai'] ?? '-'); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
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
