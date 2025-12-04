<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-4">
        <?php include __DIR__ . '/../partials/admin/sidebar.php'; ?>
        <h1 class="text-xl md:text-2xl font-semibold mb-2">Dashboard Dosen</h1>
        <p class="text-sm text-slate-500 mb-4">
            <?= htmlspecialchars($dosen['nama']); ?>
        </p>

        <div class="grid gap-3 md:grid-cols-3 mb-4">
            <div class="bg-white shadow-md rounded-lg p-3">
                <p class="text-[11px] text-slate-500">Mahasiswa Bimbingan</p>
                <p class="text-2xl font-bold"><?= (int)$mhsBimbinganCount; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-3">
                <p class="text-[11px] text-slate-500">Log Bimbingan Menunggu</p>
                <p class="text-2xl font-bold text-yellow-500"><?= (int)$logPending; ?></p>
            </div>
            <div class="bg-white shadow-md rounded-lg p-3">
                <p class="text-[11px] text-slate-500">Jadwal Terdekat</p>
                <p class="text-2xl font-bold"><?= count($jadwalTerdekat); ?></p>
            </div>
        </div>

        <div class="grid gap-3 md:grid-cols-2 mb-6">
            <!-- Jadwal terdekat -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-sm font-semibold mb-2">Jadwal Seminar & Sidang Terdekat</h2>
                <div class="divide-y text-xs md:text-sm">
                    <?php if (empty($jadwalTerdekat)): ?>
                        <p class="text-slate-500 py-2 text-sm">Belum ada jadwal terdekat.</p>
                    <?php else: ?>
                        <?php foreach ($jadwalTerdekat as $j): ?>
                            <div class="py-2 flex justify-between gap-2">
                                <div>
                                    <p class="font-semibold text-slate-800">
                                        <?= htmlspecialchars(ucfirst($j['jenis'] ?? '')); ?>
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        <?= htmlspecialchars($j['nim']); ?> • <?= htmlspecialchars($j['nama_mhs']); ?>
                                    </p>
                                </div>
                                <div class="text-right text-xs text-slate-500">
                                    <p><?= htmlspecialchars($j['tanggal']); ?></p>
                                    <p><?= htmlspecialchars($j['jam_mulai']); ?> - <?= htmlspecialchars($j['jam_selesai']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Log bimbingan terbaru -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-sm font-semibold mb-2">Log Bimbingan Terbaru</h2>
                <div class="divide-y text-xs md:text-sm">
                    <?php if (empty($logTerbaru)): ?>
                        <p class="text-slate-500 py-2 text-sm">Belum ada log bimbingan.</p>
                    <?php else: ?>
                        <?php foreach ($logTerbaru as $lb): ?>
                            <div class="py-2">
                                <p class="font-semibold text-slate-800">
                                    <?= htmlspecialchars($lb['nim']); ?> • <?= htmlspecialchars($lb['nama_mhs']); ?>
                                </p>
                                <p class="text-xs text-slate-500">
                                    <?= htmlspecialchars($lb['tanggal']); ?> • Status: <?= htmlspecialchars($lb['status']); ?>
                                </p>
                                <p class="text-xs text-slate-500">
                                    <?= nl2br(htmlspecialchars($lb['topik'])); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../partials/dosen/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>