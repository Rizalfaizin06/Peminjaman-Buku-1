<table class="table">
    <thead class="table-dark">
        <tr>
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $namaBuku = query("SELECT RFIDB, mapel.idBuku, namaBuku, COUNT(case when status = 1 then RFIDB end) stock FROM mapel, buku WHERE buku.idBuku = mapel.idBuku GROUP BY idBuku");
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
            <td>
                <a href="ubahMapel.php?idbuku=<?= $oneView["idBuku"]; ?>"
                    class="btn btn-success">ubah</a>
                <a href="hapusMapel.php?idbuku=<?= $oneView["idBuku"]; ?>"
                    class="btn btn-danger" onclick="return confirm('yakin?');">hapus</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>




<table class="table">
    <thead class="table-dark">
        <tr>
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
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
            <td>
                <a href="ubahMapel.php?idbuku=<?= $oneView["idBuku"]; ?>"
                    class="btn btn-success">ubah</a>
                <a href="hapusMapel.php?idbuku=<?= $oneView["idBuku"]; ?>"
                    class="btn btn-danger" onclick="return confirm('yakin?');">hapus</a>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>

<div class="container" style="min-height: 405px;">
    <div class="header">
        <h1>WIRAPUSTAKA</h1>
        <h3>SMKN 1 WIROSARI</h3>
    </div>
    <div class="sidebar">
        <div class="informasi">
            <h3>INFORMASI</h1>
        </div>
        <div class="warning">
            <table>
                <tr>
                    <th>Warning</th>
                </tr>
                <?php

                $warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' "); ?>


                <?php foreach ($warning as $oneView) : ?>
                <tr>
                    <td>
                        <marquee direction="left"><?php printf("Warning!! Atas Nama %s dari kelas %s untuk segera mengembalikan buku %s.", $oneView["namaAnggota"], $oneView["kelas"], $oneView["namaBuku"]); ?>
                        </marquee>
                    </td>

                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="pengunjung">
            <table>
                <tr>
                    <th>Pengunjung</th>
                </tr>
                <?php

                $jumlahPengunjung = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal'")[0]["COUNT(*)"];
        $jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"]; ?>
                <td><?= "Jumlah pengunjung hari ini adalah : ",$jumlahPengunjung; ?>
                </td>
                <td><?= "Jumlah pengunjung waspada adalah : ",$jumlahPengunjungWaspada; ?>
                </td>
            </table>
        </div>


    </div>
    <div>
        <table class="table">
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
    </div>
    <div>
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
    </div>
</div>