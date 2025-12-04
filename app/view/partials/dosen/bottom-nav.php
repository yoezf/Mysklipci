<div class="md:hidden fixed inset-x-0 bottom-0 bg-white border-t shadow-inner z-20">
    <nav class="flex justify-between text-xs">
        <a href="<?= BASE_URL; ?>/?r=dosen/dashboard"
           class="flex-1 text-center py-2">
            <div>🏠</div>
            <div class="mt-1 <?= (($_GET['r'] ?? '') === 'dosen/dashboard') ? 'text-pink-600 font-semibold' : 'text-slate-500' ?>">
                Beranda
            </div>
        </a>
        <a href="#"
           class="flex-1 text-center py-2 text-slate-500">
            <div>👨‍🎓</div>
            <div class="mt-1">Bimbingan</div>
        </a>
        <a href="#"
           class="flex-1 text-center py-2 text-slate-500">
            <div>🗓️</div>
            <div class="mt-1">Jadwal</div>
        </a>
        <a href="#"
           class="flex-1 text-center py-2 text-slate-500">
            <div>👤</div>
            <div class="mt-1">Profil</div>
        </a>
    </nav>
</div>
