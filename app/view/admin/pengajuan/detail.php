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

$jenisLabel     = $labelJenis[$jenis] ?? strtoupper($jenis);
$status         = $pengajuan['status'];
$badgeClass     = $badgeStatus[$status] ?? 'bg-slate-100 text-slate-700';
$namaPembimbing = $pengajuan['nama_pembimbing'] ?? null;
$nipPembimbing  = $pengajuan['nip_pembimbing'] ?? null;
?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">

        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6 max-w-3xl">

            <!-- Back Button -->
            <a href="<?= BASE_URL; ?>/?r=admin/pengajuan<?= ucfirst($jenis); ?>Index"
                class="text-xs text-slate-500 hover:text-pink-600 inline-flex items-center mb-3">
                ← Kembali ke daftar
            </a>

            <!-- Title -->
            <h1 class="text-xl md:text-2xl font-semibold mb-2">
                Detail Pengajuan <?= htmlspecialchars($jenisLabel); ?>
            </h1>

            <!-- Flash Success -->
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    <?= htmlspecialchars($_SESSION['flash_success']); ?>
                </div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>

            <!-- Pengajuan Detail -->
            <div class="bg-white shadow-md rounded-lg p-4 space-y-3 mb-4">

                <!-- Mahasiswa & Status -->
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-500">Mahasiswa</p>
                        <p class="text-sm font-semibold text-slate-800">
                            <?= htmlspecialchars($pengajuan['nim']); ?> – <?= htmlspecialchars($pengajuan['nama_mhs']); ?>
                        </p>
                        <p class="text-xs text-slate-500">
                            <?= htmlspecialchars($pengajuan['nama_prodi']); ?>
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="text-xs text-slate-500">Tgl Pengajuan</p>
                        <p class="text-sm text-slate-700">
                            <?= htmlspecialchars($pengajuan['created_at']); ?>
                        </p>
                        <span class="inline-flex mt-1 px-2 py-1 rounded-full text-xs <?= $badgeClass; ?>">
                            <?= htmlspecialchars($status); ?>
                        </span>
                    </div>
                </div>

                <!-- Judul -->
                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">Judul</p>
                    <p class="text-sm font-semibold text-slate-800">
                        <?= htmlspecialchars($pengajuan['judul']); ?>
                    </p>
                </div>

                <!-- Deskripsi -->
                <div class="border-t pt-3">
                    <p class="text-xs text-slate-500 mb-1">Deskripsi</p>
                    <p class="text-sm text-slate-800 whitespace-pre-line">
                        <?= nl2br(htmlspecialchars($pengajuan['deskripsi'] ?? '-')); ?>
                    </p>
                </div>

                <!-- Lampiran syarat (PDF) -->
                <?php if (!empty($pengajuan['lampiran'])): ?>
                    <div class="border-t pt-3">
                        <p class="text-xs text-slate-500 mb-1">Lampiran Syarat</p>
                        <a href="<?= BASE_URL . '/' . htmlspecialchars($pengajuan['lampiran']); ?>"
                            target="_blank"
                            class="inline-flex items-center text-xs text-pink-600 hover:underline">
                            Lihat PDF Syarat
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Pembimbing -->
                <div class="border-t pt-3">


                    <!-- Pembimbing -->
                    <div class="border-t pt-3">
                        <p class="text-xs text-slate-500 mb-1">Pembimbing Saat Ini</p>

                        <?php if ($namaPembimbing): ?>
                            <p class="text-sm text-slate-800">
                                <?= htmlspecialchars($namaPembimbing); ?>
                                <?php if ($nipPembimbing): ?>
                                    <span class="text-xs text-slate-500"> (<?= htmlspecialchars($nipPembimbing); ?>)</span>
                                <?php endif; ?>
                            </p>
                        <?php else: ?>
                            <p class="text-sm text-slate-500">Belum ditetapkan.</p>
                        <?php endif; ?>
                    </div>
                </div>



                <!-- Form ACC/Tolak -->
                <div class="bg-white shadow-md rounded-lg p-4 mt-4">

                    <h2 class="text-sm font-semibold text-slate-800 mb-3">
                        ACC / Tolak & Penetapan Pembimbing
                    </h2>

                    <form action="<?= BASE_URL; ?>/?r=admin/pengajuanUpdateStatus" method="post" class="space-y-4">

                        <input type="hidden" name="id" value="<?= (int)$pengajuan['id']; ?>">
                        <input type="hidden" name="jenis" value="<?= htmlspecialchars($jenis); ?>">

                        <!-- Status -->
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Status Pengajuan</p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                <label class="inline-flex items-center gap-1">
                                    <input type="radio" name="status" value="diajukan" <?= $status === 'diajukan' ? 'checked' : ''; ?>>
                                    <span>Diajukan</span>
                                </label>

                                <label class="inline-flex items-center gap-1">
                                    <input type="radio" name="status" value="diterima" <?= $status === 'diterima' ? 'checked' : ''; ?>>
                                    <span>DITERIMA</span>
                                </label>

                                <label class="inline-flex items-center gap-1">
                                    <input type="radio" name="status" value="ditolak" <?= $status === 'ditolak' ? 'checked' : ''; ?>>
                                    <span>DITOLAK</span>
                                </label>
                            </div>
                        </div>

                        <!-- Penetapan Pembimbing -->
                        <?php if (in_array($jenis, ['pkl', 'skripsi'], true)): ?>
                            <div>
                                <label class="block text-xs text-slate-500 mb-1">
                                    Penetapan Pembimbing <?= htmlspecialchars($jenisLabel); ?>
                                    <span class="text-[10px] text-slate-400">(opsional, tapi disarankan)</span>
                                </label>

                                <select name="pembimbing_id"
                                    class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]">
                                    <option value="0">-- Belum / Tidak ditetapkan --</option>

                                    <?php foreach ($dosenList as $d): ?>
                                        <option value="<?= $d['id']; ?>"
                                            <?= (!empty($pengajuan['pembimbing_id']) && $pengajuan['pembimbing_id'] == $d['id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($d['nama']); ?> (<?= htmlspecialchars($d['nama_prodi']); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <!-- Catatan -->
                        <div>
                            <label class="block text-xs text-slate-500 mb-1">Catatan untuk Mahasiswa</label>

                            <textarea name="catatan_admin" rows="3"
                                class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-[#DB2777]"
                                placeholder="Tulis alasan ACC/TOLAK, revisi yang diminta, dll."><?= htmlspecialchars($pengajuan['catatan_admin'] ?? ''); ?></textarea>
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center gap-2">
                            <?php if ($jenis === 'pkl' && $pengajuan['status'] === 'diterima'): ?>
                                <a href="<?= BASE_URL; ?>/?r=admin/suratIzinPklPdf&id=<?= $pengajuan['id']; ?>"
                                    class="inline-flex items-center bg-green-500 text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-green-700">
                                    Cetak Surat Izin PKL (PDF)
                                </a>
                            <?php endif; ?>
                            <!-- Cetak Penetapan Pembimbing -->
                            <?php if (
                                $jenis === 'skripsi' &&
                                !empty($pengajuan['pembimbing_id']) &&
                                isset($pengajuan['id'])
                            ): ?>

                                <a href="<?= BASE_URL; ?>/?r=admin/suratPenetapanPembimbingPdf&id=<?= (int)$pengajuan['id']; ?>"
                                    class="inline-flex items-center bg-green-500 text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-pink-700">
                                    Cetak Surat Penetapan Pembimbing
                                </a>

                            <?php endif; ?>
                            <button type="submit"
                                class="bg-[#DB2777] text-white text-sm font-semibold px-4 py-2 rounded hover:bg-pink-700 transition">
                                Simpan Perubahan
                            </button>
                            <span class="text-[11px] text-slate-400">
                                Perubahan ini akan terlihat di riwayat pengajuan mahasiswa.
                            </span>
                        </div>

                    </form>
                </div>

        </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>