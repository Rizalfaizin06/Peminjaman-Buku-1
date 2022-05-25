<?php 

//koneksi kedatabase
$koneksi = mysqli_connect("127.0.0.1", "rizal", "rizal", "test4");

//query
function query($query){
	global $koneksi;
	$baris = [];
	$result =  mysqli_query($koneksi, $query);
	while ($bar = mysqli_fetch_assoc($result)) {
		$baris[] = $bar;
	}
	return $baris;
}

function tambah($data){
	global $koneksi;
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nrp', '$jurusan', '$gambar')";
	
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}


function ubah($data){
	global $koneksi;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nrp = htmlspecialchars($data["nrp"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	

	$gambarLama = htmlspecialchars($data["gambarLama"]);
	//cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar =$gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";
	
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function pinjam($data){
	global $koneksi;
	$rfidP = $data['Data1'];
    $rfidB = $data['Data2'];
    $Da3 = $data['Data3'];
    $Da4 = $data['Data4'];

    $mapel = query("SELECT * FROM mapel");
    $peminjam = query("SELECT * FROM peminjam WHERE RFID = '$rfidP'")[0];
  	foreach ($mapel as $mpl) {
		$mp = $mpl['idBuku'];
		$statusBuku = query("SELECT * FROM $mp WHERE RFID = '$rfidB'");
		if (empty($statusBuku)) {
			continue;
		}
		if (!empty($statusBuku)) {
			break;
		}
	}
// && $statusBuku[0]['status'] == '1'
	$id = $mapel['id'];
	$idBuku = $mapel['idBuku'];
	$namaBuku = $mapel['namaBuku'];

	if ($peminjam['status'] == '0' && $statusBuku[0]['status'] == '1') {
		foreach ($mapel as $mpl) {
		$mp = $mpl['idBuku'];
		mysqli_query($koneksi,"UPDATE $mp SET status = 0 WHERE RFID = '$rfidB'");
		}
	
		mysqli_query($koneksi,"UPDATE peminjam SET bukuPinjam = '$rfidB', status = 1 WHERE RFID = '$rfidP'");
		return mysqli_affected_rows($koneksi);
	}
	echo "gafgall";
	return false;
	
}

function kembali($data){
	global $koneksi;
	$rfidP = $data['Data1'];
    $rfidB = $data['Data2'];
    $Da3 = $data['Data3'];
    $Da4 = $data['Data4'];

    $mapel = query("SELECT * FROM mapel");

	$id = $mapel["id"];
	$idBuku = $mapel["idBuku"];
	$namaBuku = $mapel["namaBuku"];

	foreach ($mapel as $mpl) {
		$mm = $mpl['idBuku'];
		mysqli_query($koneksi,"UPDATE $mm SET status = 1 WHERE RFID = '$rfidB'");
	}
	
	mysqli_query($koneksi,"UPDATE peminjam SET bukuPinjam = '', status = 0 WHERE RFID = '$rfidP'");

}

?>