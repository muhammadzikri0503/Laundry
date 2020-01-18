<?php 
	$id_paket = $_GET['id_paket'];
	if (empty($id_paket)) {
		echo "<script>location='index.php?p=paket'</script>";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket='$id_paket' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$delete = mysqli_query($koneksi, "DELETE FROM paket WHERE id_paket='$id_paket' ");
			if ($delete) {
				echo "<script>alert('Paket berhasil di hapus!')</script>";
				echo "<script>location='index.php?p=paket'</script>";
			}else{
				echo "<script>alert('Paket gagal di hapus!')</script>";
			}
		}else{
			echo "<script>location='index.php?p=paket'</script>";
		}
	}
 ?>