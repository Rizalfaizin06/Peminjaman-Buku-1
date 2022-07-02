<?php
include "template/header.php";
//ambil data url

//cek tombol submit
if (isset($_POST["submit"])) {
    //cek berhasil di ubah
    if (tambahMapel($_POST) > 0) {
        echo "
		<script>
		alert('data berhasil ditambahkan');
		document.location.href = 'kelolaMapel.php';
		</script>
		";
    } else {
        echo "<script>
		alert('data berhasil ditambahkan');
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
                    Form Tambah Mata Pelajaran
                </div>
                <div class="card-body">

                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="idBuku" class="form-label">ID Mata Pelajaran</label>
                            <input type="text" class="form-control" id="idBuku" name="idBuku"
                                placeholder="Masukkan ID Mata Pelajaran - Contoh (B001)" maxlength="4">

                        </div>
                        <div class="mb-3">
                            <label for="namaBuku" class="form-label">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" id="namaBuku" name="namaBuku"
                                placeholder="Masukkan Nama Mata Pelajaran">

                        </div>

                </div>
                <button type="submit" name="submit" class="btn btn-primary float-end">Tambah</button>
                </form>

            </div>
        </div>
    </div>
</div>
</div>



<?php include "template/footer.php";
