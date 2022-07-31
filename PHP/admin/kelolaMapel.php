<?php include "template/header.php"; ?>



<div class="container" style="min-height: 65vh;">
    <h1>Kelola Mata Pelajaran</h1>

    <div class="row">
        <div class="col-7"><a class="btn btn-primary my-2" href="tambahMapel.php">Tambah Mata Pelajaran</a></div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>ID</th>
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
                    <td><?= $oneView["idBuku"]; ?>
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
    </div>
</div>

<?php include "template/footer.php";
