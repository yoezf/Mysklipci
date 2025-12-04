<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-semibold">Data Mahasiswa</h1>
                    <p class="text-sm text-slate-500">Kelola data mahasiswa terdaftar.</p>
                </div>
                <a href="<?= BASE_URL; ?>/?r=admin/mahasiswaCreateForm"
                    class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700">
                    + Tambah Mahasiswa
                </a>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">#</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">NIM</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Prodi</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Username</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Kelas</th>
                            <th class="px-4 py-2 text-left text-xs font-semibold text-slate-500">Angkatan</th>
                            <th class="px-4 py-2 text-right text-xs font-semibold text-slate-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr>
                                <td colspan="8" class="px-4 py-4 text-center text-slate-500">
                                    Belum ada data mahasiswa.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($items as $row): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?= $no++; ?></td>
                                    <td class="px-4 py-2 font-mono text-xs"><?= htmlspecialchars($row['nim']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['nama']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                    <td class="px-4 py-2 font-mono text-xs"><?= htmlspecialchars($row['username']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['kelas']); ?></td>
                                    <td class="px-4 py-2"><?= htmlspecialchars($row['angkatan']); ?></td>
                                    <td class="px-4 py-2 text-right space-x-1">

                                        <!-- Icon Edit -->
                                        <a href="<?= BASE_URL; ?>/?r=admin/mahasiswaEditForm&id=<?= $row['id']; ?>"
                                            class="inline-flex items-center p-1.5 bg-green-600 rounded hover:bg-green-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="white" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.125 19.688 3 21l1.312-4.125L16.862 3.487z" />
                                            </svg>
                                        </a>

                                        <!-- Icon Trash (Normal, Tidak Tebal) -->
                                        <a href="<?= BASE_URL; ?>/?r=admin/mahasiswaDelete&id=<?= $row['id']; ?>"
                                            class="inline-flex items-center p-1.5 bg-red-600 rounded hover:bg-red-700"
                                            onclick="return confirm('Yakin ingin menghapus mahasiswa ini beserta akun loginnya?');">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="white" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 6h18M8 6v12a2 2 0 002 2h4a2 2 0 002-2V6M10 10v6m4-6v6M9 6l.5-2h5L15 6" />
                                            </svg>
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