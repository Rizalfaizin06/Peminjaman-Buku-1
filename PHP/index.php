<?php 
require 'fungsi.php';


if (!empty($_POST['Data1'])) {
	if ($_POST['Data3'] == 'pinjam') {
		pinjam($_POST);
	} elseif ($_POST['Data3'] == 'kembali') {
		kembali($_POST);
	} elseif ($_POST['Data3'] == 'absen') {
		absen($_POST);
	} else {
		echo "Gagal";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Krenova</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
	<div class="header">
		<h1>WIRAPUSTAKA</h1>
		<h3>SMKN 1 WIROSARI</h3>
	</div>
	<div class="sidebar">
		<div class="informasi">
				<h3>INFORMASI</h1>
		</div>
		<div class="warning">			
			<table>
				<tr>
					<th>Warning</th>
				</tr>
				<?php 

				$warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' "); ?>


					<?php foreach ($warning as $oneView) : ?>
					<tr>
						<td><marquee direction="left"><?php printf("Warning!! Atas Nama %s dari kelas %s untuk segera mengembalikan buku %s.",$oneView["namaAnggota"], $oneView["kelas"], $oneView["namaBuku"]); ?></marquee></td>

					</tr>
					<?php endforeach; ?>
			</table>
		</div>
		<div class="pengunjung">
			<table>
				<tr>
					<th>Pengunjung</th>
				</tr>
				<?php 

				$jumlahPengunjung = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal'")[0]["COUNT(*)"];
				$jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"]; ?>
				<td><?= "Jumlah pengunjung hari ini adalah : ",$jumlahPengunjung; ?></td>
				<td><?= "Jumlah pengunjung waspada adalah : ",$jumlahPengunjungWaspada; ?></td>
			</table>
		</div>
		
		
	</div>
	<div class="conten1">
		<table class="tb1">
			<tr class="trUpper">
				<th>No.</th>
				<th>Nama Buku</th>
				<th>Stock</th>
				<th>Status</th>
			</tr>
			<?php 

			$namaBuku = query("SELECT * FROM mapel");
			$i = 1;
			foreach ($namaBuku as $oneView) : ?>
			<tr class="trLower">
				<td><?= $i; ?> </td>
				<td><?= $oneView["namaBuku"]; ?></td>

				<?php
					$mapel = $oneView["idBuku"]; 
					$stock = query("SELECT COUNT(*) FROM buku WHERE idBuku = '$mapel' AND status = '1'")[0]["COUNT(*)"];
				?>

				<td><?= $stock ?></td>

				<?php 
				if ($stock > 0) {
					$stat = 'Tersedia';
				} else {
					$stat = 'Kosong';
				}?>
				<td><?= $stat; ?></td>
			</tr>
			<?php $i++; endforeach; ?>
		</table>
	</div>
	<div class="conten2">
		<table class="tb2">
			
			<tr class="trUpper">
				<th>Nama</th>
				<th>Tanggal</th>
				<th>Jam</th>
				<th>Suhu</th>
			</tr>

			<?php 


			$absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP ORDER BY id DESC LIMIT 5");

			foreach ($absen as $oneView) : ?>
				<tr class="trLower">
					<td><?= $oneView["namaAnggota"]; ?></td>
					<td><?= $oneView["tanggal"]; ?></td>
					<td><?= $oneView["jam"]; ?></td>
					<td><?= $oneView["suhu"]; ?></td>

				</tr>
				<?php endforeach; ?>
		</table>
		

	</div>
	<div class="clear"></div>
	<div class="copyright">
		<p>Copyright (c) 2022 SMKN 1 Wirosari All right reserved</p>
	</div>
</div>


<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>