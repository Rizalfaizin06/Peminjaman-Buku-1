<?php include "template/header.php"; ?>



<div class="container" style="min-height: 405px;">
    <h1>Kelola Anggota</h1>

    <div class="row">
        <div class="col-7"><a class="btn btn-primary my-2" href="tambahAnggota.php">Tambah Anggota</a></div>
    </div>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>RFIDP</th>
                <th>Nama Anggota</th>
                <th>Kelas</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $namaBuku = query("SELECT RFIDP, namaAnggota, kelas, email FROM anggota");
        $i = 1;
        foreach ($namaBuku as $oneView) : ?>
            <tr>
                <td><?= $i; ?>
                </td>
                <td><?= $oneView["RFIDP"]; ?>
                </td>
                <td><?= $oneView["namaAnggota"]; ?>
                </td>
                <td><?= $oneView["kelas"]; ?>
                </td>
                <td><?= $oneView["email"]; ?>
                </td>
                <td>
                    <a href="ubahAnggota.php?rfidp=<?= $oneView["RFIDP"]; ?>"
                        class="btn btn-success">ubah</a>
                    <a href="hapusAnggota.php?rfidp=<?= $oneView["RFIDP"]; ?>"
                        class="btn btn-danger" onclick="return confirm('yakin?');">hapus</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>

</div>

<?php include "template/footer.php";
