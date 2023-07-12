<?php include "template/header.php";
    if (isset($_GET["halaman"])) {
    $_SESSION['sessionHalamanAbsenHome'] = $_GET["halaman"];
}
?>




<div class="card shadow mt-4">

    <div class="card-header bg-dark text-bg-dark">
        <h3 class="text-center">Pengunjung Hari Ini</h3>
    </div>
    <div class="card-body">

        <div class="row mt-2">
            <div class="col-12 col-md-6 col-lg-4">
                <form action="?halaman=1" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Buku" name="KeywordTest" value="<?php if (isset($_POST['KeywordTest'])) {
                            echo $_POST['KeywordTest'];
                        } elseif (isset($_SESSION["sessionKeywordTest"])) {
                            echo $_SESSION["sessionKeywordTest"];
                        } else {
                            echo '';
                        }
?>">
                        <button class="btn btn-outline-dark" type="submit" id="button-addon2"
                            name="btnTest">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="tableAbsen">
            <table class="table">
                <?php

                
if (isset($_POST["btnTest"]) || isset($_SESSION['sessionKeywordTest'])) {
    if (isset($_SESSION['sessionKeywordTest'])) {
        if (isset($_POST["KeywordTest"]) && $_SESSION['sessionKeywordTest'] != $_POST["KeywordTest"]) {
            $KeywordTest = $_POST['KeywordTest'];
            $_SESSION['sessionKeywordTest'] = $KeywordTest;
        } else {
            $KeywordTest = $_SESSION['sessionKeywordTest'];
        }
    } else {
        $KeywordTest = $_POST['KeywordTest'];
        $_SESSION['sessionKeywordTest'] = $KeywordTest;
    }
    
    $jumlahData = count(query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tanggal' AND namaAnggota LIKE '%$KeywordTest%'"));
    $jumlahDataPerHalaman = 5;
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

    $halamanAktif = (isset($_SESSION['sessionHalamanAbsenHome'])) ? $_SESSION['sessionHalamanAbsenHome'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tanggal' AND namaAnggota LIKE '%$KeywordTest%' ORDER BY jam DESC LIMIT $awalData, $jumlahDataPerHalaman");
} else {
    $jumlahData = count(query("SELECT * FROM absensi WHERE DATE(tanggal)= '$tanggal'"));
    $jumlahDataPerHalaman = 5;
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

    $halamanAktif = (isset($_SESSION['sessionHalamanAbsenHome'])) ? $_SESSION['sessionHalamanAbsenHome'] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tanggal' ORDER BY jam DESC LIMIT $awalData, $jumlahDataPerHalaman");
}




?>
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Suhu</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
        $i = $awalData + 1;
foreach ($absen as $oneView) : ?>
                    <tr class="trLower">
                        <td><?= $i;
    $i++?>
                        </td>
                        <td><?= $oneView["namaAnggota"]; ?>
                        </td>
                        <td><?= $oneView["tanggal"]; ?>
                        </td>
                        <td><?= $oneView["jam"]; ?>
                        </td>
                        <?php $suhu = $oneView['suhu']; ?>
                        <?= ($suhu > 36)? "<td style='color: red; font-style: italic;'>". $suhu ."</td>" : "<td>". $suhu ."</td>" ; ?>

                    </tr>
                    <?php endforeach;
if ($jumlahData == '0') {
    echo "<tr>
                <td colspan='5' align='center' style='color: red; font-style: italic; font-size: 20px;'>Belum ada data absensi</td>
            </tr>";
}?>
                </tbody>
            </table>



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
                            style="font-size: 20px; color: red;"><?= $i ?></a></li>
                    <?php else : ?>
                    <li class="page-item"><a class="page-link"
                            href="?halaman=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;?>
                    <?php endfor;?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <li class="page-item"><a class="page-link"
                            href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
                    </li>
                    <?php endif; ?>

                    <?php if ($halamanAktif < $jumlahHalaman - $banyakNavigasi && $jumlahData !=0) : ?>
                    <li class="page-item"><a class="page-link"
                            href="?halaman=<?= $jumlahHalaman ?>">Akhir</a>
                    </li>

                    <?php endif; ?>


                </ul>
            </nav>
            <?php if ($jumlahData != 0) :
                    
                $jumlahPengunjung = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal'")[0]["COUNT(*)"];
                $jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"];
                
                echo "<p>Total Pengunjung : ". $jumlahPengunjung . "</p>";
                echo "<p>Pengunjung Waspada : " . $jumlahPengunjungWaspada . "</p>";
            endif;
?>
        </div>
    </div>
</div>




















































<?php include "template/footer.php";
