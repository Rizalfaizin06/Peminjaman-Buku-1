<?php 

//koneksi kedatabase
$koneksi = mysqli_connect("127.0.0.1", "rizal", "rizal", "test2");

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
	
	//upload gambar
	$gambar = upload();//akan return nama gambar & berhasil or not

	if (!$gambar) {
		return false;
	}


	$query = "INSERT INTO mahasiswa VALUES ('', '$nama', '$nrp', '$jurusan', '$gambar')";
	
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapus($id){
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id = $id");

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

function cari($keyword) {
	$query = "SELECT * FROM mahasiswa WHERE 
		nama LIKE '%$keyword%' OR 
		nrp LIKE '%$keyword%' OR
		jurusan LIKE '%$keyword%'";

	return query($query);
}
	
function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tnpName = $_FILES['gambar']['tmp_name'];

	if ($error === 4) {
		echo "
			<script>
				alert('pilih gambar terlebih dahulu');
			</script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$extensiGambarValid = ['jpg','jpeg','png'];
	$extensiGambar = explode('.',$namaFile);
	$extensiGambar = strtolower(end($extensiGambar));
	
	if (!in_array($extensiGambar, $extensiGambarValid)) {
		echo "
			<script>
				alert('file yang diupload bukan gambar');
			</script>";
		return false;
	}

	//membatasi ukuran gambar
	if ($ukuranFile > 2000000 ) {
		echo "
			<script>
				alert('ukuran gambar terlalu besar');
			</script>";
		return false;
	}

	//generate nama file baru, karena ada kemungkinan user memasukkan file dengan nama yang sama, dan akan direplace

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $extensiGambar;

	//gambar siap diupload

	move_uploaded_file($tnpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;

}

?>