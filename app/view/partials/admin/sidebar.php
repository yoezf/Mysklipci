<?php
$currentRoute = $_GET['r'] ?? '';

function activeSidebar(string $prefix, string $currentRoute): string
{
    return strpos($currentRoute, $prefix) === 0
        ? 'bg-pink-50 text-pink-600 border-l-4 border-pink-500'
        : 'text-slate-600 hover:bg-slate-50 border-l-4 border-transparent';
}
?>

<aside class="flex flex-col w-60 shrink-0 bg-white rounded-2xl shadow-sm p-3 h-fit sticky top-24">

    <!-- Header sidebar -->
    <div class="flex items-center gap-3 px-3 py-3 border-b border-slate-200 mb-3 
                hover:bg-slate-50 rounded-lg transition duration-200">

        <div class="w-12 h-12 rounded-xl bg-[#DB2777] flex items-center justify-center 
                    text-white shadow-lg transition-transform duration-300 hover:scale-110">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A8.966 8.966 0 0112 15c2.042 0 3.938.635 5.379 1.704M15 11a3 3 0 
                      11-6 0 3 3 0 016 0zM19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" />
            </svg>
        </div>

        <div class="leading-tight">
            <div class="flex items-center gap-1">
                <span class="text-sm font-semibold text-slate-800">Panel Admin</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5l7 7-7 7" />
                </svg>
            </div>
            <div class="text-xs text-slate-500">Kelola data & jadwal</div>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 flex flex-col gap-1 text-xs">

        <!-- Dashboard -->
        <a href="<?= BASE_URL; ?>/?r=admin/dashboard"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/dashboard', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 10.75L12 4l9 6.75" />
                <path d="M5 10.75V20h5v-4h4v4h5v-9.25" />
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Master Data -->
        <div class="mt-2 mb-1 px-3 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
            Master Data
        </div>

        <a href="<?= BASE_URL; ?>/?r=admin/mahasiswaIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/mahasiswa', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11a4 4 0 1 0-2-7.5 4 4 0 0 0 2 7.5z" />
                <path d="M17 13a4 4 0 1 0-2-7.5 4 4 0 0 0 2 7.5z" />
                <path d="M3 20a5 5 0 0 1 8-3.9" />
                <path d="M21 20a5 5 0 0 0-7-4.6" />
            </svg>
            <span>Data Mahasiswa</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/dosenIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/dosen', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-5 9 5-9 5-9-5z" />
                <path d="M7 12.5v4.5c2.5 2 7.5 2 10 0v-4.5" />
            </svg>
            <span>Data Dosen</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/prodiIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/prodi', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            <span>Data Prodi</span>
        </a>

        <!-- Pengajuan -->
        <div class="mt-3 mb-1 px-3 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
            Pengajuan
        </div>

        <a href="<?= BASE_URL; ?>/?r=admin/pengajuanPklIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/pengajuanPkl', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 3h6l1 2h3v16H5V5h3l1-2z" />
                <path d="M9 11h6" />
                <path d="M9 15h4" />
            </svg>
            <span>Pengajuan PKL</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/pengajuanSkripsiIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/pengajuanSkripsi', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 3h8l4 4v14H7z" />
                <path d="M9 12h6" />
                <path d="M9 16h4" />
            </svg>
            <span>Pengajuan Skripsi</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/pengajuanSeminarIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/pengajuanSeminar', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 5h8v8H9l-4 4v-4H5z" />
                <path d="M15 5h4v8h-2l-2 2" />
            </svg>
            <span>Pengajuan Seminar</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/pengajuanSidangIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/pengajuanSidang', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3v18" />
                <path d="M7 7l-4 7h8l-4-7z" />
                <path d="M21 7l-4 7h8l-4-7z" />
            </svg>
            <span>Pengajuan Sidang</span>
        </a>

        <!-- Jadwal & Laporan -->
        <div class="mt-3 mb-1 px-3 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
            Jadwal & Laporan
        </div>

        <a href="<?= BASE_URL; ?>/?r=admin/jadwalSeminarIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/jadwalSeminar', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="17" rx="2" />
                <path d="M3 10h18" />
                <path d="M8 2v4" />
                <path d="M16 2v4" />
            </svg>
            <span>Jadwal Seminar</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/jadwalSidangIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/jadwalSidang', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <rect x="4" y="5" width="16" height="15" rx="2" />
                <path d="M4 10h16" />
            </svg>
            <span>Jadwal Sidang</span>
        </a>

        <a href="<?= BASE_URL; ?>/?r=admin/laporanAkhirIndex"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/laporanAkhir', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 7h16l-1 13H5L4 7z" />
                <rect x="3" y="3" width="18" height="4" rx="1" />
                <path d="M10 12h4" />
            </svg>
            <span>Laporan Akhir</span>
        </a>

        <!-- Pengaturan -->
        <div class="mt-3 mb-1 px-3 text-[10px] font-semibold uppercase tracking-wide text-slate-400">
            Pengaturan
        </div>


        <a href="<?= BASE_URL; ?>/?r=admin/profilAdmin"
            class="flex items-center gap-2 px-3 py-2 rounded-xl <?= activeSidebar('admin/profilAdmin', $currentRoute); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.4 15a1.8 1.8 0 0 0 .3 2l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.8 1.8 
                             0 0 0-2-.3 1.8 1.8 0 0 0-1 1.6V22a2 2 0 0 1-4 0v-.1a1.8 1.8 
                             0 0 0-1-1.6 1.8 1.8 0 0 0-2 .3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.8 
                             1.8 0 0 0 .3-2 1.8 1.8 0 0 0-1.6-1H2a2 2 0 0 1 0-4h.1a1.8 
                             1.8 0 0 0 1.6-1 1.8 1.8 0 0 0-.3-2l-.1-.1a2 2 0 0 1 2.8-2.8l.1.1a1.8 
                             1.8 0 0 0 2 .3H9A1.8 1.8 0 0 0 10 3.1V3a2 2 0 0 1 4 0v.1a1.8 
                             1.8 0 0 0 1 1.6 1.8 1.8 0 0 0 2-.3l.1-.1a2 2 0 0 1 2.8 2.8l-.1.1a1.8 
                             1.8 0 0 0-.3 2 1.8 1.8 0 0 0 1.6 1H22a2 2 0 0 1 0 4h-.1a1.8 
                             1.8 0 0 0-1.6 1z" />
            </svg>
            <span>Profile Admin</span>
        </a>

    </nav>
</aside>