<?php

include "fungsiAdmin.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="icon/bootstrap-icons.css">
    <title>Bootstrap demo</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Wirapustaka</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelolaBuku.php">Kelola Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelolaMapel.php">Kelola Mapel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjam.php">Kelola Peminjam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjam.php">Kelola Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekap.php">Rekap Pengunjung</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>