<ol class="breadcrumb">
  <li class="breadcrumb-item">Petugas</li>
  <li class="breadcrumb-item active">Tambah Petugas</li>
</ol>

<div class="col-md-6">
	<form action="" method="POST">
		<div class="form-group">
			<label for="nama">Nama Petugas</label>
			<input type="text" name="nama" id="nama" class="form-control" required="" placeholder="Masukkan nama petugas">
		</div>
		<div class="form-group">
			<label>Jenis Kelamin</label><br>
			<div class="custom-control custom-radio custom-control-inline">
			  <input class="custom-control-input" type="radio" name="jenis_kelamin" id="laki-laki" value="laki-laki" required="">
			  <label class="custom-control-label" for="laki-laki">
			    Laki - laki
			  </label>
			</div>
			<div class="custom-control custom-radio custom-control-inline">
			  <input class="custom-control-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan">
			  <label class="custom-control-label" for="perempuan">
			    Perempuan
			  </label>
			</div>
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" required="" placeholder="Masukkan username">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" required="" placeholder="Masukkan password">
		</div>
		<button name="tambah" class="btn btn-primary">Tambah</button>
		<a href="index.php?p=petugas" class="btn btn-danger">Kembali</a>
	</form>
	<?php 
		if (isset($_POST['tambah'])) {
			$nama = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$id_level = "2";

			$query_cek = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username = '$username' ");
			$cek = mysqli_num_rows($query_cek);
			if ($cek > 0) {
				?>
				<br>
				<div class="alert alert-warning">Username telah ada, harap masukkan username yang lain!</div>
				<?php
			}else{
				$query = mysqli_query($koneksi,"INSERT INTO petugas SET nama_petugas='$nama', jenis_kelamin='$jenis_kelamin', username='$username', password='$password', id_level='$id_level' ");
				if ($query) {
					echo "<script>alert('Petugas berhasil ditambahkan!')</script>";
					echo "<script>location='index.php?p=petugas'</script>";
				}
			}
		}
	 ?>
</div>