<?php include "template/header.php";
session_start();
if (isset($_SESSION['filter'])) {
    $filter = $_SESSION['filter'];
    $tgl = $_SESSION['tanggal'];
}

?>




<form action="" method="post" id="tahunTok">
    <div class="filter">
        <label>Filter Berdasarkan</label><br>
        <select name="filter" id="filter">
            <option value="0">Semua</option>
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
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

    <button type="submit">Submit</button>
</form>




<?php
    if ((isset($_POST['filter']) && ! empty($_POST['filter'])) || !empty($_SESSION['filter'])) {
        if (empty($_SESSION['filter'])) {
            $filter = $_POST['filter'];
        } else {
            $filter = $_SESSION['filter'];
        }
        


        if ($filter == '1' || $_SESSION['filter'] == '1') {
            if (!isset($_SESSION['tanggal']) || !empty($_POST['tanggal'])) {
                $_SESSION['filter'] = $filter;
                $tgl= date("Y-m-d", strtotime($_POST['tanggal']));
                $_SESSION['tanggal'] = $tgl;
            }
            $tgls = $_SESSION['tanggal'];
            
            $jumlahData = count(query("SELECT * FROM absensi WHERE DATE(tanggal)= '$tgls'"));
            $jumlahDataPerHalaman = 8;
            $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
            $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
            $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

            echo $_SESSION['tanggal'];
            echo '<b>Data Transaksi Tanggal '.$tgls.'</b><br /><br />';

            $absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tgls' LIMIT $awalData, $jumlahDataPerHalaman");

            $query = "SELECT * FROM absensi WHERE DATE(tanggal)='".$tgls."'"; //
    //     } elseif ($filter == '2') { // Jika filter nya 2 (per bulan)
    //         $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    //         echo '<b>Data Transaksi Bulan '.$nama_bulan[$_POST['bulan']].' '.$_POST['tahun'].'</b><br /><br />';
    //         echo '<a href="print.php?filter=2&bulan='.$_POST['bulan'].'&tahun='.$_POST['tahun'].'">Cetak PDF</a><br /><br />';
    //         $query = "SELECT * FROM transaksi WHERE MONTH(tgl)='".$_POST['bulan']."' AND YEAR(tgl)='".$_POST['tahun']."'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    //     } else { // Jika filter nya 3 (per tahun)
    //         echo '<b>Data Transaksi Tahun '.$_POST['tahun'].'</b><br /><br />';
    //         echo '<a href="print.php?filter=3&tahun='.$_POST['tahun'].'">Cetak PDF</a><br /><br />';
    //         $query = "SELECT * FROM transaksi WHERE YEAR(tgl)='".$_POST['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    //     }
    // } else { // Jika user tidak mengklik tombol tampilkan
    //     echo '<b>Semua Data Transaksi</b><br /><br />';
    //     echo '<a href="print.php">Cetak PDF</a><br /><br />';
    //     $query = "SELECT * FROM transaksi ORDER BY tgl"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
        }
    }




    ?>























<!-- 








<form method="get" action="">
    <label>Filter Berdasarkan</label><br>
    <select name="filter" id="filter">
        <option value="">Pilih</option>
        <option value="1">Per Tanggal</option>
        <option value="2">Per Bulan</option>
        <option value="3">Per Tahun</option>
    </select>
    <br /><br />
    <div id="form-tanggal">
        <label>Tanggal</label><br>
        <input type="text" name="tanggal" class="input-tanggal" />
        <br /><br />
    </div>
    <div id="form-bulan">
        <label>Bulan</label><br>
        <select name="bulan">
            <option value="">Pilih</option>
            <option value="1">Januari</option>
            <option value="2">Februari</option>
            <option value="3">Maret</option>
            <option value="4">April</option>
            <option value="5">Mei</option>
            <option value="6">Juni</option>
            <option value="7">Juli</option>
            <option value="8">Agustus</option>
            <option value="9">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <br /><br />
    </div>
    <div id="form-tahun">
        <label>Tahun</label><br>
        <select name="tahun">
            <option value="">Pilih</option>
            <?php
                $query = "SELECT YEAR(tgl) AS tahun FROM transaksi GROUP BY YEAR(tgl)"; // Tampilkan tahun sesuai di tabel transaksi
                $sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                    echo '<option value="'.$data['tahun'].'">'.$data['tahun'].'</option>';
                }
                ?>
</select>
<br /><br />
</div>
<button type="submit">Tampilkan</button>
</form>
<hr />
<?php
    if (isset($_GET['filter']) && ! empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user
        if ($filter == '1') { // Jika filter nya 1 (per tanggal)
            $tgl = date('d-m-y', strtotime($_GET['tanggal']));
            echo '<b>Data Transaksi Tanggal '.$tgl.'</b><br /><br />';
            echo '<a href="print.php?filter=1&tanggal='.$_GET['tanggal'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE DATE(tgl)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
        } elseif ($filter == '2') { // Jika filter nya 2 (per bulan)
            $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            echo '<b>Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="print.php?filter=2&bulan='.$_GET['bulan'].'&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE MONTH(tgl)='".$_GET['bulan']."' AND YEAR(tgl)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
        } else { // Jika filter nya 3 (per tahun)
            echo '<b>Data Transaksi Tahun '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="print.php?filter=3&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE YEAR(tgl)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
        }
    } else { // Jika user tidak mengklik tombol tampilkan
        echo '<b>Semua Data Transaksi</b><br /><br />';
        echo '<a href="print.php">Cetak PDF</a><br /><br />';
        $query = "SELECT * FROM transaksi ORDER BY tgl"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    }
    ?>






-->


















<h1>Filter>hariinidate/tanggal/tahun</h1>
<!-- $tanggalLahir = date("Y-m-d", strtotime($data['tanggalLahir'])); -->

<br>

<table class="table">

    <tr class="trUpper">
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Suhu</th>
    </tr>

    <?php
        
            foreach ($absen as $oneView) : ?>
    <tr class="trLower">
        <td><?= $oneView["namaAnggota"]; ?>
        </td>
        <td><?= $oneView["tanggal"]; ?>
        </td>
        <td><?= $oneView["jam"]; ?>
        </td>
        <td><?= $oneView["suhu"]; ?>
        </td>

    </tr>
    <?php endforeach; if ($jumlahData == '0') {
                echo "<tr>
                <td colspan='4' align='center' style='color: red; font-style: italic; font-size: 20px;'>Data tidak ditemukan</td>
            </tr>";
            }?>

</table>

<!-- navigasi -->
<?php if ($halamanAktif > 1 && $jumlahData !=0) : ?>
<a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
<?php endif; ?>

<?php for ($i = 1; $i <= $jumlahHalaman; $i++) : if ($i == $halamanAktif) :?>
<a href="?halaman=<?= $i ?>"
    style="font-size: 20px; color: red;"><?= $i ?></a>
<?php else : ?>
<a href="?halaman=<?= $i ?>"><?= $i ?></a>
<?php endif;?>
<?php endfor;?>

<?php if ($halamanAktif < $jumlahHalaman) : ?>
<a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
<?php endif; ?>


<!-- <script>
    $(document).ready(function() { // Ketika halaman selesai di load
        $('.fTanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
        $('.tanggalTok, .bulanTok, .tahunTok')
            .hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
        $('.filter').change(function() { // Ketika user memilih filter
            if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                $('.bulanTok, .tahunTok').hide(); // Sembunyikan form bulan dan tahun
                $('.tanggalTok').show(); // Tampilkan form tanggal
            } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                $('.tanggalTok, .tahunTok').hide(); // Sembunyikan form tanggal
                $('.bulanTok').show(); // Tampilkan form bulan dan tahun
            } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                $('.tanggalTok, .bulanTok').hide(); // Sembunyikan form tanggal dan bulan
                $('.tahunTok').show(); // Tampilkan form tahun
            } else { // Jika filternya 3 (per tahun)
                $('.tanggalTok, .bulanTok, .tahunTok')
                    .hide(); // Sembunyikan form tanggal dan bula// Tampilkan form tahun
            }
            $('.tanggalTok input, .bulanTok select, .tahunTok select').val(
                ''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
</script> -->
<!-- <script>
    $(document).ready(function() { // Ketika halaman selesai di load
        $('.fTanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
        $('#form-tanggal, #form-bulan, #form-tahun')
            .hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
        $('#filter').change(function() { // Ketika user memilih filter
            if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            } else { // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }
            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(
                ''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
</script> -->
<?php include "template/footer.php";
