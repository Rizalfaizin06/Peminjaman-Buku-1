<?php

require 'fungsiAdmin.php';
    
$RFIDP = $_GET["rfidp"];

if (hapusAnggota($RFIDP) > 0) {
    echo "
		<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaAnggota.php';
		</script>
		";
} else {
    echo "<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaAnggota.php';
		</script>
		gagal ditambahkan";
}
