<?php
if (!isset($title)) {
    $title = 'SIPKS - Sistem Informasi Pengelolaan PKL & Skripsi';
}

$user         = $_SESSION['user'] ?? null;
$currentRoute = $_GET['r'] ?? 'public/home';

function is_active_nav(string $pattern, string $currentRoute): string
{
    return strpos($currentRoute, $pattern) === 0 ? 'text-pink-800 font-semibold' : 'text-slate-500';
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
</head>

<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex flex-col">

        <!-- Top bar -->
        <header class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-30">
            <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">

                <!-- Logo + nama sistem -->
                <div class="flex items-center gap-3">
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-800">
                            SIPKS <span class="text-pink-800">– SKLIPCI</span>
                        </div>
                        <div class="text-[11px] text-slate-500">
                            Sistem Informasi Pengelolaan PKL &amp; Skripsi
                        </div>
                    </div>
                </div>

                <!-- User info / tombol login -->
                <div class="flex items-center gap-3">
                    <a href="<?= BASE_URL; ?>?r=auth/loginForm"
                        class="flex items-center gap-2 text-xs px-4 py-2 rounded-full bg-pink-600 text-white font-semibold hover:bg-pink-800 shadow-sm transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l4.5 4.5M12 9l4.5-4.5M16.5 13.5H9" />
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </header>

        <main class="flex-1 bg-slate-100 min-h-screen">

            <!-- HERO SECTION -->
            <section class="w-full">
                <div class="relative w-full">

                    <div class="h-64 md:h-80 w-full bg-gradient-to-br from-pink-200 via-white to-pink-100 opacity-70"></div>

                    <!-- Overlay Content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">

                        <div class="mb-4">
                            <div class="w-20 md:w-28 mx-auto p-3 bg-white/70 rounded-xl shadow">
                                <img src="<?= BASE_URL; ?>/public/assets/img/logo.png"
                                    alt="Logo Kampus"
                                    class="w-full h-full object-contain">
                            </div>
                        </div>

                        <h1 class="text-xl md:text-3xl font-bold text-slate-800 drop-shadow-sm mb-2 flex items-center gap-2">
                            Selamat Datang di <span class="text-pink-800">SIPKS</span>
                        </h1>

                        <p class="max-w-xl text-xs md:text-sm text-slate-700 leading-relaxed">
                            Sistem terintegrasi untuk pengelolaan PKL dan Skripsi mahasiswa, dilengkapi fitur
                            bimbingan online, pengajuan, hingga cetak surat otomatis secara mudah dan cepat.
                        </p>

                    </div>
                </div>
            </section>

            <!-- FILTER + JADWAL -->
            <section class="max-w-6xl mx-auto px-4 pb-12 -mt-10 relative z-10">

                <!-- Filter Program Studi -->
                <div class="bg-white shadow-lg rounded-2xl px-4 py-3 mb-6 flex flex-col md:flex-row md:items-center md:justify-between">

                    <span class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2 md:mb-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 4.5h18M4.5 9h15M6 13.5h12M9 18h6" />
                        </svg>
                        Filter Program Studi
                    </span>

                    <form method="get" class="w-full md:w-64">
                        <input type="hidden" name="r" value="public/home">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-4 w-4 text-pink-600"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.5 6h15M6 12h12M9 18h6" />
                            </svg>

                            <select name="prodi_id"
                                class="w-full border border-pink-300 text-sm rounded-full px-8 py-2 focus:outline-none focus:ring focus:ring-pink-400">
                                <option value="">Semua Prodi</option>
                                <?php foreach ($prodiList ?? [] as $prodi): ?>
                                    <option value="<?= (int)$prodi['id']; ?>"
                                        <?= (isset($selectedProdi) && (int)$selectedProdi === (int)$prodi['id']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($prodi['nama_prodi']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>

                <!-- JADWAL SEMINAR -->
                <section class="bg-white shadow-md rounded-2xl mb-6 overflow-hidden">
                    <div class="px-4 py-3 bg-pink-600 text-white text-sm font-semibold text-center uppercase flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Jadwal Seminar
                    </div>
                                        <div class="overflow-x-auto animate-fadeIn">
                        <table class="min-w-full text-xs md:text-sm">
                            <thead class="bg-pink-600 text-white">
                                <tr>
                                    <th class="px-3 py-2 text-left">#</th>
                                    <th class="px-3 py-2 text-left">Nama</th>
                                    <th class="px-3 py-2 text-left">NIM</th>
                                    <th class="px-3 py-2 text-left hidden md:table-cell">Prodi</th>
                                    <th class="px-3 py-2 text-left">Judul Skripsi</th>
                                    <th class="px-3 py-2 text-left">Penguji</th>
                                    <th class="px-3 py-2 text-left">Tanggal</th>
                                    <th class="px-3 py-2 text-left">Waktu</th>
                                    <th class="px-3 py-2 text-left hidden md:table-cell">Ruang</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-pink-100">
                                <?php if (empty($jadwalSeminar)): ?>
                                    <tr>
                                        <td colspan="9" class="px-3 py-4 text-center text-slate-500">
                                            Belum ada jadwal seminar yang dikonfirmasi.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($jadwalSeminar as $i => $row): ?>
                                        <?php
                                        $pengujiList = [];

                                        if (!empty($row['nama_pembimbing'])) {
                                            $pengujiList[] = $row['nama_pembimbing'].' (Pembimbing)';
                                        }
                                        if (!empty($row['nama_penguji1'])) {
                                            $pengujiList[] = $row['nama_penguji1'];
                                        }
                                        if (!empty($row['nama_penguji2'])) {
                                            $pengujiList[] = $row['nama_penguji2'];
                                        }

                                        $pengujiText = implode(', ', $pengujiList);
                                        ?>

                                        <tr class="hover:bg-pink-50 transition">
                                            <td class="px-3 py-2"><?= $i+1; ?>.</td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['nama_mhs']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['nim']); ?></td>
                                            <td class="px-3 py-2 hidden md:table-cell"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['judul']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($pengujiText); ?></td>
                                            <td class="px-3 py-2">
                                                <?= date('d M Y', strtotime($row['tanggal'])); ?>
                                            </td>
                                            <td class="px-3 py-2">
                                                <?= substr($row['jam_mulai'],0,5); ?>
                                                <?php if (!empty($row['jam_selesai'])): ?>
                                                    - <?= substr($row['jam_selesai'],0,5); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-3 py-2 hidden md:table-cell"><?= htmlspecialchars($row['ruangan'] ?: '-'); ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- JADWAL SIDANG -->
                <section class="bg-white shadow-md rounded-2xl overflow-hidden animate-slideUp">
                    <div class="px-4 py-3 bg-pink-600 text-white text-sm font-semibold text-center uppercase flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v6l4 2m6-2A10 10 0 112 12a10 10 0 0120 0z"/>
                        </svg>
                        Jadwal Sidang
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-xs md:text-sm">
                            <thead class="bg-pink-600 text-white">
                                <tr>
                                    <th class="px-3 py-2 text-left">#</th>
                                    <th class="px-3 py-2 text-left">Nama</th>
                                    <th class="px-3 py-2 text-left">NIM</th>
                                    <th class="px-3 py-2 text-left hidden md:table-cell">Prodi</th>
                                    <th class="px-3 py-2 text-left">Judul Skripsi</th>
                                    <th class="px-3 py-2 text-left">Penguji</th>
                                    <th class="px-3 py-2 text-left">Tanggal</th>
                                    <th class="px-3 py-2 text-left">Waktu</th>
                                    <th class="px-3 py-2 text-left hidden md:table-cell">Ruang</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-pink-100">
                                <?php if (empty($jadwalSidang)): ?>
                                    <tr>
                                        <td colspan="9" class="px-3 py-4 text-center text-slate-500">
                                            Belum ada jadwal sidang yang dikonfirmasi.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($jadwalSidang as $i => $row): ?>
                                        <?php
                                        $pengujiList = [];

                                        if (!empty($row['nama_pembimbing'])) {
                                            $pengujiList[] = $row['nama_pembimbing'].' (Pembimbing)';
                                        }
                                        if (!empty($row['nama_penguji1'])) {
                                            $pengujiList[] = $row['nama_penguji1'];
                                        }
                                        if (!empty($row['nama_penguji2'])) {
                                            $pengujiList[] = $row['nama_penguji2'];
                                        }

                                        $pengujiText = implode(', ', $pengujiList);
                                        ?>

                                        <tr class="hover:bg-pink-50 transition">
                                            <td class="px-3 py-2"><?= $i+1; ?>.</td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['nama_mhs']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['nim']); ?></td>
                                            <td class="px-3 py-2 hidden md:table-cell"><?= htmlspecialchars($row['nama_prodi']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($row['judul']); ?></td>
                                            <td class="px-3 py-2"><?= htmlspecialchars($pengujiText); ?></td>
                                            <td class="px-3 py-2">
                                                <?= date('d M Y', strtotime($row['tanggal'])); ?>
                                            </td>
                                            <td class="px-3 py-2">
                                                <?= substr($row['jam_mulai'],0,5); ?>
                                                <?php if (!empty($row['jam_selesai'])): ?>
                                                    - <?= substr($row['jam_selesai'],0,5); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-3 py-2 hidden md:table-cell"><?= htmlspecialchars($row['ruangan'] ?: '-'); ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </section>
        </main>

        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </div>
