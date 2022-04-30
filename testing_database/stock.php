<?php 
require 'fungsi.php';

$namaBuku = query("SELECT * FROM mapel");


if (isset($_POST["cari"])) {
	$buku = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Krenova</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
		<td><?= $stat ?></td>">
	</tr>
	<?php $i++; endforeach; ?>

</table>
</body>
</html>
