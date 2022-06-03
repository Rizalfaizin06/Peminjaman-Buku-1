<table>
				<tr>
					<th>Warning</th>
				</tr>
				<?php 
				require '../fungsi.php';

				$warning = query("SELECT peminjaman.RFIDP, peminjaman.RFIDB, buku.idBuku, mapel.namaBuku, kelas,  namaAnggota, tanggalPinjam, tanggalKembali, '$tanggal' AS tgl_sekarang, datediff('$tanggal', tanggalPinjam) AS selisih FROM peminjaman, anggota, buku, mapel WHERE peminjaman.RFIDP=anggota.RFIDP AND peminjaman.RFIDB=buku.RFIDB AND buku.idBuku=mapel.idBuku AND datediff('$tanggal', tanggalPinjam) >= 7 AND tanggalKembali LIKE '0000-00-00' "); ?>


					<?php foreach ($warning as $oneView) : ?>
					<tr>
						<td><marquee direction="left"><?php printf("Warning!! Atas Nama %s dari kelas %s untuk segera mengembalikan buku %s.",$oneView["namaAnggota"], $oneView["kelas"], $oneView["namaBuku"]); ?></marquee></td>

					</tr>
					<?php endforeach; ?>
			</table>