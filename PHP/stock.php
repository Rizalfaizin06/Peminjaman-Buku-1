<?php 
require 'fungsi.php';

$namaBuku = query("SELECT * FROM mapel");
$statusPost = 0;
// if (!empty($_POST['Data1'])) {
// 	$statusPost = 1;
// }

if (isset($_POST['Data1'])) {
	if ($_POST['Data1'] != '') {
		$statusPost = 1;
		var_dump($statusPost);
	}
	
}

if ($statusPost == 1) {
	echo "Gagal";
	if ($_POST['Data3'] == 'pinjam') {
		var_dump($_POST);
		// pinjam($_POST);
	} elseif ($_POST['Data3'] == 'kembali') {
	 	kembali($_POST);
	 	$statusPost = 0;
	} else {
		echo "Gagal";
	}
}
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
			$stock = query("SELECT COUNT(*) FROM $mapel WHERE status = '1'")[0]["COUNT(*)"];
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
</body>
</html>