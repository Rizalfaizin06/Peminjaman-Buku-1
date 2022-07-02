<?php

require 'fungsiAdmin.php';
    
$idBuku = $_GET["idbuku"];

if (hapusMapel($idBuku) > 0) {
    echo "
		<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaMapel.php';
		</script>
		";
} else {
    echo "<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaMapel.php';
		</script>
		gagal ditambahkan";
}
