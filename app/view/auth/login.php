<?php

if (!isset($title)) {
    $title = 'SIPKS - Sistem Informasi Pengelolaan PKL & Skripsi';
}

$user         = $_SESSION['user'] ?? null;
$currentRoute = $_GET['r'] ?? 'public/home';

function is_active_nav(string $pattern, string $currentRoute): string
{
    return strpos($currentRoute, $pattern) === 0 ? 'text-pink-600 font-semibold' : 'text-slate-500';
}

$error = $error ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title); ?></title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/style.css">
</head>

<body class="bg-slate-100 text-slate-800">
<div class="min-h-screen flex flex-col">

    <!-- Main Login Page -->
    <main class="flex-1 flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur shadow-xl rounded-2xl p-8 border border-white/40">
                <a href="<?= BASE_URL; ?>/" class="inline-flex items-center gap-1 text-slate-600 hover:text-pink-600 text-sm mb-4 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <!-- Logo -->
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 mb-3">
                        <img src="<?= BASE_URL; ?>/public/assets/img/logo.png" alt="Logo SIPKS" class="w-full h-full object-contain">
                    </div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-wide">Login SIPKS</h1>
                    <p class="text-sm text-slate-500 mt-1 text-center">Silakan masuk ke akun Anda</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-300 rounded-lg px-4 py-2">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <!-- Form Login -->
                <form action="<?= BASE_URL; ?>/?r=auth/login" method="post" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="username">Username</label>
                        <input type="text" id="username" name="username"
                               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                               required placeholder="Masukkan username">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1" for="password">Password</label>
                        <input type="password" id="password" name="password"
                               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                               required placeholder="Masukkan password">
                    </div>

                    <button type="submit"
                            class="w-full bg-pink-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-pink-700 active:bg-pink-800 transition">
                        Masuk
                    </button>
                </form>

                <!-- Footer kecil di card -->
                <p class="text-center text-xs text-slate-500 mt-6">
                    © <?= date('Y'); ?> SIPKS — International Women University
                </p>
            </div>
        </div>
    </main>

    

</div> <!-- end min-h-screen -->

<script src="<?= BASE_URL; ?>/public/js/app.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggleBtn = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            var isHidden = sidebar.classList.contains('-translate-x-full');
            if (isHidden) {
                sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }
        });
    }

    if (overlay && sidebar) {
        overlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }
});
</script>

</body>
</html>
