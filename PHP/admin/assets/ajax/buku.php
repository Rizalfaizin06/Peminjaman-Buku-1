<table class="table table-buku">
    <tr class="table-dark">
        <th>No.</th>
        <th>Nama Buku</th>
        <th>Stock</th>
        <th>Status</th>
    </tr>
    <?php
    include "../../fungsiAdmin.php";
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