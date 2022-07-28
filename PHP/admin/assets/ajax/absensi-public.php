<table class="tb2" id="container-absensi">

	<tr class="trUpper">
		<th>Nama</th>
		<th>Tanggal</th>
		<th>Jam</th>
		<th>Suhu</th>
	</tr>

	<?php

    require '../../fungsiAdmin.php';
	$absen = query("SELECT * FROM absensi, anggota WHERE absensi.RFIDP=anggota.RFIDP ORDER BY id DESC LIMIT 5");

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
	<?php endforeach; ?>
</table>