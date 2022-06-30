<?php include "template/header.php"; ?>
    

<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Tambah Data Mahasiswa
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama Kamu">
                            
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM Kamu">
                            
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="name@example.com">
                            
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" for="jurusan" id="jurusan" name="jurusan">
                                <option selected value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Teknik Industri">Teknik Industri</option>
                                <option value="Bisnis">Bisnis</option>
                                <option value="Psikologi">Psikologi</option>
                            </select>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary float-end">Tambah Data</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3"> </div>
<?php include "template/footer.php"; ?>