<!DOCTYPE html>
<html>

<head>
    <title>Daftar Barang Ruangan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            /* Menggunakan Times New Roman */
            font-size: 12px;
            /* Ukuran font lebih kecil */
            margin: 0 30px;
            /* Margin kiri dan kanan untuk space */
            padding: 0;
        }

        .header-top {
            text-align: left;
            margin-bottom: 5px;
            line-height: 1.2;
            font-size: 12px;
            /* Sedikit lebih besar dari body */
        }

        .header-main {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 25px;
            /* Garis bawah judul */
            padding-bottom: 5px;
        }

        .info-section {
            height: 30px;
            /* overflow: hidden; */
            margin-bottom: 15px;
            font-size: 12px;
        }

        .info-left,
        .info-right {
            float: left;
            width: 40%;
            /* Sesuaikan lebar */
            box-sizing: border-box;
        }

        .info-right {
            float: right;
        }

        .info-item {
            margin-bottom: 3px;
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            /* Padding lebih kecil */
            text-align: left;
            vertical-align: middle;
            /* Middle align for content */
            height: 15px;
            /* Fixed height for rows if needed for visual consistency */
        }

        th {
            background-color: #f2f2f2;
            /* Light grey background for headers */
            font-weight: bold;
            text-align: center;
            font-size: 12px;
            /* Ukuran font header tabel lebih kecil */
            vertical-align: bottom;
            /* Agar teks di header multi-baris sejajar bawah */
        }

        td.no {
            text-align: center;
            width: 20px;
            /* Lebar kolom No */
        }

        td.jumlah {
            text-align: center;
            width: 50px;
            /* Lebar kolom Jumlah */
        }

        td.keterangan {
            width: 80px;
            /* Lebar kolom Keterangan */
        }

        td.nama_barang {
            width: 150px;
            /* Lebar kolom Nama Barang */
        }

        td.merk_type,
        td.kd_barang,
        td.th_prlh {
            width: 70px;
            /* Lebar kolom identitas barang */
        }

        td.penguasaan {
            width: 70px;
            /* Lebar kolom penguasaan */
        }

        /* Numbering on header for table */
        .header-num {
            position: relative;
        }

        .header-num span {
            position: absolute;
            bottom: 2px;
            right: 2px;
            font-size: 12px;
            /* Ukuran nomor kecil */
            font-weight: normal;
        }

        .keterangan-bawah {
            margin-top: 20px;
            font-size: 12px;
        }

        .signature-section {
            margin-top: 50px;
            /* overflow: hidden; */
            font-size: 12px;
        }

        .signature-left,
        .signature-right {
            float: left;
            width: 49%;
            box-sizing: border-box;
        }

        .signature-right {
            float: right;
            text-align: right;
        }

        .signature-name {
            margin-top: 50px;
            /* Jarak untuk tanda tangan */
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header-top">
        <p>KEMENTERIAN AGAMA</p>
        <p>DITJEN PENDIDIKAN ISLAM</p>
        <p>KANWIL KEMENTERIAN AGAMA D.I. YOGYAKARTA</p>
    </div>

    <div class="header-main">
        <p>DAFTAR BARANG RUANGAN</p>
    </div>


    <div class="info-section">
        <div class="info-left">
            <div class="info-item">NAMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: UIN SUNAN KALIJAGA YOGYAKARTA</div>
            <div class="info-item">KODE UAKPB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 025.04.0400.423755.010</div>
        </div>
        <div class="info-right">
            <div class="info-item">NAMA RUANGAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nama_ruangan ?></div>
            <div class="info-item">KODE RUANGAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kode_ruangan ?></div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="header-num" rowspan="2">No</th>
                <th class="header-num" rowspan="2">No Urut Pendaftaran</th>
                <th class="header-num" rowspan="2">Nama Barang</th>
                <th colspan="3">Identitas Barang</th>
                <th class="header-num" rowspan="2">Jumlah Barang</th>
                <th class="header-num" rowspan="2">Penguasaan</th>
                <th class="header-num" rowspan="2">Keterangan</th>
            </tr>
            <tr style="border-right: 1px solid #000;">
                <th class="header-num">Merk/Type</th>
                <th class="header-num">Kd Barang</th>
                <th class="header-num">Th. Prlh</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($barang)): ?>
                <?php $no = 1; ?>
                <?php foreach ($barang as $item): ?>
                    <tr>
                        <td class="no"><?php echo $no++; ?></td>
                        <td><?php echo $item->nup; ?></td>
                        <td><?php echo $item->nama_barang; ?></td>
                        <td><?php echo $item->merk_type; ?></td>
                        <td><?php echo $item->kode_barang; ?></td>
                        <td><?php echo $item->tahun; ?></td>
                        <td class="jumlah"><?php echo $item->jumlah_barang; ?></td>
                        <td><?php echo $item->penguasaan; ?></td>
                        <td class="keterangan"><?php echo $item->kondisi; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php
            // Tambahkan baris kosong hingga minimal 11 baris total
            $current_rows = count($barang);
            $target_rows = 11;
            if ($current_rows < $target_rows) {
                for ($i = $current_rows + 1; $i <= $target_rows; $i++) { ?>
                    <tr>
                        <td class="no"><?php echo $i; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>

    <div class="keterangan-bawah">
        <p>Tidak dibenarkan memindahkan barang-barang yang ada pada daftar ini tanpa sepengetahuan penanggung jawab Unit Akuntasi Kuasa</p>
    </div>

    <div class="signature-section">
        <div class="signature-right">
            <div class="signature-item">Yogyakarta, 31 Maret 2023</div>
            <div class="signature-item">Penanggung Jawab Ruangan</div>
            <div class="signature-name">Dra. Khusnul Khotimah, SS, MIP.</div>
            <div class="signature-item">NIP. 19680905 199803 2 002</div>
        </div>
        <div class="signature-left" style="margin-top: 20px;">
            <div class="signature-item">Penanggung Jawab UAKPB</div>
            <div class="signature-name">Prayuda Wirawan</div>
            <div class="signature-item"></div>
        </div>
    </div>

</body>

</html>