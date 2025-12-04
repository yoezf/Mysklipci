<?php include __DIR__ . '/../../partials/header.php'; ?>

<main class="flex-1 bg-slate-100 min-h-screen pb-16 md:pb-0">
    <div class="max-w-6xl mx-auto px-4 md:px-6 py-6 flex flex-col md:flex-row gap-6">

        <!-- Sidebar -->
        <?php include __DIR__ . '/../../partials/admin/sidebar.php'; ?>

        <!-- Content -->
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-slate-800 mb-4">
                Profil Admin
            </h1>

            <!-- Flash Error -->
            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="mb-4 rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-sm text-red-700 shadow-sm">
                    <?= htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <!-- Flash Success -->
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="mb-4 rounded-lg bg-emerald-100 border border-emerald-300 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                    <?= htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?>
                </div>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="bg-white shadow-lg rounded-xl p-6 border border-slate-200">
                <form action="<?= BASE_URL; ?>/?r=admin/profilAdminUpdate" method="post" class="space-y-5">

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Username
                        </label>
                        <input 
                            type="text" 
                            name="username" 
                            value="<?= htmlspecialchars($admin['username']); ?>"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm shadow-sm
                                   focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                            required>
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            name="nama" 
                            value="<?= htmlspecialchars($admin['nama']); ?>"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm shadow-sm
                                   focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                            required>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-3 pt-2">
                        <button 
                            type="submit"
                            class="bg-pink-600 hover:bg-pink-700 text-white font-semibold text-sm px-5 py-2.5
                                   rounded-lg transition-all shadow-sm hover:shadow-md">
                            Simpan Perubahan
                        </button>

                        <a href="<?= BASE_URL; ?>/?r=admin/gantiPasswordAdminForm"
                           class="text-sm text-pink-700 hover:underline font-medium">
                            Ganti Password
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</main>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
