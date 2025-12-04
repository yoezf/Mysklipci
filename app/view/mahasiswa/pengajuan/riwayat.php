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
?>

<main class="flex-1 pb-16 md:pb-0 bg-gradient-to-b from-slate-100 to-white min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-6 md:py-12">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-[#DB2777] mb-1">Riwayat Pengajuan</h1>
                <p class="text-sm md:text-base text-slate-500">
                    Mahasiswa: <span class="font-medium"><?= htmlspecialchars($mhs['nim'] ?? ''); ?></span> –
                    <span class="font-medium"><?= htmlspecialchars($mhs['nama'] ?? ''); ?></span>
                </p>
            </div>

            <!-- Tombol +Jenis: desktop & dropdown mobile -->
            <div class="flex items-center gap-2 mt-3 md:mt-0">
                <!-- Desktop -->
                <div class="hidden md:flex gap-2">
                    <?php foreach ($labelJenis as $key => $label): ?>
                        <a href="<?= BASE_URL; ?>/?r=mahasiswa/pengajuan<?= ucfirst($label); ?>Form"
                            class="text-xs md:text-sm bg-white border rounded px-3 py-1 hover:bg-pink-50 transition">
                            + <?= $label ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <!-- Mobile Dropdown -->
                <div class="md:hidden relative">
                    <button id="dropdownBtn" class="text-xs bg-white border rounded px-3 py-1 hover:bg-pink-50 transition w-full text-left">
                        + Pengajuan
                    </button>
                    <div id="dropdownMenu" class="absolute mt-1 w-40 bg-white border rounded shadow-lg hidden flex-col z-10">
                        <?php foreach ($labelJenis as $key => $label): ?>
                            <a href="<?= BASE_URL; ?>/?r=mahasiswa/pengajuan<?= ucfirst($label); ?>Form"
                                class="px-4 py-2 text-sm hover:bg-pink-50 transition">
                                <?= $label ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash message -->
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 shadow animate-fadeIn">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <!-- Filter Status -->
        <div class="flex flex-wrap gap-2 mb-4">
            <span class="font-semibold text-sm">Filter Status:</span>
            <?php foreach ($badgeStatus as $status => $class): ?>
                <button class="status-filter px-3 py-1 rounded-full text-xs <?= $class; ?> hover:opacity-80 transition" data-status="<?= $status ?>">
                    <?= ucfirst($status); ?>
                </button>
            <?php endforeach; ?>
            <button id="resetFilter" class="px-3 py-1 rounded-full text-xs bg-slate-200 text-slate-700 hover:opacity-80 transition">
                Reset
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm border-collapse">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Tgl Pengajuan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Jenis</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Pembimbing</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500">Catatan Admin</th>
                    </tr>
                </thead>

                <tbody id="pengajuanTable">
                    <?php if (empty($items)): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-slate-500 italic">
                                Belum ada pengajuan.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($items as $row): ?>
                            <?php
                            $jenisText  = $labelJenis[$row['jenis']] ?? strtoupper($row['jenis']);
                            $status     = $row['status'];
                            $badgeClass = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
                            ?>
                            <tr class="border-t" data-status="<?= $status ?>">
                                <td class="px-4 py-2 text-xs text-slate-500"><?= htmlspecialchars($row['created_at']); ?></td>
                                <td class="px-4 py-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-pink-50 text-pink-700">
                                        <?= htmlspecialchars($jenisText); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($row['judul']); ?></td>
                                <td class="px-4 py-2">
                                    <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                                        <?= htmlspecialchars($status); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-xs text-slate-700"><?= htmlspecialchars($row['nama_pembimbing'] ?? '-'); ?></td>
                                <td class="px-4 py-2 text-xs text-slate-500"><?= nl2br(htmlspecialchars($row['catatan_admin'] ?? '-')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <td class="px-4 py-3 text-xs text-slate-700">
                        <?php if (!empty($row['lampiran'])): ?>
                            <a href="<?= BASE_URL . '/' . htmlspecialchars($row['lampiran']); ?>"
                                target="_blank"
                                class="inline-flex items-center gap-1 text-[11px] text-pink-600 hover:underline">
                                Lihat Lampiran
                            </a>
                        <?php else: ?>
                            <span class="text-[11px] text-slate-400">-</span>
                        <?php endif; ?>
                    </td>



                </tbody>
            </table>
        </div>
    </div>

    <?php include __DIR__ . '/../../partials/mahasiswa/bottom-nav.php'; ?>
</main>

<script>
    // Dropdown mobile
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Filter status
    const filterButtons = document.querySelectorAll('.status-filter');
    const resetBtn = document.getElementById('resetFilter');
    const tableRows = document.querySelectorAll('#pengajuanTable tr[data-status]');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const status = btn.getAttribute('data-status');
            tableRows.forEach(row => {
                row.style.display = row.getAttribute('data-status') === status ? '' : 'none';
            });
        });
    });

    resetBtn.addEventListener('click', () => {
        tableRows.forEach(row => row.style.display = '');
    });
</script>

<?php include __DIR__ . '/../../partials/footer.php'; ?>