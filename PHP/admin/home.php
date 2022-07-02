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