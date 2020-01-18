<?php 
	$id_paket = $_GET['id_paket'];
	if (empty($id_paket)) {
		echo "<script>location='index.php?p=paket'</script>";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket='$id_paket' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$data = mysqli_fetch_array($query);
		}else{
			echo "<script>location='index.php?p=paket'</script>";	
		}
	}
 ?>

 <ol class="breadcrumb">
 	<li class="breadcrumb-item">Paket</li>
 	<li class="breadcrumb-item active">Edit Paket</li>
 </ol>

 <div class="col-md-6">
 	<form action="" method="POST">
 		<div class="form-group">
 			<label for="nama_paket">Nama Paket</label>
 			<input type="text" name="nama_paket" id="nama_paket" class="form-control" required="" value="<?php echo $data['nama_paket'] ?>">
 		</div>
 		<div class="form-group">
 			<label for="harga_paket">Harga Paket</label>
 			<input type="number" name="harga_paket" id="harga_paket" class="form-control" required="" min="1000" value="<?php echo $data['harga_paket'] ?>">
 		</div>
 		<button name="edit" class="btn btn-primary">Edit</button>
 		<a href="index.php?p=paket" class="btn btn-danger">Kembali</a>
 	</form>
 	<?php 
 		if (isset($_POST['edit'])) {
 			$nama_paket = $_POST['nama_paket'];
 			$harga_paket = $_POST['harga_paket'];

 			$update = mysqli_query($koneksi, "UPDATE paket SET nama_paket='$nama_paket', harga_paket='$harga_paket' WHERE id_paket='$id_paket' ");
 			if ($update) {
 				echo "<script>alert('Paket berhasil di edit!')</script>";
 				echo "<script>location='index.php?p=paket'</script>";
 			}else{
 				echo "<script>alert('Paket gagal di edit!')</script>";
 			}
 		}
 	 ?>
 </div>