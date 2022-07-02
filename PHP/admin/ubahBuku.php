<?php
include "template/header.php";
//ambil data url
$RFIDB = $_GET["rfidb"];

$mapel = query("SELECT RFIDB, buku.idBuku, buku.status, namaBuku FROM buku LEFT JOIN mapel ON buku.idBuku=mapel.idBuku WHERE RFIDB = '$RFIDB'")[0];

//cek tombol submit
if (isset($_POST["submit"])) {
    //cek berhasil di ubah
    if (ubahBuku($_POST) > 0) {
        echo "
		<script>
		alert('data berhasil diubah');
		document.location.href = 'kelolaBuku.php';
		</script>
		";
    } else {
        echo "<script>
		alert('data berhasil diubah');
		document.location.href = 'kelolaBuku.php';
		</script>
		gagal ditambahkan";
    }
}


?>
<div class="container" style="min-height: 600px;">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Edit Buku
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="RFIDBBaru" class="form-label">RFID Buku</label>
                            <input type="text" class="form-control" id="RFIDBBaru" name="RFIDBBaru"
                                placeholder="Masukkan RFIDBBaru"
                                value="<?= $RFIDB; ?>">
                            <input type="hidden" class="form-control" id="RFIDB" name="RFIDB"
                                placeholder="Masukkan RFID Buku"
                                value="<?= $RFIDB; ?>">

                        </div>
                        <div class="mb-3">
                            <label for="idBuku" class="form-label">ID Mata Pelajaran</label>
                            <input type="text" class="form-control" id="idBuku" name="idBuku"
                                placeholder="Masukkan ID Buku"
                                value="<?= (empty($mapel["idBuku"])) ? '' : $mapel["idBuku"] ; ?>"
                                maxlength="4">

                        </div>
                        <div class="mb-3">
                            <label for="namaBuku" class="form-label" disabled>Nama Buku</label>
                            <input type="text" class="form-control" id="namaBuku" name="namaBuku"
                                placeholder="Masukkan Nama Buku"
                                value="<?= (empty($mapel["idBuku"])) ? '' : $mapel["namaBuku"] ; ?>"
                                aria-label="Disabled input example" disabled>

                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pinjam</label>
                            <input type="text" class="form-control" id="status" name="status"
                                placeholder="Masukkan status peminjaman"
                                value="<?= (empty($mapel["idBuku"])) ? '1'  : $mapel["status"] ; ?>">

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary float-end">Ganti</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
</div>



<?php include "template/footer.php";
