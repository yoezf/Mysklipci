<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title); ?></title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
        }
        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .kop h1 {
            margin: 0;
            font-size: 15px;
            text-transform: uppercase;
        }
        .kop p {
            margin: 2px 0;
            font-size: 10px;
        }
        .judul {
            text-align: center;
            margin: 18px 0;
        }
        .judul h2 {
            margin: 0;
            font-size: 13px;
            text-decoration: underline;
        }
        .isi p {
            margin: 6px 0;
        }
        .tabel-info td {
            padding: 2px 4px;
        }
        .ttd {
            width: 100%;
            margin-top: 40px;
        }
        .ttd td {
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>
<body>

<div class="kop">
    <h1>FAKULTAS SAINS DAN TEKNOLOGI</h1>
    <p>UNIVERSITAS WANITA INTERNASIONAL</p>
    <p>Alamat Kampus – Telp – Website</p>
</div>

<div class="judul">
    <h2>SURAT IZIN PRAKTIK KERJA LAPANGAN (PKL)</h2>
    <p>Nomor: ....../FST-UWI/<?= date('Y'); ?></p>
</div>

<div class="isi">
    <p>Kepada Yth,</p>
    <p><strong>Pimpinan Instansi / Perusahaan</strong></p>
    <p>Di Tempat</p>

    <p>Dengan hormat,</p>

    <p>Sehubungan dengan pelaksanaan kegiatan Praktik Kerja Lapangan (PKL) mahasiswa
    Fakultas Sains dan Teknologi Universitas Wanita Internasional, bersama ini kami memberikan izin kepada:</p>

    <table class="tabel-info">
        <tr>
            <td style="width: 120px;">Nama</td>
            <td>:</td>
            <td><?= htmlspecialchars($pengajuan['nama_mhs']); ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td><?= htmlspecialchars($pengajuan['nim']); ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>:</td>
            <td><?= htmlspecialchars($pengajuan['nama_prodi']); ?></td>
        </tr>
        <tr>
            <td>Judul PKL</td>
            <td>:</td>
            <td><?= htmlspecialchars($pengajuan['judul']); ?></td>
        </tr>
        <tr>
            <td>Instansi Tujuan</td>
            <td>:</td>
            <td><?= htmlspecialchars($pengajuan['deskripsi']); ?></td>
        </tr>
    </table>

    <p>
        Mahasiswa tersebut diberikan izin untuk melaksanakan kegiatan PKL pada instansi/perusahaan yang Bapak/Ibu pimpin. 
        Kami mengharapkan bantuan serta kerja sama dari pihak instansi untuk memberikan kesempatan kepada mahasiswa kami 
        dalam melaksanakan kegiatan PKL sesuai dengan ketentuan.
    </p>

    <p>Demikian surat izin ini dibuat untuk digunakan sebagaimana mestinya.</p>
</div>

<table class="ttd">
    <tr>
        <td style="width: 60%;"></td>
        <td>
            <p><?= date('d F Y'); ?></p>
            <p>Dekan Fakultas Sains dan Teknologi</p>
            <br><br><br>
            <p><u>Nama Dekan</u></p>
            <p>NIP. ...........................</p>
        </td>
    </tr>
</table>

</body>
</html>
