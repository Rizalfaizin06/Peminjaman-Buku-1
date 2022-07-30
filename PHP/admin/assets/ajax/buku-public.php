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
    if (!session_id()) {
        session_start();
    }
    require '../../fungsiAdmin.php';
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