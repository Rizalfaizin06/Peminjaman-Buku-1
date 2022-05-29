<?php 

//koneksi kedatabase
// $koneksi = mysqli_connect("localhost", "id18952921_rizal", ">R(xFzvAW#ln~1YB", "id18952921_krenova");

$koneksi = mysqli_connect("127.0.0.1", "rizal", "rizal", "test4");

date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d");
    $jam = date("H:i:s");

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

	$query = "INSERT INTO mahasiswa VALUES (NULL, '$nama', '$nrp', '$jurusan', '$gambar')";
	
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
	global $tanggal;
	global $jam;
	$rfidP = $data['Data1'];
    $rfidB = $data['Data2'];
    $mode = $data['Data3'];
    $Da4 = $data['Data4'];

	
	mysqli_query($koneksi, "INSERT INTO peminjaman VALUES (NULL, '$rfidP', '$rfidB', '2022-05-20','0000-00-00')");

	mysqli_query($koneksi,"UPDATE buku SET status = 0 WHERE RFIDB = '$rfidB'");




//     $mapel = query("SELECT * FROM mapel");
//     $peminjam = query("SELECT * FROM peminjam WHERE RFID = '$rfidP'")[0];
//   	foreach ($mapel as $mpl) {
// 		$mp = $mpl['idBuku'];
// 		$statusBuku = query("SELECT * FROM $mp WHERE RFID = '$rfidB'");
// 		if (empty($statusBuku)) {
// 			continue;
// 		}
// 		if (!empty($statusBuku)) {
// 			break;
// 		}
// 	}
// // && $statusBuku[0]['status'] == '1'
// 	$id = $mapel['id'];
// 	$idBuku = $mapel['idBuku'];
// 	$namaBuku = $mapel['namaBuku'];

// 	if ($peminjam['status'] == '0' && $statusBuku[0]['status'] == '1') {
// 		foreach ($mapel as $mpl) {
// 		$mp = $mpl['idBuku'];
// 		mysqli_query($koneksi,"UPDATE $mp SET status = 0 WHERE RFID = '$rfidB'");
// 		}
	
// 		mysqli_query($koneksi,"UPDATE peminjam SET bukuPinjam = '$rfidB', status = 1 WHERE RFID = '$rfidP'");
// 		return mysqli_affected_rows($koneksi);
// 	}
// 	echo "gafgall";
// 	return false;
	
}

function kembali($data){
	global $koneksi;
	global $tanggal;
	global $jam;
	$rfidP = $data['Data1'];
    $rfidB = $data['Data2'];
    $mode = $data['Data3'];
    $Da4 = $data['Data4'];

    mysqli_query($koneksi,"UPDATE peminjaman, buku SET tanggalKembali='$tanggal', status=1 WHERE peminjaman.RFIDB=buku.RFIDB AND RFIDP='$rfidP' AND buku.RFIDB='$rfidB' AND tanggalKembali='0000-00-00'");
// UPDATE peminjaman, buku SET tanggalKembali='$tanggal', status=1 WHERE peminjaman.RFIDB=buku.RFIDB AND RFIDP='90A6361A' AND buku.RFIDB='6CA9A2EE'
 //    $mapel = query("SELECT * FROM mapel");

	// $id = $mapel["id"];
	// $idBuku = $mapel["idBuku"];
	// $namaBuku = $mapel["namaBuku"];

	// foreach ($mapel as $mpl) {
	// 	$mm = $mpl['idBuku'];
	// 	mysqli_query($koneksi,"UPDATE $mm SET status = 1 WHERE RFID = '$rfidB'");
	// }
	
	// mysqli_query($koneksi,"UPDATE peminjam SET bukuPinjam = NULL, status = 0 WHERE RFID = '$rfidP'");

}


function absen($data){
	global $koneksi;
	global $tanggal;
	global $jam;
	$rfidP = $data['Data1'];
    $rfidB = $data['Data2'];
    $mode = $data['Data3'];
    $Da4 = $data['Data4'];

	
	mysqli_query($koneksi, "INSERT INTO absensi VALUES (NULL, '$rfidP', '$tanggal', '$jam','$Da4')");

}
// SELECT '$jam' - INTERVAL '5' HOUR atau SELECT SUBTIME(CURRENT_TIME, '05:00:00')
?>

