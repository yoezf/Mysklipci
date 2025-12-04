<?php include __DIR__ . '/../../partials/header.php'; ?>

<?php
// Label cantik untuk jenis
$labelJenis = [
    'pkl'     => 'PKL',
    'skripsi' => 'Skripsi',
    'seminar' => 'Seminar',
    'sidang'  => 'Sidang',
];
$jenisLabel = $labelJenis[$jenis] ?? strtoupper($jenis);

// Route penyimpanan
$storeRouteMap = [
    'pkl'     => 'mahasiswa/pengajuanPklStore',
    'skripsi' => 'mahasiswa/pengajuanSkripsiStore',
    'seminar' => 'mahasiswa/pengajuanSeminarStore',
    'sidang'  => 'mahasiswa/pengajuanSidangStore',
];
$storeRoute = $storeRouteMap[$jenis] ?? 'mahasiswa/pengajuanPklStore';
?>

<main class="flex-1 pb-16 md:pb-0 bg-gradient-to-b from-slate-100 to-white min-h-screen">
    <div class="max-w-md mx-auto px-4 py-6 md:py-10">

        <!-- Header -->
        <div class="mb-5 text-center">
            <h1 class="text-lg md:text-xl font-semibold text-slate-800 flex items-center justify-center gap-2">

                Pengajuan <?= htmlspecialchars($jenisLabel); ?>
            </h1>

            <p class="text-xs md:text-sm text-slate-500">
                Lengkapi form di bawah, lalu unggah berkas syarat (PDF).
            </p>
        </div>

        <!-- Flash message -->
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="mb-4 text-xs md:text-sm text-emerald-700 bg-emerald-50 border border-emerald-100 px-3 py-2 rounded-lg">
                <?= htmlspecialchars($_SESSION['flash_success']); ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="mb-4 text-xs md:text-sm text-red-700 bg-red-50 border border-red-100 px-3 py-2 rounded-lg">
                <?= htmlspecialchars($_SESSION['flash_error']); ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <!-- FORM UTAMA -->
        <form
            action="<?= BASE_URL; ?>/?r=<?= htmlspecialchars($storeRoute); ?>"
            method="post"
            enctype="multipart/form-data"
            class="bg-white shadow-md rounded-2xl p-4 md:p-6 space-y-4">

            <!-- ================= PKL ================= -->
            <?php if ($jenis === 'pkl'): ?>
                <h2 class="text-sm font-semibold text-pink-600 text-center mb-3 flex items-center justify-center gap-2">

                    Pengajuan Praktik Kerja Lapangan
                </h2>

                <!-- Tempat PKL -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">
                        Tempat Praktik
                    </label>
                    <input
                        type="text"
                        name="tempat_pkl"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        placeholder="Nama instansi/perusahaan"
                        required>
                </div>

                <!-- Tanggal Mulai & Selesai -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 flex gap-1 items-center">
                            Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                            required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1 flex items-center gap-1">
                            Tanggal Selesai
                        </label>
                        <input type="date" name="tanggal_selesai"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                            required>
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Keterangan (opsional)</label>
                    <textarea
                        name="keterangan"
                        rows="3"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        placeholder="Misal: jadwal kerja, divisi, dsb."></textarea>
                </div>

                <!-- ================= SKRIPSI ================= -->
            <?php elseif ($jenis === 'skripsi'): ?>

                <h2 class="text-sm font-semibold text-pink-600 text-center mb-2 flex items-center justify-center gap-2">
                    Pengajuan Judul Skripsi
                </h2>

                <!-- Judul Skripsi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">
                        Daftar Judul Skripsi (maksimal 5)
                    </label>

                    <div id="judul-wrapper" class="space-y-2">
                        <div class="flex gap-2">
                            <input type="text" name="judul_skripsi[]"
                                class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                                placeholder="Judul skripsi 1" required>
                        </div>
                    </div>

                    <!-- Button tambah judul -->
                    <button type="button" id="btn-add-judul"
                        class="mt-2 inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold border border-pink-300 text-pink-600 hover:bg-pink-50 transition">

                        <!-- PLUS CIRCLE ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>


                        Tambah Judul
                    </button>

                    <p class="mt-1 text-[11px] text-slate-500">Max 5 judul.</p>
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Keterangan (opsional)</label>
                    <textarea
                        name="keterangan"
                        rows="3"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        placeholder="Ringkas tujuan atau latar belakang skripsi."></textarea>
                </div>

                <!-- ================= SEMINAR / SIDANG ================= -->
            <?php else: ?>

                <h2 class="text-sm font-semibold text-pink-600 text-center mb-2 flex items-center justify-center gap-2">


                    Pengajuan <?= htmlspecialchars($jenisLabel); ?>
                </h2>

                <!-- Judul -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Judul <?= htmlspecialchars($jenisLabel); ?></label>
                    <input type="text" name="judul"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        placeholder="Judul pengajuan" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
                        placeholder="Tambahkan informasi pendukung."></textarea>
                </div>
            <?php endif; ?>

            <!-- ================= LAMPIRAN ================= -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1 flex items-center gap-1">



                    Berkas Persyaratan (PDF)
                </label>

                <input type="file" name="lampiran" accept="application/pdf"
                    class="block w-full text-xs md:text-sm text-slate-600 file:mr-3 file:py-2 
                              file:px-4 file:rounded-lg file:border-0 file:text-xs md:file:text-sm 
                              file:font-semibold file:bg-pink-600 file:text-white hover:file:bg-pink-700">
                <p class="mt-1 text-[11px] text-slate-500">Format PDF, maks 5 MB. Opsional.</p>

            </div>

            <!-- ================= BUTTON Aksi ================= -->
            <div class="pt-2 flex flex-col md:flex-row md:items-center md:justify-between gap-2">

                <!-- Tombol Ajukan -->
                <button type="submit"
                    class="inline-flex justify-center items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold
               bg-pink-600 text-white hover:bg-pink-700 transition shadow-md">

                    <!-- ICON PAPER AIRPLANE -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 12l18-9-5 18-4-6-6-3z" />
                    </svg>

                    Ajukan
                </button>

                <!-- Tombol Kembali -->
                <a href="<?= BASE_URL; ?>/?r=mahasiswa/dashboard"
                    class="inline-flex justify-center items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold
               bg-gray-700 text-white hover:bg-gray-800 transition shadow-md">
                    Kembali
                </a>

            </div>

        </form>

    </div>

    <?php include __DIR__ . '/../../partials/mahasiswa/bottom-nav.php'; ?>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>

<!-- Script tambah judul skripsi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenis = '<?= htmlspecialchars($jenis); ?>';
        if (jenis !== 'skripsi') return;

        const wrapper = document.getElementById('judul-wrapper');
        const btnAdd = document.getElementById('btn-add-judul');

        btnAdd.addEventListener('click', function() {
            const current = wrapper.querySelectorAll('input[name="judul_skripsi[]"]').length;
            if (current >= 5) {
                alert('Maksimal 5 judul skripsi.');
                return;
            }

            const div = document.createElement('div');
            div.className = 'flex gap-2';

            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'judul_skripsi[]';
            input.placeholder = 'Judul skripsi ' + (current + 1);
            input.required = current === 0;
            input.className = 'flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300';

            const btnRemove = document.createElement('button');
            btnRemove.type = 'button';
            btnRemove.textContent = '×';
            btnRemove.className = 'w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold text-slate-500 hover:bg-slate-200';
            btnRemove.addEventListener('click', () => div.remove());

            div.appendChild(input);
            div.appendChild(btnRemove);
            wrapper.appendChild(div);
        });
    });
</script>