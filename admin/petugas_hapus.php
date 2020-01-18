<?php 
	$id_petugas = $_GET['id_petugas'];
	if (empty($id_petugas)) {
		echo "<script>location='index.php?p=petugas'</script>";
	}else{
		if ($id_petugas == "1") {
			echo "<script>location='index.php?p=petugas'</script>";	
		}else{
			$query = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_petugas='$id_petugas' ");
			$cek = mysqli_num_rows($query);
			if ($cek > 0) {
				$delete = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas' ");
				if ($delete) {
					echo "<script>alert('Petugas berhasil dihapus!')</script>";
					echo "<script>location='index.php?p=petugas'</script>";
				}else{
					echo "<script>location='index.php?p=petugas'</script>";
				}
			}else{
				echo "<script>location='index.php?p=petugas'</script>";	
			}
		}
	}
 ?>