<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
    <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

    <section class="flex-1 p-4 md:p-6 max-w-xl">
        <h1 class="text-xl md:text-2xl font-semibold mb-2">Edit Prodi</h1>
        <p class="text-sm text-slate-500 mb-4">
            Ubah data program studi.
        </p>

        <form action="<?= BASE_URL; ?>/?r=admin/prodiUpdate" method="post" class="space-y-4">
            <input type="hidden" name="id" value="<?= (int)$prodi['id']; ?>">

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Kode Prodi
                </label>
                <input type="text" name="kode_prodi"
                       value="<?= htmlspecialchars($prodi['kode_prodi']); ?>"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nama Prodi
                </label>
                <input type="text" name="nama_prodi"
                       value="<?= htmlspecialchars($prodi['nama_prodi']); ?>"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit"
                        class="bg-[#DB2777] text-white font-semibold px-4 py-2 rounded hover:bg-pink-700">
                    Update
                </button>
                <a href="<?= BASE_URL; ?>/?r=admin/prodiIndex"
                   class="text-sm text-slate-600 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
