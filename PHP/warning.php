<?php
require 'fungsi.php';
// warning (Kirim Pesan Email)
    
$pesanWarning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, email, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' AND warning = 0 ");
// $tes = [];
// echo(count($pesanWarning));
foreach ($pesanWarning as $oneView) :
    // $tes[] = $oneView["namaAnggota"];
    
    $rfidP = $oneView["RFIDP"];
    $rfidB = $oneView["RFIDB"];
    $kelas = $oneView["kelas"];
    $email = $oneView["email"];
    $namaAnggota = $oneView["namaAnggota"];
    $namaBuku = $oneView["namaBuku"];
    // var_dump($pesanWarning);
    
    $subjek= "Warning pengembalian buku dari SMKN 1 WIROSARI";
    $pesan=	"<center><p>Kepada Sdr. $namaAnggota dari kelas $kelas, dimohon untuk segera mengembalikan buku $namaBuku karena telah melewati batas waktu yang ditentukan.</p><br><h3>-Admin Wirapustaka-</h3></center>";
    mysqli_query($koneksi, "UPDATE peminjaman SET warning=1 WHERE RFIDP='$rfidP' AND RFIDB='$rfidB' AND tanggalKembali='0000-00-00'");
    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 0;
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = "rizalscompanylab@gmail.com";
    $mail->Password = "psonsebxiwhrkuee";
    $mail->SetFrom("rizalscompanylab@gmail.com", "Rizal's Company Lab");
    $mail->Subject = $subjek;
    $mail->AddAddress($email);
    $mail->MsgHTML($pesan);
    $mail->Send();

endforeach;
