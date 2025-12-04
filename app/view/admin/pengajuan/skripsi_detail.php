<?php
// Pastikan variabel yang dipakai adalah $pengajuan
// Kalau di view kamu pakainya $item atau $row, ganti semua $pengajuan jadi nama variabel itu.
?>

<?php if (
    isset($pengajuan['id']) &&
    (!isset($pengajuan['jenis']) || $pengajuan['jenis'] === 'skripsi') &&
    !empty($pengajuan['pembimbing_id'])
): ?>
    <div class="mt-4">
        <a href="<?= BASE_URL; ?>/?r=admin/suratPenetapanPembimbingPdf&id=<?= (int)$pengajuan['id']; ?>"
            class="inline-flex items-center bg-green-500 text-white text-xs md:text-sm font-semibold px-3 py-2 rounded hover:bg-green-700">
            Cetak Surat Penetapan Pembimbing (PDF)
        </a>

    </div>
<?php endif; ?>