<ol class="breadcrumb">
  <li class="breadcrumb-item">Paket</li>
  <li class="breadcrumb-item active">Tambah Paket</li>
</ol>

<div class="col-md-6">
	<form action="" method="POST">
		<div class="form-group">
			<label for="nama_paket">Nama Paket</label>
			<input type="text" name="nama_paket" id="nama_paket" required="" class="form-control" placeholder="Masukkan nama paket">
		</div>
		<div class="form-group">
			<label for="harga_paket">Harga Paket</label>
			<input type="number" name="harga_paket" id="harga_paket" class="form-control" required="" min="1000" placeholder="Masukkan harga paket">
		</div>
		<button name="tambah" class="btn btn-primary">Tambah</button>
		<a href="index.php?p=paket" class="btn btn-danger">Kembali</a>
	</form>
	<?php 
		if (isset($_POST['tambah'])) {
			$nama_paket = $_POST['nama_paket'];
			$harga_paket = $_POST['harga_paket'];

			$query = mysqli_query($koneksi, "INSERT INTO paket SET nama_paket='$nama_paket', harga_paket='$harga_paket' ");
			if ($query) {
				echo "<script>alert('Paket berhasil ditambahkan!')</script>";
				echo "<script>location='index.php?p=paket'</script>";
			}else{
				echo "<script>alert('Paket gagal ditambahkan!')</script>";
			}
		}
	 ?>
</div>