<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Surat Penetapan Pembimbing'); ?></title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #111827;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .kop h1 {
            font-size: 14px;
            margin: 0;
            text-transform: uppercase;
        }

        .kop p {
            margin: 2px 0;
            font-size: 10px;
        }

        .judul-surat {
            text-align: center;
            margin: 14px 0;
        }

        .judul-surat h2 {
            font-size: 12px;
            text-decoration: underline;
            margin: 0;
        }

        .judul-surat p {
            margin: 2px 0;
            font-size: 11px;
        }

        .content {
            font-size: 11px;
        }

        .content p {
            margin: 4px 0;
        }

        .table-data {
            width: 100%;
            margin-top: 6px;
            margin-bottom: 8px;
        }

        .table-data td {
            padding: 2px 4px;
        }

        .signature {
            width: 100%;
            margin-top: 32px;
        }

        .signature td {
            vertical-align: top;
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="kop">
        <h1>FAKULTAS SAINS DAN TEKNOLOGI</h1>
        <p>UNIVERSITAS WANITA INTERNASIONAL</p>
        <p>Alamat kampus, Telp, Website (sesuaikan)</p>
    </div>

    <div class="judul-surat">
        <h2>SURAT PENETAPAN DOSEN PEMBIMBING SKRIPSI</h2>
        <p>Nomor: .............../FST-UWI/<?= date('Y'); ?></p>
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini, Dekan Fakultas Sains dan Teknologi Universitas Wanita Internasional,</p>

        <p>Menetapkan dosen pembimbing skripsi bagi mahasiswa:</p>

        <table class="table-data">
            <tr>
                <td style="width:22%;">Nama</td>
                <td style="width:2%;">:</td>
                <td><?= htmlspecialchars($pengajuan['nama_mhs'] ?? ''); ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?= htmlspecialchars($pengajuan['nim'] ?? ''); ?></td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td><?= htmlspecialchars($pengajuan['nama_prodi'] ?? ''); ?></td>
            </tr>
            <tr>
                <td>Judul Skripsi</td>
                <td>:</td>
                <td><?= htmlspecialchars($pengajuan['judul'] ?? ''); ?></td>
            </tr>
        </table>

        <p>dengan dosen pembimbing:</p>

        <table class="table-data">
            <tr>
                <td style="width:22%;">Nama Dosen</td>
                <td style="width:2%;">:</td>
                <td><?= htmlspecialchars($pengajuan['nama_pembimbing'] ?? ''); ?></td>
            </tr>
            <tr>
                <td>NIP / NIDN</td>
                <td>:</td>
                <td>.......................................</td>
            </tr>
        </table>

        <p>
            Demikian surat penetapan ini dibuat untuk digunakan sebagaimana mestinya.
        </p>
    </div>

    <table class="signature">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%;">
                <p>.................., <?= date('d-m-Y'); ?></p>
                <p>Dekan Fakultas Sains dan Teknologi</p>
                <br><br><br>
                <p><u>Nama Dekan</u></p>
                <p>NIP. ..........................</p>
            </td>
        </tr>
    </table>

</body>

</html>