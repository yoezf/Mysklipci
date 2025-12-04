<?php 
$current = $_GET['r'] ?? ''; 
?>

<!-- Bottom Nav Mahasiswa -->
<div class="fixed inset-x-0 bottom-0 bg-white border-t shadow-lg z-50">
    <nav class="flex justify-between text-[11px]">
        
        <!-- Dashboard -->
        <a href="<?= BASE_URL; ?>/?r=mahasiswa/dashboard"
           class="flex-1 text-center py-2 <?= $current === 'mahasiswa/dashboard' ? 'text-pink-600' : 'text-slate-500' ?>">
           
           <div class="flex flex-col items-center">
               <!-- Heroicon: Home -->
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5 <?= $current === 'mahasiswa/dashboard' ? 'stroke-pink-600' : 'stroke-slate-500' ?>" fill="none" viewBox="0 0 24 24" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
               </svg>
               <span class="<?= $current === 'mahasiswa/dashboard' ? 'font-semibold' : '' ?>">Beranda</span>
           </div>
        </a>

        <!-- Pengajuan -->
        <a href="<?= BASE_URL; ?>/?r=mahasiswa/pengajuanRiwayat"
           class="flex-1 text-center py-2 <?= $current === 'mahasiswa/pengajuanRiwayat' ? 'text-pink-600' : 'text-slate-500' ?>">

           <div class="flex flex-col items-center">
               <!-- Heroicon: Document -->
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5 <?= $current === 'mahasiswa/pengajuanRiwayat' ? 'stroke-pink-600' : 'stroke-slate-500' ?>" fill="none" viewBox="0 0 24 24" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v9h9M12 3H6a2 2 0 00-2 2v14c0 1.1.9 2 2 2h12a2 2 0 002-2V12l-8-9z" />
               </svg>
               <span class="<?= $current === 'mahasiswa/pengajuanRiwayat' ? 'font-semibold' : '' ?>">Pengajuan</span>
           </div>
        </a>

        <!-- Log -->
        <a href="<?= BASE_URL; ?>/?r=mahasiswa/logPklIndex"
           class="flex-1 text-center py-2 <?= ($current === 'mahasiswa/logPklIndex' || $current === 'mahasiswa/logBimbinganIndex') ? 'text-pink-600' : 'text-slate-500' ?>">

           <div class="flex flex-col items-center">
               <!-- Heroicon: Book Open -->
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5 <?= ($current === 'mahasiswa/logPklIndex' || $current === 'mahasiswa/logBimbinganIndex') ? 'stroke-pink-600' : 'stroke-slate-500' ?>" fill="none" viewBox="0 0 24 24" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 20V4m0 0C9.5 3.5 7.5 5 6 6 4.5 7 3 8.5 3 10v7c0 1 1 2 2 2 1.5 0 3-1 4-2s2-2.5 3-2.5m0-10C14.5 3.5 16.5 5 18 6c1.5 1 3 2.5 3 4v7c0 1-1 2-2 2-1.5 0-3-1-4-2s-2-2.5-3-2.5" />
               </svg>
               <span class="<?= ($current === 'mahasiswa/logPklIndex' || $current === 'mahasiswa/logBimbinganIndex') ? 'font-semibold' : '' ?>">Log</span>
           </div>
        </a>

        <!-- Jadwal -->
        <a href="<?= BASE_URL; ?>/?r=mahasiswa/jadwalIndex"
           class="flex-1 text-center py-2 <?= $current === 'mahasiswa/jadwalIndex' ? 'text-pink-600' : 'text-slate-500' ?>">

           <div class="flex flex-col items-center">
               <!-- Heroicon: Calendar -->
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5 <?= $current === 'mahasiswa/jadwalIndex' ? 'stroke-pink-600' : 'stroke-slate-500' ?>" fill="none" viewBox="0 0 24 24" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M6 2v4m12-4v4M3 10h18M3 10v10a2 2 0 002 2h14a2 2 0 002-2V10M3 10l.01-.011M21 10l-.01-.011" />
               </svg>
               <span class="<?= $current === 'mahasiswa/jadwalIndex' ? 'font-semibold' : '' ?>">Jadwal</span>
           </div>
        </a>

        <!-- Laporan -->
        <a href="<?= BASE_URL; ?>/?r=mahasiswa/laporanAkhirIndex"
           class="flex-1 text-center py-2 <?= $current === 'mahasiswa/laporanAkhirIndex' ? 'text-pink-600' : 'text-slate-500' ?>">

           <div class="flex flex-col items-center">
               <!-- Heroicon: Archive Box -->
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5 <?= $current === 'mahasiswa/laporanAkhirIndex' ? 'stroke-pink-600' : 'stroke-slate-500' ?>" fill="none" viewBox="0 0 24 24" stroke-width="2">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5l1.5-3h15L21 7.5M3 7.5h18m-18 0V19.5A2 2 0 005 21.5h14a2 2 0 002-2V7.5m-8 6v4m0 0-2-2m2 2l2-2" />
               </svg>
               <span class="<?= $current === 'mahasiswa/laporanAkhirIndex' ? 'font-semibold' : '' ?>">Laporan</span>
           </div>
        </a>

    </nav>
</div>
