<?php
session_start();
require 'admin/fungsiAdmin.php';

if (!empty($_POST['Data1'])) {
    if ($_POST['sendMode'] == 'pinjam') {
        pinjam($_POST);
    } elseif ($_POST['sendMode'] == 'kembali') {
        kembali($_POST);
    } elseif ($_POST['sendMode'] == 'absen') {
        absen($_POST);
    } else {
        echo "Gagal";
    }
}


if (isset($_GET["halaman"])) {
    $_SESSION['sessionHalaman'] = $_GET["halaman"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Krenova</title>
	<!-- <link rel="stylesheet" type="text/css" href="admin/assets/css/style-public.css"> -->
	<link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="admin/assets/icon/bootstrap-icons.css">
</head>

<body>

	<div class="container">

		<div class="mb-4 mt-3 text-center">
			<h1 class="display-3 fw-bold">
				WIRAPUSTAKA<br />
				<span class="text-primary fw-normal display-6">SMKN 1 WIROSARI</span>
			</h1>
		</div>
		<div class="card shadow">
			<div class="card-header bg-dark text-bg-dark">
				<h3 class="text-center">Stock Buku</h3>
			</div>
			<div class="card-body">

				<div class="row mt-2">
					<div class="col-12 col-md-6 col-lg-4">
						<form action="" method="post">
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Cari Buku" name="keywordBuku"
									value="<?php if (isset($_POST['keywordBuku'])) {
									    echo $_POST['keywordBuku'];
									} elseif (isset($_SESSION["sessionKeywordBuku"])) {
									    echo $_SESSION["sessionKeywordBuku"];
									} else {
									    echo '';
									}
?>">
								<button class="btn btn-outline-dark" type="submit" id="button-addon2"
									name="buttonCariBuku">Cari</button>
							</div>
						</form>
					</div>
				</div>

				<table class="table" id="tableBuku">
					<thead class="table-light">
						<tr>
							<th>No.</th>
							<th>Nama Buku</th>
							<th>Stock</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						<?php
                
$i = 1;

if (isset($_POST["buttonCariBuku"]) || isset($_SESSION['sessionKeywordBuku'])) {
    if (isset($_SESSION['sessionKeywordBuku'])) {
        if (isset($_POST["keywordBuku"]) && $_SESSION['sessionKeywordBuku'] != $_POST["keywordBuku"]) {
            $keywordBuku = $_POST['keywordBuku'];
            $_SESSION['sessionKeywordBuku'] = $keywordBuku;
        } else {
            $keywordBuku = $_SESSION['sessionKeywordBuku'];
        }
    } else {
        $keywordBuku = $_POST['keywordBuku'];
        $_SESSION['sessionKeywordBuku'] = $keywordBuku;
    }
        
    
    $buku = query("SELECT RFIDB, mapel.idBuku, namaBuku, COUNT(case when status = 1 then RFIDB end) stock FROM mapel LEFT JOIN buku ON buku.idBuku = mapel.idBuku GROUP BY mapel.idBuku HAVING namaBuku LIKE '%$keywordBuku%'");
} else {
    $buku = query("SELECT RFIDB, mapel.idBuku, namaBuku, COUNT(case when status = 1 then RFIDB end) stock FROM mapel LEFT JOIN buku ON buku.idBuku = mapel.idBuku GROUP BY mapel.idBuku");
}

if ((empty($buku))) {
    echo "<tr><td class='text-center' colspan='4' style='color: red; font-style: italic; font-size: 20px;'>Buku tidak ditemukan</td></tr>";
}
foreach ($buku as $oneView) : ?>
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
}

    ?>
							<td><?= $stat; ?>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>










		<div class="card shadow mt-4">

			<div class="card-header bg-dark text-bg-dark">
				<h3 class="text-center">Pengunjung Hari Ini</h3>
			</div>
			<div class="card-body">
				<div id="tableAbsen">
					<table class="table">
						<?php
            $jumlahData = count(query("SELECT * FROM absensi WHERE DATE(tanggal)= '$tanggal'"));
$jumlahDataPerHalaman = 5;
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = (isset($_SESSION['sessionHalaman'])) ? $_SESSION['sessionHalaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP AND DATE(tanggal)= '$tanggal'  ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
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

							<?php if ($halamanAktif < $jumlahHalaman - $banyakNavigasi && $jumlahData !=0) : ?>
							<li class="page-item"><a class="page-link"
									href="?halaman=<?= $jumlahHalaman ?>">Akhir</a>
							</li>
							<?php endif; ?>

							<?php endif; ?>


						</ul>
					</nav>
					<?php if ($jumlahData != 0) :
                    
					    $jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"];

					    echo "<p>Total Pengunjung : ". $jumlahData . "</p>";
					    echo "<p>Pengunjung Waspada : " . $jumlahPengunjungWaspada . "</p>";
					endif; ?>
				</div>
			</div>
		</div>

		<div class="card shadow mt-4">
			<div class="card-header bg-dark text-bg-dark">
				<h3 class="text-center">Peringatan</h3>
			</div>
			<div class="card-body">
				<ul class="list-group pb-3" id="tablePeringatan">

					<?php

$warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' "); ?>


					<?php
					    if (empty($warning)) {
					        echo "<li class='list-group-item text-center'>Tidak ada peringatan</li>";
					    }
					    foreach ($warning as $oneView) : ?>

					<?= "<li class='list-group-item'><marquee direction='left'>"; ?>
					<?php printf("Peringatan!! Atas Nama %s dari kelas %s untuk segera mengembalikan buku %s.", $oneView["namaAnggota"], $oneView["kelas"], $oneView["namaBuku"]); ?>
					<?= "</marquee></li>"; ?>

					<?php endforeach; ?>
				</ul>
			</div>
		</div>

































		<a href="dst.php">destroy</a>
	</div>

	<script src="admin/assets/js/jquery-3.6.0.min.js"></script>
	<script src="admin/assets/js/script-public.js"></script>
	<script src="admin/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>