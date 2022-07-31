<?php
if (!session_id()) {
    session_start();
}
?>
<table class="table">
	<?php
                        require '../../fungsiAdmin.php';
$jumlahData = count(query("SELECT * FROM absensi WHERE DATE(tanggal)= '$tanggal'"));
$jumlahDataPerHalaman = 5;
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_SESSION['sessionHalamanhome'])) ? $_SESSION['sessionHalamanhome'] : 1;
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
				style="font-size: 20px; color: red;"><?= $i ?></a>
		</li>
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
endif;
