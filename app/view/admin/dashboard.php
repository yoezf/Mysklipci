<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">

        <!-- SIDEBAR ADMIN -->
        <?php include __DIR__ . '/../partials/admin/sidebar.php'; ?>

        <!-- KONTEN DASHBOARD -->
        <section class="flex-1 space-y-6">

            <!-- Judul -->
            <header>
                <h1 class="text-2xl md:text-3xl font-semibold text-slate-800">
                    Dashboard Admin
                </h1>
                <p class="text-sm text-slate-500">
                    Ringkasan data PKL &amp; Skripsi – pantau pengajuan, log, jadwal, dan laporan akhir.
                </p>
            </header>

            <!-- Kartu Statistik Utama -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                <div class="bg-white rounded-xl shadow-sm p-3 md:p-4">
                    <div class="text-[11px] uppercase tracking-wide text-slate-400">Mahasiswa</div>
                    <div class="mt-1 text-xl md:text-2xl font-bold text-slate-800">
                        <?= (int)($totalMahasiswa ?? 0); ?>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-3 md:p-4">
                    <div class="text-[11px] uppercase tracking-wide text-slate-400">Dosen</div>
                    <div class="mt-1 text-xl md:text-2xl font-bold text-slate-800">
                        <?= (int)($totalDosen ?? 0); ?>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-3 md:p-4">
                    <div class="text-[11px] uppercase tracking-wide text-slate-400">Program Studi</div>
                    <div class="mt-1 text-xl md:text-2xl font-bold text-slate-800">
                        <?= (int)($totalProdi ?? 0); ?>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-3 md:p-4">
                    <div class="text-[11px] uppercase tracking-wide text-slate-400">Jadwal 7 Hari ke Depan</div>
                    <div class="mt-1 text-xl md:text-2xl font-bold text-slate-800">
                        <?= (int)($jadwalMingguIni ?? 0); ?>
                    </div>
                </div>
            </div>

            <!-- Statistik Pengajuan & Aktivitas Log -->
            <div class="grid md:grid-cols-2 gap-4">
                <!-- Statistik Pengajuan -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold text-slate-800">Statistik Pengajuan</h2>
                        <span class="text-[11px] text-slate-400">
                            Total: <?= (int)($pengajuanStat['total'] ?? 0); ?>
                        </span>
                    </div>
                    <div class="grid grid-cols-3 gap-3 text-xs">
                        <div class="bg-slate-50 rounded-lg p-3">
                            <div class="text-[11px] text-slate-500 mb-1">Menunggu</div>
                            <div class="text-lg font-bold text-amber-500">
                                <?= (int)($pengajuanStat['menunggu'] ?? 0); ?>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-3">
                            <div class="text-[11px] text-slate-500 mb-1">Diterima</div>
                            <div class="text-lg font-bold text-emerald-500">
                                <?= (int)($pengajuanStat['diterima'] ?? 0); ?>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-3">
                            <div class="text-[11px] text-slate-500 mb-1">Ditolak</div>
                            <div class="text-lg font-bold text-rose-500">
                                <?= (int)($pengajuanStat['ditolak'] ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Log -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold text-slate-800">Aktivitas Log</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 rounded-lg p-3">
                            <div class="text-[11px] text-slate-500 mb-1">Log PKL</div>
                            <div class="text-lg font-bold text-slate-800">
                                <?= (int)($totalLogPkl ?? 0); ?>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-3">
                            <div class="text-[11px] text-slate-500 mb-1">Log Bimbingan Skripsi</div>
                            <div class="text-lg font-bold text-slate-800">
                                <?= (int)($totalLogBimbingan ?? 0); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengajuan Terbaru & Jadwal Terdekat -->
            <div class="grid md:grid-cols-2 gap-4">
                <!-- Pengajuan Terbaru -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold text-slate-800">Pengajuan Terbaru</h2>
                        <a href="<?= BASE_URL; ?>/?r=admin/pengajuanSkripsiIndex"
                           class="text-[11px] text-pink-500 hover:text-pink-600">
                            Lihat semua
                        </a>
                    </div>
                    <div class="space-y-2 text-xs">
                        <?php if (empty($pengajuanTerbaru)): ?>
                            <p class="text-slate-500 text-xs">Belum ada pengajuan terbaru.</p>
                        <?php else: ?>
                            <?php foreach ($pengajuanTerbaru as $p): ?>
                                <div class="border border-slate-100 rounded-lg px-3 py-2">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-slate-800">
                                            <?= htmlspecialchars($p['nama_mhs'] ?? '-'); ?>
                                        </span>
                                        <span class="text-[10px] px-2 py-0.5 rounded-full
                                            <?= ($p['status'] ?? '') === 'diterima'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : (($p['status'] ?? '') === 'ditolak'
                                                    ? 'bg-rose-50 text-rose-600'
                                                    : 'bg-amber-50 text-amber-600'); ?>">
                                            <?= strtoupper($p['status'] ?? '-'); ?>
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-500">
                                        <?= htmlspecialchars($p['nim'] ?? '-'); ?> • <?= htmlspecialchars($p['nama_prodi'] ?? '-'); ?>
                                    </div>
                                    <div class="mt-1 text-[11px] text-slate-700">
                                        <?= htmlspecialchars($p['judul'] ?? '-'); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Jadwal Terdekat -->
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold text-slate-800">Jadwal Terdekat</h2>
                        <a href="<?= BASE_URL; ?>/?r=admin/jadwalSeminarIndex"
                           class="text-[11px] text-pink-500 hover:text-pink-600">
                            Kelola jadwal
                        </a>
                    </div>
                    <div class="space-y-2 text-xs">
                        <?php if (empty($jadwalTerdekat)): ?>
                            <p class="text-slate-500 text-xs">Belum ada jadwal seminar/sidang dalam waktu dekat.</p>
                        <?php else: ?>
                            <?php foreach ($jadwalTerdekat as $j): ?>
                                <div class="border border-slate-100 rounded-lg px-3 py-2">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-slate-800">
                                            <?= htmlspecialchars($j['nama_mhs'] ?? '-'); ?>
                                        </span>
                                        <span class="text-[11px] text-slate-500">
                                            <?= htmlspecialchars($j['ruangan'] ?? '-'); ?>
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-500">
                                        <?= htmlspecialchars($j['nim'] ?? '-'); ?> • <?= htmlspecialchars($j['nama_prodi'] ?? '-'); ?>
                                    </div>
                                    <div class="mt-1 text-[11px] text-slate-700">
                                        <?= htmlspecialchars($j['judul'] ?? '-'); ?>
                                    </div>
                                    <div class="mt-1 text-[11px] text-slate-600">
                                        <?php if (!empty($j['tanggal'])): ?>
                                            <?= date('d M Y', strtotime($j['tanggal'])); ?> •
                                        <?php endif; ?>
                                        <?= !empty($j['jam_mulai']) ? substr($j['jam_mulai'], 0, 5) : '--:--'; ?>
                                        <?php if (!empty($j['jam_selesai'])): ?>
                                            - <?= substr($j['jam_selesai'], 0, 5); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Laporan Akhir Terbaru -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-sm font-semibold text-slate-800">Laporan Akhir Terbaru</h2>
                    <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirIndex"
                       class="text-[11px] text-pink-500 hover:text-pink-600">
                        Lihat semua
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs md:text-sm">
                        <thead class="bg-slate-50">
                        <tr>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Nama</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">NIM</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Prodi</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Judul Skripsi</th>
                            <th class="px-3 py-2 text-left text-[11px] font-semibold text-slate-500">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($laporanTerbaru)): ?>
                            <tr>
                                <td colspan="5" class="px-3 py-3 text-center text-slate-500 text-xs">
                                    Belum ada laporan akhir terbaru.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($laporanTerbaru as $la): ?>
                                <tr class="border-t">
                                    <td class="px-3 py-2 text-xs text-slate-700">
                                        <?= htmlspecialchars($la['nama_mhs'] ?? '-'); ?>
                                    </td>
                                    <td class="px-3 py-2 text-xs text-slate-700">
                                        <?= htmlspecialchars($la['nim'] ?? '-'); ?>
                                    </td>
                                    <td class="px-3 py-2 text-xs text-slate-700">
                                        <?= htmlspecialchars($la['nama_prodi'] ?? '-'); ?>
                                    </td>
                                    <td class="px-3 py-2 text-xs text-slate-700">
                                        <?= htmlspecialchars($la['judul_skripsi'] ?? '-'); ?>
                                    </td>
                                    <td class="px-3 py-2 text-xs">
                                        <span class="px-2 py-0.5 rounded-full text-[10px]
                                            <?= ($la['status'] ?? '') === 'diterima'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : (($la['status'] ?? '') === 'ditolak'
                                                    ? 'bg-rose-50 text-rose-600'
                                                    : 'bg-amber-50 text-amber-600'); ?>">
                                            <?= strtoupper($la['status'] ?? '-'); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
