<?php

include "../template/header.php";
include "../fungsiAdmin.php";

?>



<div class="container" style="min-height: 600px;">
    <h1>Kelola Buku</h1>

    <div class="row">
        <div class="col-7"><a class="btn btn-primary my-2" href="tambahBuku.php">Tambah Buku</a></div>
    </div>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>RFID</th>
                <th>ID</th>
                <th>Nama Buku</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $namaBuku = query("SELECT RFIDB, mapel.idBuku, namaBuku, status FROM mapel RIGHT JOIN buku ON buku.idBuku = mapel.idBuku ORDER BY idBuku, status DESC, RFIDB");
        $i = 1;
        foreach ($namaBuku as $oneView) : ?>
            <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $oneView["RFIDB"]; ?>
                </td>
                <td><?= $oneView["idBuku"]; ?>
                </td>
                <td><?= $oneView["namaBuku"]; ?>
                </td>
                <?php
                if ($oneView["status"] == 1) {
                    $stat = 'Tersedia';
                } else {
                    $stat = 'Dipinjam';
                }?>
                <td><?= $stat; ?>
                </td>
                <td>
                    <a href="ubahBuku.php?rfidb=<?= $oneView["RFIDB"]; ?>"
                        class="btn btn-success">ubah</a>
                    <a href="hapusBuku.php?rfidb=<?= $oneView["RFIDB"]; ?>"
                        class="btn btn-danger" onclick="return confirm('yakin?');">hapus</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>

</div>

<?php include "../template/footer.php";
