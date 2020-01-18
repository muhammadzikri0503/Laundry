<?php 
	$id_laundry = $_GET['id_laundry'];
	if (empty($id_laundry)) {
		echo "<script>location='index.php?p=laundry';</script>";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM laundry WHERE id_laundry='$id_laundry' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$data = mysqli_fetch_array($query);
			if ($data['status'] == "Belum") {
				$update = mysqli_query($koneksi, "UPDATE laundry SET status='Selesai' WHERE id_laundry='$id_laundry' ");
				if ($update) {
					echo "<script>alert('Data berhasil di tandai!')</script>";
					echo "<script>location='index.php?p=laundry'</script>";
				}else{
					echo "<script>alert('Data gagal di tandai')</script>";
				}
			}else{
				echo "<script>location='index.php?p=laundry';</script>";
			}
		}else{
			echo "<script>location='index.php?p=laundry';</script>";
		}
	}
 ?>