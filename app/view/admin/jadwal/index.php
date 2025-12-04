<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">

        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6">

            <!-- Header -->
            <div class="flex flex-wrap items-center justify-between mb-4 gap-2">
                <div>
                    <h1 class="text-xl md:text-2xl font-semibold">
                        Kelola Jadwal <?= htmlspecialchars(ucfirst($jenis)); ?>
                    </h1>
                    <p class="text-xs md:text-sm text-slate-500">
                        Menampilkan jadwal <?= htmlspecialchars($jenis); ?> untuk seminar dan sidang.
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <!-- Tombol halaman Seminar -->
                    <a href="<?= BASE_URL; ?>/?r=admin/jadwalSeminarIndex"
                       class="px-3 py-1 rounded text-xs md:text-sm <?= $jenis === 'seminar' ? 'bg-[#DB2777] text-white' : 'bg-white text-slate-700 border'; ?>">
                        Seminar
                    </a>

                    <!-- Tombol halaman Sidang -->
                    <a href="<?= BASE_URL; ?>/?r=admin/jadwalSidangIndex"
                       class="px-3 py-1 rounded text-xs md:text-sm <?= $jenis === 'sidang' ? 'bg-[#DB2777] text-white' : 'bg-white text-slate-700 border'; ?>">
                        Sidang
                    </a>

                    <!-- Tambah data -->
                    <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= ucfirst($jenis); ?>CreateForm"
                       class="px-3 py-1 rounded bg-[#DB2777] text-white text-xs md:text-sm">
                        + Tambah Jadwal <?= htmlspecialchars(ucfirst($jenis)); ?>
                    </a>
                </div>
            </div>

            <!-- Tabel data -->
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full text-xs md:text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Nama</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">NIM</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Prodi</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Judul</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Pembimbing</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Penguji 1</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Penguji 2</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Tanggal</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Waktu</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Ruang</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Status</th>
                            <th class="px-3 py-2 text-right text-[11px] font-semibold text-slate-500">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="12" class="px-3 py-4 text-center text-slate-500 text-sm">
                                    Belum ada jadwal <?= htmlspecialchars($jenis); ?>.
                                </td>
                            </tr>

                        <?php else: ?>
                            <?php foreach ($items as $row): ?>
                                <tr class="border-t">
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_mhs']); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nim']); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['judul'] ?? ''); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_pembimbing'] ?? '-'); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_penguji1'] ?? '-'); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_penguji2'] ?? '-'); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['tanggal']); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700">
                                        <?= htmlspecialchars($row['jam_mulai']); ?>
                                        <?php if (!empty($row['jam_selesai'])): ?>
                                            - <?= htmlspecialchars($row['jam_selesai']); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['ruangan']); ?></td>
                                    <td class="px-3 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['status']); ?></td>

                                    <!-- Aksi -->
                                    <td class="px-3 py-2 text-right">
                                        <div class="inline-flex items-center space-x-1">
                                            <!-- Edit -->
                                            <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= ucfirst($jenis); ?>EditForm&id=<?= (int)$row['id']; ?>"
                                               class="p-1.5 bg-green-600 rounded hover:bg-green-700 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="white" class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.125 19.688 3 21l1.312-4.125L16.862 3.487z" />
                                                </svg>
                                            </a>

                                            <!-- Delete -->
                                            <a href="<?= BASE_URL; ?>/?r=admin/jadwal<?= ucfirst($jenis); ?>Delete&id=<?= (int)$row['id']; ?>"
                                               class="p-1.5 bg-red-600 rounded hover:bg-red-700 flex items-center justify-center"
                                               onclick="return confirm('Yakin ingin menghapus jadwal ini?');">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="white" class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M3 6h18M8 6v12a2 2 0 002 2h4a2 2 0 002-2V6M10 10v6m4-6v6M9 6l.5-2h5L15 6" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </section>
    </div>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
