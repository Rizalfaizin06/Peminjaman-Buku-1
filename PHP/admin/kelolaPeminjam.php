<?php include "template/header.php"; ?>


<div class="container">
    <table class="table">
        <tr class="table-dark">
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Stock</th>
            <th>Status</th>
        </tr>
        <?php
            $namaBuku = query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP");
$i = 1;
foreach ($namaBuku as $oneView) : ?>
        <tr>
            <td><?= $i; ?>
            </td>
            <td><?= $oneView["namaAnggota"]; ?>
            </td>
            <td><?= $oneView["namaBuku"]; ?>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</div>






















<?php include "template/footer.php";
