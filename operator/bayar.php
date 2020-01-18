<ol class="breadcrumb">
	<li class="breadcrumb-item">Transaksi</li>
	<li class="breadcrumb-item active">Input Pembayaran</li>
</ol>
<?php 
	$bagi = "1000";

	$id_laundry = $_GET['id_laundry'];
	if (empty($id_laundry)) {
		echo "<script>location='index.php?p=transaksi'</script>";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM laundry INNER JOIN paket ON laundry.id_paket=paket.id_paket WHERE status='Selesai' AND id_laundry='$id_laundry' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$data = mysqli_fetch_array($query);

			$kode = mysqli_query($koneksi, "SELECT max(id_transaksi) AS max_kode FROM transaksi ");
			$ambil = mysqli_fetch_array($kode);
			$id_transaksi = $ambil['max_kode'];

			$jumlah = (int) substr($id_transaksi, 2, 4);
			$jumlah++;

			$char = "TR";
			$kode_transaksi = $char . sprintf("%04s", $jumlah);  
		}else{
			echo "<script>location='index.php?p=transaksi'</script>";
		}
	}
 ?>
<form action="" method="POST">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="nama">Nam Pelanggan</label>
				<input type="text" name="nama" id="nama" class="form-control" readonly="" value="<?php echo $data['nama_pelanggan'] ?>">
			</div>
			<div class="form-group">
				<label for="telepon">Telepon</label>
				<input type="number" name="telepon" id="telepon" class="form-control" readonly="" value="<?php echo $data['telepon'] ?>">
			</div>
			<div class="form-group">
				<label for="paket">Paket</label>
				<input type="text" name="paket" id="paket" class="form-control" readonly="" value="<?php echo $data['nama_paket'] ?>">
			</div>
			<div class="form-group">
				<label for="uang">Uang Pelanggan</label>
				<input type="number" name="uang" id="uang" class="form-control" required="" placeholder="Masukkan uang pelanggan" min="<?php echo $data['total_harga'] ?>">
			</div>
		</div>
		<div class="col-md-6">
			<?php 
				if ($data['gram'] == "0") {
					?>
					<div class="form-group">
						<label for="berat">Total Berat (Kg)</label>
						<input type="number" name="berat" id="berat" class="form-control" readonly="" value="<?php echo $data['berat'] ?>">
					</div>
					<?php
				}else{
					?>
					<div class="form-group">
						<label for="berat">Total Berat (Kg)</label>
						<input type="number" name="berat" id="berat" class="form-control" readonly="" value="<?php echo $data['gram'] / $bagi + $data['berat'] ?>">
					</div>
					<?php
				}
			 ?>
			<div class="form-group">
				<label for="total_harga">Total Harga</label>
				<input type="number" name="total_harga" id="total_harga" class="form-control" readonly="" value="<?php echo $data['total_harga'] ?>">
			</div>
			<div>
				<label for="transaksi">Kode Transaksi</label>
				<input type="text" name="transaksi" id="transaksi" class="form-control" required="" readonly="" value="<?php echo $kode_transaksi; ?>">
			</div>
		</div>
		<div class="col-md-12">
			<button name="bayar" class="btn btn-primary">Bayar</button>
			<a href="index.php?p=transaksi" class="btn btn-danger">Kembali</a>
		</div>
	</div>
</form>
<?php 
	if (isset($_POST['bayar'])) {
		$uang = $_POST['uang'];
		$kembalian = $uang - $data['total_harga'];

		$query = mysqli_query($koneksi, "INSERT INTO transaksi SET id_transaksi='$kode_transaksi', id_laundry='$id_laundry', uang='$uang', kembalian='$kembalian' ");
		if ($query) {
			$update = mysqli_query($koneksi, "UPDATE laundry SET status='Lunas' WHERE id_laundry='$id_laundry'");
			?>
			<div class="col-md-6 offset-md-3">
				<div class="card">
				  <div class="card-body">
				  	<div class="alert alert-success">Transaksi berhasil!</div>
				    <h4 class="card-title">Uang Kembalian = <?php echo rupiah($kembalian); ?></h4>
				    <p class="card-text">Terima kasih telah berlangganan di laundry kami.</p>
				    <a href="index.php?p=transaksi" class="btn btn-primary">Selesai</a>
				  </div>
				</div>
			</div>
			<?php
		}else{
			echo "<script>alert('Transaksi gagal!')</script>";
		}
	}
 ?>