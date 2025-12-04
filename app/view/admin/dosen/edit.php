<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 pb-16 md:pb-0 bg-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-6 flex gap-4">
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <section class="flex-1 p-4 md:p-6 max-w-2xl">
            <h1 class="text-xl md:text-2xl font-semibold mb-2">Edit Dosen</h1>
            <p class="text-sm text-slate-500 mb-4">
                Ubah data dosen dan akun login yang terhubung.
            </p>

            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                    <?= htmlspecialchars($_SESSION['flash_error']); ?>
                </div>
                <?php unset($_SESSION['flash_error']); ?>
            <?php endif; ?>

            <form action="<?= BASE_URL; ?>/?r=admin/dosenUpdate" method="post" class="grid md:grid-cols-2 gap-4">
                <input type="hidden" name="id" value="<?= (int)$dosen['id']; ?>">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        NIP
                    </label>
                    <input type="text" name="nip"
                        value="<?= htmlspecialchars($dosen['nip']); ?>"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Username (login)
                    </label>
                    <input type="text" name="username"
                        value="<?= htmlspecialchars($dosen['username']); ?>"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text" name="nama"
                        value="<?= htmlspecialchars($dosen['nama']); ?>"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Prodi
                    </label>
                    <select name="prodi_id"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]" required>
                        <option value="">-- Pilih Prodi --</option>
                        <?php foreach ($prodiList as $p): ?>
                            <option value="<?= $p['id']; ?>"
                                <?= ($p['id'] == $dosen['prodi_id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($p['nama_prodi']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        No. HP
                    </label>
                    <input
                        type="text"
                        name="no_hp"
                        maxlength="13"
                        pattern="[0-9]+"
                        inputmode="numeric"
                        class="border rounded px-3 py-2 w-full"
                        placeholder="08xxxxxxxxxx"
                        required
                        value="<?= htmlspecialchars($dosen['no_hp'] ?? ''); ?>"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-[#DB2777]">
                </div>

                <div class="md:col-span-2 flex items-center gap-2 mt-2">
                    <button type="submit"
                        class="bg-[#DB2777] text-white font-semibold px-4 py-2 rounded hover:bg-pink-700">
                        Update
                    </button>
                    <a href="<?= BASE_URL; ?>/?r=admin/dosenIndex"
                        class="text-sm text-slate-600 hover:underline">
                        Batal
                    </a>
                </div>
            </form>
        </section>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>