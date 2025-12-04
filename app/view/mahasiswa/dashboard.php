<?php include __DIR__ . '/../partials/header.php'; ?>

<main class="bg-slate-100 min-h-screen pb-20 md:pb-6">

    <div class="max-w-md mx-auto px-4 py-4 space-y-4">

        <!-- TITLE -->
        <div class="text-center">
            <h1 class="text-pink-600 font-semibold text-lg">Dashboard Mahasiswa</h1>
            <p class="text-[11px] text-slate-500 uppercase tracking-wide">SIPKS</p>
        </div>

        <!-- CARD PROFIL -->
        <section class="bg-white rounded-2xl shadow-md px-4 py-5">
            <div class="flex flex-col items-center">
                <div class="w-14 h-14 rounded-full bg-pink-50 flex items-center justify-center shadow-sm mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-pink-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 12a5 5 0 1 0-5-5a5 5 0 0 0 5 5z" />
                        <path d="M3 21a9 9 0 0 1 18 0" />
                    </svg>
                </div>

                <h2 class="text-sm font-semibold text-slate-800 uppercase">
                    <?= htmlspecialchars($mahasiswa['nama'] ?? '-') ?>
                </h2>
            </div>

            <div class="grid grid-cols-[auto,1fr] gap-y-1.5 gap-x-3 text-[11px] mt-3 text-slate-600">
                <span class="font-medium">NIM</span>
                <span>: <?= htmlspecialchars($mahasiswa['nim'] ?? '-') ?></span>

                <span class="font-medium">Prodi</span>
                <span>: <?= htmlspecialchars($mahasiswa['nama_prodi'] ?? '-') ?></span>

                <span class="font-medium">Email</span>
                <span>: <?= htmlspecialchars($mahasiswa['email'] ?? 'email@email.com') ?></span>

                <span class="font-medium">No HP</span>
                <span>: <?= htmlspecialchars($mahasiswa['no_hp'] ?? '-') ?></span>
            </div>
        </section>

        <!-- CARD DOSEN PEMBIMBING -->
        <section class="bg-white rounded-2xl shadow-md px-4 py-4">
            <h3 class="text-center text-[12px] font-semibold text-pink-600 mb-2">DOSEN PEMBIMBING</h3>
            <p class="text-center text-[12px] text-slate-700">
                <?= $dosenPembimbing
                    ? htmlspecialchars($dosenPembimbing)
                    : 'Belum ada dosen pembimbing yang ditetapkan.' ?>
            </p>
        </section>

        <!-- CARD PENGAJUAN -->
        <section class="bg-white rounded-2xl shadow-md px-4 py-4">
            <h3 class="text-center text-[12px] font-semibold text-pink-600 mb-3">PENGAJUAN</h3>

            <div class="relative">
                <select id="pengajuan-select"
                    class="w-full border rounded-full px-3 py-2 text-[12px] text-slate-700 appearance-none focus:outline-none focus:ring-1 focus:ring-pink-300">
                    <option value="">Pilih Pengajuan</option>
                    <option value="<?= BASE_URL ?>/?r=mahasiswa/pengajuanPklForm">PKL</option>
                    <option value="<?= BASE_URL ?>/?r=mahasiswa/pengajuanSkripsiForm">Skripsi</option>
                    <option value="<?= BASE_URL ?>/?r=mahasiswa/pengajuanSeminarForm">Seminar</option>
                    <option value="<?= BASE_URL ?>/?r=mahasiswa/pengajuanSidangForm">Sidang</option>
                </select>

                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">▾</span>
            </div>
        </section>

        <!-- CARD DAFTAR PENGAJUAN -->
        <section class="bg-white rounded-2xl shadow-md px-4 py-4">
            <h3 class="text-center text-[12px] font-semibold text-pink-600 mb-3">DAFTAR PENGAJUAN</h3>

            <!-- STATUS LEGEND -->
            <div class="flex items-center justify-center gap-4 mb-3 text-[10px]">
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-slate-300"></span> Diajukan
                </div>
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Ditolak
                </div>
                <div class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span> Diterima
                </div>
            </div>

            <!-- LIST -->
            <div class="divide-y text-[11px]">
                <?php if (empty($pengajuanRingkas)): ?>
                    <p class="py-3 text-center text-slate-500">Belum ada pengajuan.</p>
                <?php else: ?>
                    <?php foreach ($pengajuanRingkas as $p): ?>

                        <?php
                        $status = strtolower($p['status']);
                        $dot = [
                            'diterima' => 'bg-green-500',
                            'ditolak' => 'bg-red-500',
                            'diajukan' => 'bg-slate-300'
                        ][$status] ?? 'bg-slate-300';
                        ?>

                        <div class="py-2 flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-slate-700 uppercase">
                                    <?= htmlspecialchars($p['jenis']) ?>
                                </p>
                                <p class="text-[10px] text-slate-500">
                                    <?= htmlspecialchars($p['judul'] ?: '-') ?>
                                </p>
                            </div>

                            <div class="flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full <?= $dot ?>"></span>
                                <span class="text-[10px] capitalize text-slate-600"><?= $status ?></span>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

    </div>
</main>

<?php include __DIR__ . '/../partials/mahasiswa/bottom-nav.php'; ?>

<script>
    document.getElementById('pengajuan-select')?.addEventListener('change', function () {
        if (this.value) window.location.href = this.value;
    });
</script>
