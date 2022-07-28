<table>
	<tr>
		<th>Pengunjung</th>
	</tr>
	<?php
    require '../../fungsiAdmin.php';
	$jumlahPengunjung = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal'")[0]["COUNT(*)"];
	$jumlahPengunjungWaspada = query("SELECT COUNT(*) FROM absensi WHERE tanggal='$tanggal' AND suhu > 36")[0]["COUNT(*)"]; ?>
	<td><?= "Jumlah pengunjung hari ini adalah : ",$jumlahPengunjung; ?>
	</td>
	<td><?= "Jumlah pengunjung waspada adalah : ",$jumlahPengunjungWaspada; ?>
	</td>
</table>