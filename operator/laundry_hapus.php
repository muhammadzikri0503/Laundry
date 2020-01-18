<?php 
	$id_laundry = $_GET['id_laundry'];
	if (empty($id_laundry)) {
		echo "<script>location='index.php?p=laundry'</script>";
	}else{
		$lihat = mysqli_query($koneksi, "SELECT * FROM laundry WHERE id_laundry='$id_laundry' ");
		$cek = mysqli_num_rows($lihat);
		if ($cek > 0) {
			$query = mysqli_query($koneksi, "DELETE FROM laundry WHERE id_laundry='$id_laundry' ");
			if ($query) {
				echo "<script>alert('Data berhasil dihapus!')</script>";
				echo "<script>location='index.php?p=laundry'</script>";
			}
		}else{
			echo "<script>location='index.php?p=laundry'</script>";
		}
	}
 ?>