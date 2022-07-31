<?php
    require '../../fungsiAdmin.php';
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
<?php $i++; endforeach;
