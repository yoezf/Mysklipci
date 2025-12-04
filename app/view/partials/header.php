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
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title); ?></title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS tambahan -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>/public/css/style.css">

    <!-- Heroicon -->
    <script src="https://unpkg.com/heroicons@2.0.13/dist/outline.js"></script>

    <link rel="icon" type="image/png" href="<?= BASE_URL; ?>/public/assets/img/favicon.ico">
    <link rel="shortcut icon" href="<?= BASE_URL; ?>/public/img/assets/favicon.png">


</head>

<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex flex-col">

        <!-- Top bar -->
        <header class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-30">
            <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
                <!-- Logo + nama sistem -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-3">
                        <img src="<?= BASE_URL; ?>/public/assets/img/logo.png"
                            alt="Logo Kampus"
                            class="h-10 w-auto object-contain">
                    </div>

                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-800">
                            SIPKS <span class="text-pink-600">– SKLIPCI</span>
                        </div>
                        <div class="text-[11px] text-slate-500">
                            Sistem Informasi Pengelolaan PKL &amp; Skripsi
                        </div>
                    </div>
                </div>

                <!-- User info / tombol login -->
                <div class="flex items-center gap-3">
                    <?php if ($user): ?>
                        <div class="hidden sm:flex flex-col items-end">
                            <span class="text-xs font-semibold text-slate-700">
                                <?= htmlspecialchars($user['nama'] ?? 'User'); ?>
                            </span>
                            <span class="text-[11px] uppercase tracking-wide text-pink-500">
                                <?= htmlspecialchars($user['role'] ?? ''); ?>
                            </span>
                        </div>
                        <a href="<?= BASE_URL; ?>/?r=auth/logout"
                            class="text-xs px-3 py-1.5 rounded-full border border-slate-200 text-slate-500 hover:border-pink-500 hover:text-pink-600">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL; ?>/?r=auth/login"
                            class="text-xs px-4 py-2 rounded-full bg-pink-500 text-white font-semibold hover:bg-pink-600 shadow-sm">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </header>