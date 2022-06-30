<table class="table">
    <thead class="table-dark">
        <tr>
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Stock</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $namaBuku = query("SELECT * FROM mapel");
        $i = 1;
        foreach ($namaBuku as $oneView) : ?>
        <tr>
            <td><?= $i; ?>
            </td>
            <td><?= $oneView["namaBuku"]; ?>
            </td>

            <?php
                $mapel = $oneView["idBuku"];
                $stock = query("SELECT COUNT(*) FROM buku WHERE idBuku = '$mapel' AND status = '1'")[0]["COUNT(*)"];
                ?>

            <td><?= $stock ?>
            </td>

            <?php
                if ($stock > 0) {
                    $stat = 'Tersedia';
                } else {
                    $stat = 'Kosong';
                }?>
            <td><?= $stat; ?>
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
        </tr>
    </thead>
    <tbody>
        <?php

        $namaBuku = query("SELECT * FROM mapel");
        $i = 1;
        foreach ($namaBuku as $oneView) : ?>
        <tr>
            <td><?= $i; ?>
            </td>
            <td><?= $oneView["namaBuku"]; ?>
            </td>

            <?php
                $mapel = $oneView["idBuku"];
                $stock = query("SELECT COUNT(*) FROM buku WHERE idBuku = '$mapel' AND status = '1'")[0]["COUNT(*)"];
                ?>

            <td><?= $stock ?>
            </td>

            <?php
                if ($stock > 0) {
                    $stat = 'Tersedia';
                } else {
                    $stat = 'Kosong';
                }?>
            <td><?= $stat; ?>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>