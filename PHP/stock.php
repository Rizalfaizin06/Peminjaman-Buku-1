<?php 
require 'fungsi.php';

$namaBuku = query("SELECT * FROM mapel");

if (!empty($_POST['Data1'])) {
	if ($_POST['Data3'] == 'pinjam') {
		pinjam($_POST);
	} elseif ($_POST['Data3'] == 'kembali') {
	 	kembali($_POST);
	} else {
		echo "Gagal";
	}
}
	// $mapel = query("SELECT * FROM mapel");

    
	// foreach ($mapel as $mpl) {
	// 	$mp = $mpl['idBuku'];
	// 	$statusBuku = query("SELECT * FROM $mp WHERE RFID = '6CA9A2EE'");
	// 	if (empty($statusBuku)) {
	// 		continue;
	// 	}
	// 	if (!empty($statusBuku)) {
	// 		break;
	// 	}
	// }
	// var_dump($statusBuku[0]['status']);
	
	

	
// if (isset($_POST['Data1'])) {
// 	if ($_POST['Data1'] != '') {
// 		$statusPost = 1;
// 		var_dump($statusPost);
// 	}
	
// }

// if ($statusPost == 1) {
// 	echo "Gagal";
// 	if ($_POST['Data3'] == 'pinjam') {
// 		var_dump($_POST);
// 		// pinjam($_POST);
// 	} elseif ($_POST['Data3'] == 'kembali') {
// 	 	kembali($_POST);
// 	 	$statusPost = 0;
// 	} else {
// 		echo "Gagal";
// 	}
// }
 //  $pmjj = query("SELECT * FROM peminjam WHERE RFID = 'B17BC726'")[0];
 //  var_dump($pmjj['status']);
 //  if ($pmjj['status'] == '0') {
	// var_dump($pmjj['status']);
	// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Krenova</title>
	<link rel="stylesheet" type="text/css" href="css1.css">
</head>
<body>

<!-- <h1>Halaman Utama</h1>

<a href="tambah.php">Tambah Data</a>
<br><br>
<form action="" method="post">
	<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword" autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form> -->
<h1>WIRAPUSTAKA</h1>
<h3 class="ssss">SMKN 1 WIROSARI</h3>
<br>
<table class="tb1">
	<tr class="trUpper">
		<th>No.</th>
		<th>Nama Buku</th>
		<th>Stock</th>
		<th>Status</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($namaBuku as $oneView) : ?>
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

<?php 


$warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, namaAnggota, tanggalPinjam, CURRENT_DATE() AS tgl_sekarang, datediff(CURRENT_DATE(), tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff(CURRENT_DATE(), tanggalPinjam) >= 3");

if (!empty($warning)) { ?>

	<!-- foreach ($warning as $oneView) :
		printf("Warning Atas Nama %s untuk segera mengembalikan buku %s.\n\n\n",$oneView["namaAnggota"], $oneView["namaBuku"]); -->
<table>
	<?php foreach ($warning as $oneView) : ?>
	<tr>
		<td><?php printf("Warning!! Atas Nama %s untuk segera mengembalikan buku %s.\n\n\n",$oneView["namaAnggota"], $oneView["namaBuku"]); ?></td>

	</tr>
	<?php endforeach;
}

 ?>
 </table>
</body>
</html>