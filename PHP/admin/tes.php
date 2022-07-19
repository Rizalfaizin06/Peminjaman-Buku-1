<?php
session_start();
echo "Session Pengunjung :  <br> Filter : ". $_SESSION['filter']. " <br> Tanggal : ".$_SESSION['tanggal']. " <br> Bulan : " .$_SESSION['bulanTahun']. " <br> Tahun : " . $_SESSION['tahun'];
