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
		<th>Aksi</th>
		<th>Kode Buku</th>
		<th>Nama Buku</th>
		<th>Stock</th>
		<th>Status</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($namaBuku as $oneView) : ?>
	<tr class="trLower">
		<td><?= $i; ?> </td>
		<td>
			<a href="ubah.php?id=<?= $oneView["id"]; ?>">ubah</a> | 
			<a href="hapus.php?id=<?= $oneView["id"]; ?>" onclick="return confirm('apakah anda mau menghapus?');" >hapus</a>
		</td>
		<td><?= $oneView["kodeBuku"]; ?></td>
		<td><?= $oneView["mataPelajaran"]; ?></td>

		<?php
			$mapel = $oneView["mataPelajaran"]; 
			$stock = query("SELECT COUNT(*) FROM $mapel WHERE status = '1'")[0]["COUNT(*)"];
		  ?>

		<td><?= $stock ?></td>

		<?php 
		if ($stock > 0) {

			echo '<td style="background-color: rgba(0, 255, 100, 0.2);">Tersedia</td>';

		} else {
			echo '<td style="background-color: rgba(255, 0, 0, 0.4);">Kosong</td>';
		}?>
	</tr>
	<?php $i++; endforeach; ?>

</table>
</body>
</html>