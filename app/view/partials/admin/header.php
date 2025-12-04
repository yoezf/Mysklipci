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

    <link rel="icon" type="image/png" href="<?= BASE_URL; ?>/public/img/favicon.ico">
    <link rel="shortcut icon" href="<?= BASE_URL; ?>/public/img/favicon.png">


</head>

<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex flex-col">

        <!-- Top bar -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
    <div class="px-4 py-3 flex items-center justify-between border-b border-slate-100">

        <!-- Kiri: tombol hamburger + logo -->
        <div class="flex items-center gap-3">
            <!-- HAMBURGER: hanya tampil di mobile/tablet -->
            <button
                id="admin-menu-toggle"
                class="inline-flex items-center justify-center p-2 rounded-lg border border-slate-200 md:hidden
                       text-slate-600 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-pink-500"
                type="button"
                aria-label="Toggle sidebar">
                <!-- ikon hamburger simple -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="18" x2="20" y2="18"></line>
                </svg>
            </button>

            <!-- LOGO + BRAND -->
            <div class="flex items-center gap-2">
                <img src="<?= BASE_URL; ?>/public/img/logo.png"
                     alt="Logo Kampus"
                     class="h-8 w-auto object-contain">
                <div class="leading-tight">
                    <div class="text-sm font-semibold text-slate-800">
                        Admin SIPKS
                    </div>
                    <div class="text-[11px] text-slate-500">
                        SKLIPCI – Sistem Informasi PKL & Skripsi
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: info user / logout (optional) -->
        <div class="flex items-center gap-3">
            <?php $nama = $_SESSION['user']['nama'] ?? 'Admin'; ?>
            <div class="hidden md:flex flex-col items-end">
                <span class="text-xs font-medium text-slate-800">
                    <?= htmlspecialchars($nama); ?>
                </span>
                <span class="text-[11px] text-slate-500">
                    Administrator
                </span>
            </div>
            <div
                class="h-8 w-8 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center text-xs font-semibold">
                <?= htmlspecialchars(strtoupper(mb_substr($nama, 0, 1))); ?>
            </div>
        </div>
    </div>

    <!-- Overlay untuk mobile sidebar -->
    <div
        id="admin-sidebar-overlay"
        class="fixed inset-0 bg-black/30 z-30 hidden md:hidden">
    </div>
</header>

