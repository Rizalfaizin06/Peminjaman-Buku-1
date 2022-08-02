<?php
include "template/header.php";
//ambil data url
$RFIDP = $_GET["rfidp"];

$anggota = query("SELECT RFIDP, namaAnggota, kelas, email FROM anggota WHERE RFIDP = '$RFIDP'")[0];

//cek tombol submit
if (isset($_POST["submit"])) {
    //cek berhasil di ubah
    if (ubahAnggota($_POST) > 0) {
        echo "
		<script>
		alert('data berhasil ditambahkan');
		document.location.href = 'kelolaAnggota.php';
		</script>
		";
    } else {
        echo "<script>
		alert('data berhasil ditambahkan');
		document.location.href = 'kelolaAnggota.php';
		</script>
		gagal ditambahkan";
    }
}


?>
<div class="container" style="min-height: 65vh;">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Ubah Anggota
                </div>
                <div class="card-body">

                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="RFIDPBaru" class="form-label">RFID Anggota</label>
                            <input type="text" class="form-control" id="RFIDPBaru" name="RFIDPBaru"
                                placeholder="Masukkan RFIDPBaru"
                                value="<?= $RFIDP; ?>">
                            <input type="hidden" class="form-control" id="RFIDP" name="RFIDP"
                                placeholder="Masukkan RFID Anggota"
                                value="<?= $RFIDP; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="namaAnggota" class="form-label">Nama Anggota</label>
                            <input type="text" class="form-control" id="namaAnggota" name="namaAnggota"
                                placeholder="Masukkan Nama Anggota"
                                value="<?= $anggota['namaAnggota']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas"
                                placeholder="Masukkan Kelas Anggota"
                                value="<?= $anggota['kelas']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Masukkan email Anggota"
                                value="<?= $anggota['email']; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary float-end">Ubah</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>



<?php include "template/footer.php";
