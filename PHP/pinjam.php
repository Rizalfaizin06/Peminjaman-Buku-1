<?php 
require 'fungsi.php';

if ($_POST['Data3'] == 'pinjam') {

	if(pinjam($_POST) > 0){
		echo "
		<script>
		alert('data berhasil dihapus');
		</script>
		";
	} else {
		echo "<script>
		alert('data berhasil dihapus');
		</script>
		gagal ditambahkan";
	}
	$statusPost = 0;

} elseif ($_POST['Data3'] == 'kembali') {
 	kembali($_POST);
 	$statusPost = 0;
} else {
	echo "Gagal";
}


header('Location: stock.php');
exit;

?>