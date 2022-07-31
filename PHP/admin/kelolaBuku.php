<?php include "template/header.php";
if (isset($_GET["halaman"])) {
    $_SESSION['sessionHalamanKelolaBuku'] = $_GET["halaman"];
}?>



<div class="container" style="min-height: 405px;">
    <h1>Kelola Buku</h1>

    <div class="row">
        <div class="col-7"><a class="btn btn-primary my-2" href="tambahBuku.php">Tambah Buku</a></div>
    </div>





    <div id="kelolaBuku" class="table-responsive">
        <table class="table">
            <?php
        $jumlahData = count(query("SELECT * FROM buku"));
$jumlahDataPerHalaman = 8;
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = (isset($_SESSION['sessionHalamanKelolaBuku'])) ? $_SESSION['sessionHalamanKelolaBuku'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$namaBuku = query("SELECT RFIDB, mapel.idBuku, namaBuku, status FROM mapel RIGHT JOIN buku ON buku.idBuku = mapel.idBuku ORDER BY idBuku, status DESC, RFIDB LIMIT $awalData, $jumlahDataPerHalaman");
?>
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
        $i = $awalData + 1;
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

        <?php if ($jumlahData != 0) :
            echo "Total Buku : ". $jumlahData;
        endif; ?>

        <!-- navigasi -->
        <?php $banyakNavigasi = 2;

$awalNavigasi = (($halamanAktif - $banyakNavigasi) < 1)? 1 :$halamanAktif - $banyakNavigasi;

$akhirNavigasi = (($halamanAktif + $banyakNavigasi) > $jumlahHalaman)? $jumlahHalaman :$halamanAktif + $banyakNavigasi;

?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                <?php if ($halamanAktif > $banyakNavigasi + 1 && $jumlahData !=0) : ?>
                <li class="page-item"><a class="page-link" href="?halaman=1">Awal</a>
                </li>
                <?php endif; ?>

                <?php if ($halamanAktif > 1 && $jumlahData !=0) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
                </li>
                <?php endif; ?>

                <?php for ($i = $awalNavigasi; $i <= $akhirNavigasi; $i++) :
                    if ($i == $halamanAktif) :?>
                <li class="page-item"><a class="page-link"
                        href="?halaman=<?= $i ?>"
                        style="font-size: 20px; color: red;"><?= $i ?></a>
                </li>
                <?php else : ?>
                <li class="page-item"><a class="page-link"
                        href="?halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php endif;?>
                <?php endfor;?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
                </li>

                <?php if ($halamanAktif < $jumlahHalaman - $banyakNavigasi && $jumlahData !=0) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halaman=<?= $jumlahHalaman ?>">Akhir</a>
                </li>
                <?php endif; ?>

                <?php endif; ?>


            </ul>
        </nav>
    </div>
</div>
<?php
include "template/footer.php";
