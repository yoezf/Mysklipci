<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Log Bimbingan'); ?></title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #111827;
        }
        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 16px;
        }
        .header h1 {
            font-size: 16px;
            text-transform: uppercase;
        }
        .info {
            margin-bottom: 12px;
            font-size: 11px;
        }
        .info-table {
            width: 100%;
        }
        .info-table td {
            padding: 2px 4px;
        }
        table.log {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }
        table.log th,
        table.log td {
            border: 1px solid #9ca3af;
            padding: 4px 6px;
        }
        table.log th {
            background-color: #f3f4f6;
            font-size: 10px;
            text-align: center;
        }
        table.log td {
            font-size: 10px;
            vertical-align: top;
        }
        .text-center {
            text-align: center;
        }
        .mt-24 {
            margin-top: 24px;
        }
        .signature {
            width: 100%;
            margin-top: 40px;
            font-size: 11px;
        }
        .signature td {
            vertical-align: top;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>LOG BIMBINGAN SKRIPSI</h1>
    <p style="margin-top:4px;">Sistem Informasi Pengelolaan PKL & Skripsi (SIPKS)</p>
</div>

<div class="info">
    <table class="info-table">
        <tr>
            <td style="width:20%;">Nama Mahasiswa</td>
            <td style="width:2%;">:</td>
            <td><?= htmlspecialchars($mhs['nama'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td><?= htmlspecialchars($mhs['nim'] ?? ''); ?></td>
        </tr>
        <?php if (!empty($mhs['nama_prodi'])): ?>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td><?= htmlspecialchars($mhs['nama_prodi']); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td>Pembimbing</td>
            <td>:</td>
            <td><?= htmlspecialchars($skripsiAktif['nama_pembimbing'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>Judul Skripsi</td>
            <td>:</td>
            <td><?= htmlspecialchars($skripsiAktif['judul'] ?? ''); ?></td>
        </tr>
    </table>
</div>

<table class="log">
    <thead>
    <tr>
        <th style="width:5%;">No</th>
        <th style="width:12%;">Tanggal</th>
        <th style="width:25%;">Topik / Materi</th>
        <th style="width:28%;">Catatan Mahasiswa</th>
        <th style="width:15%;">Status</th>
        <th style="width:15%;">Catatan Dosen</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($items)): ?>
        <tr>
            <td colspan="6" class="text-center">Belum ada data log bimbingan.</td>
        </tr>
    <?php else: ?>
        <?php $no = 1; ?>
        <?php foreach ($items as $row): ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['tanggal']); ?></td>
                <td><?= nl2br(htmlspecialchars($row['topik'])); ?></td>
                <td><?= nl2br(htmlspecialchars($row['catatan_mahasiswa'] ?? '-')); ?></td>
                <td class="text-center"><?= htmlspecialchars($row['status']); ?></td>
                <td><?= nl2br(htmlspecialchars($row['catatan_dosen'] ?? '-')); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<table class="signature mt-24">
    <tr>
        <td style="width:50%;">
            <p>Pembimbing,</p>
            <br><br><br>
            <p><u><?= htmlspecialchars($skripsiAktif['nama_pembimbing'] ?? ''); ?></u></p>
        </td>
        <td style="width:50%;">
            <p>Mahasiswa,</p>
            <br><br><br>
            <p><u><?= htmlspecialchars($mhs['nama'] ?? ''); ?></u></p>
            <p>NIM: <?= htmlspecialchars($mhs['nim'] ?? ''); ?></p>
        </td>
    </tr>
</table>

</body>
</html>
