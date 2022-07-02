<?php
include "template/header.php";
//ambil data url
$idBuku = $_GET["idbuku"];

$mapel = query("SELECT namaBuku FROM mapel WHERE idBuku='$idBuku'")[0];

//cek tombol submit
if (isset($_POST["submit"])) {
    //cek berhasil di ubah
    if (ubahMapel($_POST) > 0) {
        echo "
		<script>
		alert('data berhasil diubah');
		document.location.href = 'kelolaMapel.php';
		</script>
		";
    } else {
        echo "<script>
		alert('data berhasil diubah');
		document.location.href = 'kelolaMapel.php';
		</script>
		gagal ditambahkan";
    }
}


?>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Edit Mata Pelajaran
                </div>
                <div class="card-body">

                    <form action="" method="post">




                        <div class="mb-3">
                            <label for="idBukuBaru" class="form-label">ID Mata Pelajaran</label>
                            <input type="text" class="form-control" id="idBukuBaru" name="idBukuBaru"
                                placeholder="Masukkan id Mata Pelajaran"
                                value="<?= $idBuku; ?>"
                                maxlength="4">
                            <input type="hidden" class="form-control" id="idBuku" name="idBuku"
                                placeholder="Masukkan Nama Mata Pelajaran"
                                value="<?= $idBuku; ?>">

                        </div>
                        <div class="mb-3">
                            <label for="namaBuku" class="form-label">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" id="namaBuku" name="namaBuku"
                                placeholder="Masukkan Nama Mata Pelajaran"
                                value="<?= $mapel["namaBuku"] ?>">

                        </div>

                </div>
                <button type="submit" name="submit" class="btn btn-primary float-end">Ganti</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>



<?php include "template/footer.php";
