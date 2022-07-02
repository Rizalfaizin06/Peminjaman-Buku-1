<?php

require 'fungsiAdmin.php';
    
$rfidb = $_GET["rfidb"];

if (hapusBuku($rfidb) > 0) {
    echo "
		<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaBuku.php';
		</script>
		";
} else {
    echo "<script>
		alert('data berhasil dihapus');
		document.location.href = 'kelolaBuku.php';
		</script>
		gagal ditambahkan";
}
