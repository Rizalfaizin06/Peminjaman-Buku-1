<?php

//koneksi kedatabase
// $koneksi = mysqli_connect("localhost", "id18952921_rizal", ">R(xFzvAW#ln~1YB", "id18952921_krenova");

$koneksi = mysqli_connect("127.0.0.1", "rizal", "rizal", "test4");

date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d");
    $jam = date("H:i:s");

//query
function query($query)
{
    global $koneksi;
    $baris = [];
    $result =  mysqli_query($koneksi, $query);
    while ($bar = mysqli_fetch_assoc($result)) {
        $baris[] = $bar;
    }
    return $baris;
}

// function tambah($data){
// 	global $koneksi;
// 	$nama = htmlspecialchars($data["nama"]);
// 	$nrp = htmlspecialchars($data["nrp"]);
// 	$jurusan = htmlspecialchars($data["jurusan"]);
    
// 	if (!$gambar) {
// 		return false;
// 	}

// 	$query = "INSERT INTO mahasiswa VALUES (NULL, '$nama', '$nrp', '$jurusan', '$gambar')";
    
// 	mysqli_query($koneksi, $query);

// 	return mysqli_affected_rows($koneksi);
// }


// function ubah($data)
// {
//     global $koneksi;
//     $id = $data["id"];
//     $nama = htmlspecialchars($data["nama"]);
//     $nrp = htmlspecialchars($data["nrp"]);
//     $jurusan = htmlspecialchars($data["jurusan"]);
    

//     $gambarLama = htmlspecialchars($data["gambarLama"]);
//     //cek apakah user pilih gambar baru atau tidak
//     if ($_FILES['gambar']['error'] === 4) {
//         $gambar =$gambarLama;
//     } else {
//         $gambar = upload();
//     }

//     $query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id";
    
//     mysqli_query($koneksi, $query);

//     return mysqli_affected_rows($koneksi);
// }


function tambahAnggota($data)
{
    global $koneksi;
    $RFIDP = $data["RFIDP"];
    $namaAnggota = $data["namaAnggota"];
    $kelas = $data["kelas"];
    $email = $data["email"];
    
    $query = "INSERT INTO anggota VALUES ('$RFIDP', '$namaAnggota', '$kelas', '$email')";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahAnggota($data)
{
    global $koneksi;
    $RFIDP = $data["RFIDP"];
    $RFIDPBaru = $data["RFIDPBaru"];
    $namaAnggota = $data["namaAnggota"];
    $kelas = $data["kelas"];
    $email = $data["email"];

    $query = "UPDATE anggota SET RFIDP = '$RFIDPBaru', namaAnggota = '$namaAnggota', kelas = '$kelas', email = '$email' WHERE RFIDP = '$RFIDP'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusAnggota($data)
{
    global $koneksi;

    $query = "DELETE FROM anggota WHERE RFIDP = '$data'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function tambahMapel($data)
{
    global $koneksi;
    $idBuku = $data["idBuku"];
    $namaBuku = $data["namaBuku"];
    
    $query = "INSERT INTO mapel VALUES ('$idBuku', '$namaBuku')";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahMapel($data)
{
    global $koneksi;
    $idBuku = $data["idBuku"];
    $idBukuBaru = $data["idBukuBaru"];
    $namaBuku = $data["namaBuku"];
    // //$query = "UPDATE `mapel` SET `namaBuku`='MTK' WHERE idBuku = 'B001'";
    // var_dump($data);
    // die;
    $query = "UPDATE mapel SET namaBuku = '$namaBuku', idBuku = '$idBukuBaru' WHERE idBuku = '$idBuku'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusMapel($data)
{
    global $koneksi;

    $query = "DELETE FROM mapel WHERE idBuku = '$data'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function tambahBuku($data)
{
    global $koneksi;
    $RFIDB = $data["RFIDB"];
    $idBuku = $data["idBuku"];
    $status = $data["status"];
    
    $query = "INSERT INTO buku VALUES ('$RFIDB', '$idBuku', '$status')";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubahBuku($data)
{
    global $koneksi;
    $RFIDB = $data["RFIDB"];
    $RFIDBBaru = $data["RFIDBBaru"];
    $idBuku = $data["idBuku"];
    $status = $data["status"];

    $query = "UPDATE buku SET idBuku = '$idBuku', RFIDB = '$RFIDBBaru', status = '$status' WHERE RFIDB = '$RFIDB'";
    
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapusBuku($data)
{
    global $koneksi;

    $query = "DELETE FROM buku WHERE RFIDB = '$data'";
    
    mysqli_query($koneksi, $query);
    
    return mysqli_affected_rows($koneksi);
}

// function pinjam($data){
// 	global $koneksi;
// 	global $tanggal;
// 	global $jam;
// 	$rfidP = $data['Data1'];
//     $rfidB = $data['Data2'];
//     $mode = $data['Data3'];
//     $Da4 = $data['Data4'];

    
// 	mysqli_query($koneksi, "INSERT INTO peminjaman VALUES (NULL, '$rfidP', '$rfidB', '2022-05-02','0000-00-00', 0)");

// 	mysqli_query($koneksi,"UPDATE buku SET status = 0 WHERE RFIDB = '$rfidB'");




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
    
// }

// function kembali($data){
// 	global $koneksi;
// 	global $tanggal;
// 	global $jam;
// 	$rfidP = $data['Data1'];
//     $rfidB = $data['Data2'];
//     $mode = $data['Data3'];
//     $Da4 = $data['Data4'];

//     mysqli_query($koneksi,"UPDATE peminjaman, buku SET tanggalKembali='$tanggal', status=1 WHERE peminjaman.RFIDB=buku.RFIDB AND RFIDP='$rfidP' AND buku.RFIDB='$rfidB' AND tanggalKembali='0000-00-00'");

// //----------------------------------


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

//}


// function absen($data){
// 	global $koneksi;
// 	global $tanggal;
// 	global $jam;
// 	$rfidP = $data['Data1'];
//     $rfidB = $data['Data2'];
//     $mode = $data['Data3'];
//     $Da4 = $data['Data4'];

    
// 	mysqli_query($koneksi, "INSERT INTO absensi VALUES (NULL, '$rfidP', '$tanggal', '$jam','$Da4')");

// }

?>

