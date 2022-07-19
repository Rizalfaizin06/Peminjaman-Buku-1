<?php include "template/header.php"; ?>



<div class="container" style="min-height: 405px;">


    <form action="?halaman=1" method="post">
        <div class="filter">
            <label>Filter Berdasarkan</label><br>
            <select name="filter" id="filter">
                <option value="4">Semua</option>
                <option value="1">Per
                    Tanggal
                </option>
                <option value="2">Per
                    Bulan</option>
                <option value="3">Per Tahun</option>
            </select>
        </div>

        <div class="tanggalTok">
            <input class="fTanggal" type="date" name="tanggal" id="tanggal">
        </div>

        <div class="bulanTok">
            <input type="month" id="bulan" name="bulan">
        </div>

        <div class="tahunTok">
            <select name="tahun" id="tahun">
                <!-- <option value="" selected hidden>Pilih Tahun</option> -->
            </select>
            <script>
                var year = 2020;
                var till = 2040;
                var strOption = "<option selected hidden>Pilih Tahun</option>";
                for (var y = year; y <= till; y++) {
                    strOption += "<option value=" + y + ">" + y + "</option>";
                }
                document.getElementById("tahun").innerHTML = strOption;
            </script>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Cari</button>
    </form>




    <?php
    if ((isset($_POST['filter']) && ! empty($_POST['filter'])) || !empty($_SESSION['filterPeminjaman'])) {
        if (!empty($_POST['filter']) && $_POST['filter'] != $_SESSION['filterPeminjaman']) {
            $filter = $_POST['filter'];
        } else {
            $filter = $_SESSION['filterPeminjaman'];
        }
        // echo $filter;
        if ($filter == '1') {
            if (!isset($_SESSION['tanggalPeminjaman']) || !empty($_POST['tanggal'])) {
                $_SESSION['filterPeminjaman'] = $filter;
                $tgl= date("Y-m-d", strtotime($_POST['tanggal']));
                $_SESSION['tanggalPeminjaman'] = $tgl;
            }
            $tgls = $_SESSION['tanggalPeminjaman'];
            // echo "masuk satu";
            
            $jumlahData = count(query("SELECT * FROM peminjaman WHERE DATE(tanggalPinjam)= '$tgls'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            // echo $_SESSION['tanggalPeminjaman'];
            echo '<b>Data Transaksi Tanggal '.$tgls.'</b><br /><br />';

            $absen = query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND DATE(tanggalPinjam)= '$tgls' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM peminjaman WHERE DATE(tanggalPinjam)='".$tgls."'";
        } elseif ($filter == '2') {
            // echo "masuk";
            if (!isset($_SESSION['bulanTahunPeminjaman']) || !empty($_POST['bulan'])) {
                $_SESSION['filterPeminjaman'] = $filter;
                $bln= $_POST['bulan'];
                $_SESSION['bulanTahunPeminjaman'] = $bln;
            }

            $bln = date("m", strtotime($_SESSION['bulanTahunPeminjaman']));

            $thn = date("Y", strtotime($_SESSION['bulanTahunPeminjaman']));

            
            $jumlahData = count(query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND MONTH(tanggalPinjam)= '$bln' AND YEAR(tanggalPinjam)='$thn'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Data Transaksi Bulan '.date("F", strtotime($_SESSION['bulanTahunPeminjaman'])).', Tahun '.$thn.'</b><br /><br />';

            $absen = query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND MONTH(tanggalPinjam)= '$bln' AND YEAR(tanggalPinjam)='$thn' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM peminjaman WHERE DATE(tanggalPinjam)='".$bln."'";
        } elseif ($filter == '3') {
            // echo "masuk tahum";
            if (!isset($_SESSION['tahunPeminjaman']) || !empty($_POST['tahun'])) {
                $_SESSION['filterPeminjaman'] = $filter;
                $thn= $_POST['tahun'];
                $_SESSION['tahun'] = $thn;
            }
            $thn = $_SESSION['tahun'];
            // echo $thn;
            
            $jumlahData = count(query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND YEAR(tanggalPinjam)='$thn'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Data Transaksi Tahun '.$thn.'</b><br /><br />';

            $absen = query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND YEAR(tanggalPinjam)='$thn' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP AND DATE(tanggalPinjam)='".$thn."'";
        } else {
            // echo "masuk semua";
            if (!isset($_SESSION['filterPeminjaman']) || !empty($_POST['filter'])) {
                $_SESSION['filterPeminjaman'] = $filter;
            }
            
            $jumlahData = count(query("SELECT * FROM peminjaman"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Menampilkan Semua Data</b><br /><br />';

            $absen = query("SELECT namaAnggota, namaBuku, tanggalPinjam, tanggalKembali FROM peminjaman P, buku B, mapel M, anggota A WHERE P.RFIDB=B.RFIDB AND B.idBuku=M.idBuku AND P.RFIDP=A.RFIDP LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi";
        }
    }

?>


















    <!-- 

    <h1>Filter>hariinidate/tanggal/tahun</h1> -->
    <!-- $tanggalLahir = date("Y-m-d", strtotime($data['tanggalLahir'])); -->


    <table class="table">

        <tr class="table-dark">
            <th>No.</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>

        <?php
        $i = $awalData + 1;
foreach ($absen as $oneView) : ?>
        <tr class="trLower">
            <td><?= $i; $i++?>
            </td>
            <td><?= $oneView["namaAnggota"]; ?>
            </td>
            <td><?= $oneView["namaBuku"]; ?>
            </td>
            <td><?= $oneView["tanggalPinjam"]; ?>
            </td>
            <?= ($oneView["tanggalKembali"] != "0000-00-00")? "<td>Sudah dikembalikan</td>" : "<td style='color: red; font-style: italic;'>Belum dikembalikan</td>" ; ?>


        </tr>
        <?php endforeach; if ($jumlahData == '0') {
            echo "<tr>
                <td colspan='5' align='center' style='color: red; font-style: italic; font-size: 20px;'>Data tidak ditemukan</td>
            </tr>";
        }?>

    </table>


    <?php if ($jumlahData != 0) :
        echo "Total Data : ". $jumlahData;
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

            <?php if ($halamanAktif < $jumlahHalaman - $banyakNavigasi && $jumlahData !=0) : ?>
            <li class="page-item"><a class="page-link"
                    href="?halaman=<?= $jumlahHalaman ?>">Akhir</a>
            </li>
            <?php endif; ?>

            <?php endif; ?>


        </ul>
    </nav>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/script.js">
</script>
<script>
    $(' .tanggalTok, .bulanTok, .tahunTok').hide();
</script>
<!-- <script>
    $('#tanggal').attr('value', $('#tanggal').val());
    console.log($('#tanggal').val());
    $('.tanggalTok').show();
</script> -->
<!-- <script>
    $('#filter option[value="1"]').prop('selected', true);
    $('.tanggalTok').show();
</script>" -->
<?php
if ($filter == '1') {
    $bT = 'option[value="1"]';
    echo "<script>
    $('#filter ".$bT."').prop('selected', true);
    $('#tanggal').attr('value', '".$_SESSION['tanggalPeminjaman']."');
    $('.tanggalTok').show();
   </script>";
} elseif ($filter == '2') {
    $bB = 'option[value="2"]';
    echo "<script>
    $('#filter ".$bB."').prop('selected', true);
    $('#bulan').attr('value', '".$_SESSION['bulanTahunPeminjaman']."');
    $('.bulanTok').show();
   </script>";
} elseif ($filter == '3') {
    $thn = $_SESSION['tahun'];
    $bT = 'option[value="3"]';
    $a = 'option[value="'.$thn.'"]';
    echo "<script>
    $('#filter ".$bT."').prop('selected', true);
    $('#tahun').find('".$a."').prop('selected', true);
    $('.tahunTok').show();
   </script>";
}


include "template/footer.php";
