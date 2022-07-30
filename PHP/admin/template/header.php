<?php
session_start();
include "fungsiAdmin.php";

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/icon/bootstrap-icons.css">
    <title>Wirapustaka</title>
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
                        <a class="nav-link" href="kelolaAnggota.php">Kelola Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekapPeminjam.php">Rekap Peminjam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekapPengunjung.php">Rekap Pengunjung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../">Tampilan Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="logout.php">Logout</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>