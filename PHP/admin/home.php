<div>
    <table class="table">
        <tr class="table-dark text-center">
            <th>Warning</th>
        </tr>
        <?php

                $warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' "); ?>


        <?php
        if (!empty($warning)) :
            foreach ($warning as $oneView) : ?>
        <tr>
            <td>
                <marquee direction="left"><?php printf("Warning!! Atas Nama %s dari kelas %s untuk segera mengembalikan buku %s.", $oneView["namaAnggota"], $oneView["kelas"], $oneView["namaBuku"]); ?>
                </marquee>
            </td>
        </tr>
        <?php endforeach;
        else : ?>
        <tr>
            <td class="text-center">
                Tidak ada warning
            </td>
        </tr>
        <?php endif;?>
    </table>
</div>
<div class="pengunjung">
    <table class="table">
        <tr class="table-dark text-center">
            <th>Pengunjung</th>
        </tr>
        <?php

                $jumlahPengunjung = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal'")[0]["COUNT(*)"];
        $jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"]; ?>
        <tr>
            <td><?= "Jumlah pengunjung hari ini adalah : ",$jumlahPengunjung; ?>
            </td>
        </tr>
        <tr>
            <td><?= "Jumlah pengunjung waspada adalah : ",$jumlahPengunjungWaspada; ?>
            </td>
        </tr>
    </table>
</div>


<table class="table table-buku">
    <tr class="table-dark">
        <th>No.</th>
        <th>Nama Buku</th>
        <th>Stock</th>
        <th>Status</th>
    </tr>
    <?php
                $namaBuku = query("SELECT RFIDB, mapel.idBuku, namaBuku, COUNT(case when status = 1 then RFIDB end) stock FROM mapel LEFT JOIN buku ON buku.idBuku = mapel.idBuku GROUP BY mapel.idBuku");
        $i = 1;
        foreach ($namaBuku as $oneView) : ?>
    <tr>
        <td><?= $i; ?>
        </td>
        <td><?= $oneView["namaBuku"]; ?>
        </td>
        <td><?= $oneView["stock"]; ?>
        </td>
        <?php
                if ($oneView["stock"] > 0) {
                    $stat = 'Tersedia';
                } else {
                    $stat = 'Kosong';
                }?>
        <td><?= $stat; ?>
        </td>

    </tr>
    <?php $i++; endforeach; ?>
</table>

<table class="table">

    <tr class="table-dark">
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Suhu</th>
    </tr>

    <?php


                    $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP ORDER BY id DESC LIMIT 5");

        foreach ($absen as $oneView) : ?>
    <tr class="trLower">
        <td><?= $oneView["namaAnggota"]; ?>
        </td>
        <td><?= $oneView["tanggal"]; ?>
        </td>
        <td><?= $oneView["jam"]; ?>
        </td>
        <td><?= $oneView["suhu"]; ?>
        </td>

    </tr>
    <?php endforeach; ?>
</table>