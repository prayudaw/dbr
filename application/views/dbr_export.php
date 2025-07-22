<?php
// This view directly outputs HTML that Excel will interpret.
// No <html>, <head>, <body> tags are needed here.
// No external CSS/JS should be linked.

// Based on the provided Excel template image, let's try to mimic some header details.
$nama_kantor = "UIN SUNAN KALIJAGA YOGYAKARTA";
$nama_ruangan = $nama_ruangan;
$kode_uakpb = "025.04.0040.423755.010";
$kode_ruangan = "202";
$tanggal_export = "Yogyakarta, " . date('d F Y');
?>

<table border="0" style="width:50%;">
    <tr>
        <td colspan="9" style="text-align:center; font-weight:bold; font-size:16pt;">KEMENTERIAN AGAMA</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:center; font-weight:bold; font-size:16pt;">DITJEN PENDIDIKAN ISLAM</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:center; font-weight:bold; font-size:16pt;">KANWIL KEMENTERIAN AGAMA D.I. YOGYAKARTA</td>
    </tr>
    <tr>
        <td colspan="9" style="text-align:center; font-weight:bold; font-size:18pt; padding-top:20px; padding-bottom:20px;">DAFTAR BARANG RUANGAN</td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight:bold;">NAMA</td>
        <td colspan="3" style="font-weight:bold;">: <?php echo $nama_kantor; ?></td>
        <td colspan="2" style="font-weight:bold;">NAMA RUANGAN</td>
        <td colspan="2" style="font-weight:bold;">: <?php echo $nama_ruangan; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="font-weight:bold;">KODE UAKPB</td>
        <td colspan="3" style="font-weight:bold;">: <?php echo $kode_uakpb; ?></td>
        <td colspan="2" style="font-weight:bold;">KODE RUANGAN</td>
        <td colspan="2" style="font-weight:bold;">: <?php echo $kode_ruangan; ?></td>
    </tr>
</table>
<br />
<br />
<table border="1" style="width:50%; border-collapse: collapse; margin-top:20px;">
    <thead>
        <tr>
            <th rowspan="2" style="text-align:center; vertical-align:middle;">No</th>
            <th rowspan="2" style="text-align:center; vertical-align:middle;">No Urut Pendaftaran</th>
            <th rowspan="2" style="text-align:center; vertical-align:middle;">Nama Barang</th>
            <th colspan="3" style="text-align:center;">Identitas Barang</th>
            <th colspan="3" style="text-align:center;">Keterangan</th>
        </tr>
        <tr>
            <th style="text-align:center;">Merk/Type</th>
            <th style="text-align:center;">Kd Barang</th>
            <th style="text-align:center;">Th. Prlh</th>
            <th style="text-align:center;">Jumlah Barang</th>
            <th style="text-align:center;">Penguasaan</th>
            <th style="text-align:center;">Kondisi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($barang)): ?>
            <?php $no = 1;
            foreach ($barang as $item): ?>
                <tr>
                    <td style="text-align:center;width:30px"><?php echo $no++; ?></td>
                    <td style="text-align:center;width:30px"><?php echo $item->nup; ?></td>
                    <td style="text-align:center;width:100px"><?php echo $item->nama_barang; ?></td>
                    <td><?php echo $item->merk_type; ?></td> <?php // Merk/Type, assumed blank for now 
                                                                ?>
                    <td><?php echo $item->kode_barang; ?></td> <?php // Kd Barang, assumed blank for now 
                                                                ?>
                    <td> <?php echo $item->tahun; ?>
                    </td> <?php // Th. Prlh, assumed blank for now 
                            ?>
                    <td style=" text-align:center;"><?php echo $item->jumlah_barang; ?></td>
                    <td><?php echo $item->penguasaan; ?></td> <?php // Penguasaan, assumed blank for now 
                                                                ?>
                    <td><?php echo $item->kondisi; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" style="text-align:center;">Tidak ada data barang untuk diekspor.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<br />
<br />
<table border="0" style="width:100%; margin-top:30px;">
    <tr>
        <td colspan="6"></td>
        <td colspan="3" style="text-align:center;"><?php echo $tanggal_export; ?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center; font-weight:bold;">Penanggung Jawab UAKPB</td>
        <td colspan="3"></td>
        <td colspan="3" style="text-align:center; font-weight:bold;">Penanggung Jawab Ruangan</td>
    </tr>
    <tr>
        <td colspan="9" style="height:60px;"></td> <?php // Spacer for signatures 
                                                    ?>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center; font-weight:bold;">Hasan Latif, S.IP</td>
        <td colspan="3"></td>
        <td colspan="3" style="text-align:center; font-weight:bold;">Dra. Khusnul Khotimah, SS, MIP.</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;">NIP. 19830222 000000 1 101</td>
        <td colspan="3"></td>
        <td colspan="3" style="text-align:center;">NIP. 19680905 199803 2 002</td>
    </tr>
</table>