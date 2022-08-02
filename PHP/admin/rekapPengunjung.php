<?php include "template/header.php";

// if (isset($_SESSION['filter'])) {
//     $filter = $_SESSION['filter'];
//     $tgl = $_SESSION['tanggal'];
// // }
// echo $_SESSION['filter'];

if (isset($_GET["halamanRekapPengunjung"])) {
    $_SESSION['SessionHalamanRekapPengunjung'] = $_GET["halamanRekapPengunjung"];
}

?>

<div class="container" style="min-height: 65vh;">


    <form action="?halamanRekapPengunjung=1" method="post">
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





    <!-- 

    <h1>Filter>hariinidate/tanggal/tahun</h1> -->
    <!-- $tanggalLahir = date("Y-m-d", strtotime($data['tanggalLahir'])); -->

    <div id="rekapPengunjung" class="table-responsive">
        <?php
    if ((isset($_POST['filter']) && ! empty($_POST['filter'])) || !empty($_SESSION['filter'])) {
        if (!empty($_POST['filter']) && $_POST['filter'] != $_SESSION['filter']) {
            $filter = $_POST['filter'];
        } else {
            $filter = $_SESSION['filter'];
        }
        // echo $filter;
        if ($filter == '1') {
            if (!isset($_SESSION['tanggal']) || !empty($_POST['tanggal'])) {
                $_SESSION['filter'] = $filter;
                $tgl= date("Y-m-d", strtotime($_POST['tanggal']));
                $_SESSION['tanggal'] = $tgl;
            }
            $tgls = $_SESSION['tanggal'];
            // echo "masuk satu";
            
            $jumlahData = count(query("SELECT * FROM absensi WHERE DATE(tanggal)= '$tgls'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_SESSION["SessionHalamanRekapPengunjung"])) ? $_SESSION["SessionHalamanRekapPengunjung"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            // echo $_SESSION['tanggal'];
            echo '<b>Data Pengunjung Tanggal '.$tgls.'</b><br /><br />';

            $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tgls' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi WHERE DATE(tanggal)='".$tgls."'";
        } elseif ($filter == '2') {
            // echo "masuk";
            if (!isset($_SESSION['bulanTahun']) || !empty($_POST['bulan'])) {
                $_SESSION['filter'] = $filter;
                $bln= $_POST['bulan'];
                $_SESSION['bulanTahun'] = $bln;
            }

            $bln = date("m", strtotime($_SESSION['bulanTahun']));

            $thn = date("Y", strtotime($_SESSION['bulanTahun']));
            
            $jumlahData = count(query("SELECT * FROM absensi WHERE MONTH(tanggal)= '$bln' AND YEAR(tanggal)='$thn'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_SESSION["SessionHalamanRekapPengunjung"])) ? $_SESSION["SessionHalamanRekapPengunjung"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Data Pengunjung Bulan '.date("F", strtotime($_SESSION['bulanTahun'])).', Tahun '.$thn.'</b><br /><br />';

            $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND MONTH(tanggal)= '$bln' AND YEAR(tanggal)='$thn' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi WHERE DATE(tanggal)='".$bln."'";
        } elseif ($filter == '3') {
            if (!isset($_SESSION['tahun']) || !empty($_POST['tahun'])) {
                $_SESSION['filter'] = $filter;
                $thn= $_POST['tahun'];
                $_SESSION['tahun'] = $thn;
            }
            $thn = $_SESSION['tahun'];
            // echo $thn;
            
            $jumlahData = count(query("SELECT * FROM absensi WHERE YEAR(tanggal)='$thn'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_SESSION["SessionHalamanRekapPengunjung"])) ? $_SESSION["SessionHalamanRekapPengunjung"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Data Pengunjung Tahun '.$thn.'</b><br /><br />';

            $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND YEAR(tanggal)='$thn' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi WHERE DATE(tanggal)='".$thn."'";
        } else {
            // echo "masuk semua";
            if (!isset($_SESSION['filter']) || !empty($_POST['filter'])) {
                $_SESSION['filter'] = $filter;
            }
            
            $jumlahData = count(query("SELECT * FROM absensi"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_SESSION["SessionHalamanRekapPengunjung"])) ? $_SESSION["SessionHalamanRekapPengunjung"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo '<b>Menampilkan Semua Data</b><br /><br />';

            $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi";
        }
    }

?>



        <table class="table">

            <tr class="table-dark">
                <th>No.</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Suhu</th>
            </tr>

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
                <li class="page-item"><a class="page-link" href="?halamanRekapPengunjung=1">Awal</a>
                </li>
                <?php endif; ?>

                <?php if ($halamanAktif > 1 && $jumlahData !=0) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halamanRekapPengunjung=<?= $halamanAktif - 1 ?>">&laquo;</a>
                </li>
                <?php endif; ?>

                <?php for ($i = $awalNavigasi; $i <= $akhirNavigasi; $i++) :
                    if ($i == $halamanAktif) :?>
                <li class="page-item"><a class="page-link"
                        href="?halamanRekapPengunjung=<?= $i ?>"
                        style="font-size: 20px; color: red;"><?= $i ?></a></li>
                <?php else : ?>
                <li class="page-item"><a class="page-link"
                        href="?halamanRekapPengunjung=<?= $i ?>"><?= $i ?></a></li>
                <?php endif;?>
                <?php endfor;?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halamanRekapPengunjung=<?= $halamanAktif + 1 ?>">&raquo;</a>
                </li>

                <?php if ($halamanAktif < $jumlahHalaman - $banyakNavigasi && $jumlahData !=0) : ?>
                <li class="page-item"><a class="page-link"
                        href="?halamanRekapPengunjung=<?= $jumlahHalaman ?>">Akhir</a>
                </li>
                <?php endif; ?>

                <?php endif; ?>


            </ul>
        </nav>
    </div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/script.js">
</script>
<script>
    $('.tanggalTok, .bulanTok, .tahunTok')
        .hide();
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
    $('#tanggal').attr('value', '".$_SESSION['tanggal']."');
    $('.tanggalTok').show();
   </script>";
} elseif ($filter == '2') {
    $bB = 'option[value="2"]';
    echo "<script>
    $('#filter ".$bB."').prop('selected', true);
    $('#bulan').attr('value', '".$_SESSION['bulanTahun']."');
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
