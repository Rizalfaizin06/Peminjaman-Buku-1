<?php include "template/header.php";
if (isset($_GET["halamanKelMapel"])) {
    $_SESSION['sessionHalamanKelolaMapel'] = $_GET["halamanKelMapel"];
}
?>

<section class="mt-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10 col-xl-11">

                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <h3 class="mb-3">Kontak Kami</h3>
                            <h1 class="">Skansawira R&D Tech</h1>
                            <div class="m-5">
                                <img src="assets/images/logo.png" class="    img-fluid"
                                    style="width: 300px;" />
                            </div>
                            <h2 class="text-muted mb-4">
                                <i class="bi-whatsapp"></i>
                                0822-4227-9859
                            </h2>
                            <a href="https://wa.me/6282242279859?text=Halo+Skansawira+Riset+and+Development+Technology.." class="btn btn-outline-secondary btn-rounded btn-lg">
                                Hubungi Sekarang
                            </a>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include "template/footer.php";

