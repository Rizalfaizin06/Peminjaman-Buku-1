<?php
include "template/header.php";
//ambil data url

//cek tombol submit
if (isset($_POST["submit"])) {
    //cek berhasil di ubah
    if (tambahBuku($_POST) > 0) {
        echo "
		<script>
		alert('data berhasil ditambahkan');
		document.location.href = 'kelolaBuku.php';
		</script>
		";
    } else {
        echo "<script>
		alert('data berhasil ditambahkan');
		document.location.href = 'kelolaBuku.php';
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
                    Form Tambah Buku
                </div>
                <div class="card-body">

                    <form action="" method="post">

                        <div class="mb-3">
                            <label for="RFIDB" class="form-label">RFID Buku</label>
                            <input type="text" class="form-control" id="RFIDB" name="RFIDB"
                                placeholder="Masukkan RFID Buku">

                        </div>
                        <div class="mb-3">
                            <label for="idBuku" class="form-label">ID Mata Pelajaran</label>
                            <input type="text" class="form-control" id="idBuku" name="idBuku"
                                placeholder="Masukkan ID Buku" maxlength="4">

                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pinjam</label>
                            <input type="text" class="form-control" id="status" name="status"
                                placeholder="Masukkan status peminjaman" value="1">

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary float-end">Tambah</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</div>



<?php include "template/footer.php";
