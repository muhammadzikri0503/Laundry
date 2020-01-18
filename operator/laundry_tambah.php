<ol class="breadcrumb">
	<li class="breadcrumb-item">Laundry</li>
	<li class="breadcrumb-item active">Tambah Laundry</li>
</ol>
<?php 
	$max = mysqli_query($koneksi, "SELECT max(id_laundry) AS max_kode FROM laundry ");
	$max_kode = mysqli_fetch_array($max);
	$pembagian = $max_kode['max_kode'];
	$kode = (int) substr($pembagian, 2, 4);
	$kode++;

	$char = "PG";
	$kode_laundry = $char . sprintf("%04s",$kode);
 ?>
<form action="" method="POST">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="kode_laundry">Kode Pelanggan</label>
				<input type="text" id="kode_laundry" class="form-control" readonly="" value="<?php echo $kode_laundry; ?>">
			</div>
			<div class="form-group">
				<label for="nama_pelanggan">Nama Pelanggan</label>
				<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required="" placeholder="Masukkan nama pelanggan">
			</div>
			<div class="form-group">
				<label for="telepon">Telepon / No.Hp</label>
				<input type="number" name="telepon" id="telepon" class="form-control" required="" placeholder="Masukkan nomor telepon">
			</div>
			<div class="form-group">
				<label for="jadwal_selesai">Jadwal Selesai</label>
				<select name="jadwal_selesai" id="jadwal_selesai" class="form-control" required="">
					<option value="" selected="" disabled="">Pilih Jadwal</option>
					<option value="Sehari">Sehari <i>(+ Harga Rp. 3.000)</i></option>
					<option value="Dua Hari">Dua Hari <i>(+ Harga Rp. 2.000)</i></option>
					<option value="Tiga Hari">Tiga Hari <i>(+ Harga Rp. 1.000)</i></option>
					<option value="Belakangan">Belakangan</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="paket">Paket</label>
				<select name="paket" id="paket" class="form-control" required="">
					<option value="" selected="" disabled="">Pilih Paket</option>
					<?php
						$select = mysqli_query($koneksi, "SELECT * FROM paket");
						$cek = mysqli_num_rows($select);
						if ($cek > 0) {
						 	while ($data = mysqli_fetch_array($select)) {
						 		?>
						 		<option value="<?php echo $data['id_paket'] ?>"><?php echo $data['nama_paket'] ?></option>
						 		<?php
						 	}
						 }else{
						 	?>
						 	<option value="" disabled="">Paket Kosong!, Harap tambahkan paket!</option>
						 	<?php
						 } 
					 ?>
				</select>
			</div>
			<div class="form-group">
				<label for="berat">Berat <span>(Kg)</span></label>
				<input type="number" min="1" max="100" name="berat" id="berat" class="form-control" required="" placeholder="Masukkan berat (kg)">
			</div>
			<div class="form-group">
				<label for="gram">Berat <span>(Gram)</span></label>
				<input type="number" min="1" max="1000" name="gram" id="gram" class="form-control" placeholder="Masukkan berat tambahan (gram)">
			</div>
		</div>
		<div class="col-md-6">
			<button name="tambah" class="btn btn-primary">Tambah</button>
			<a href="index.php?p=laundry" class="btn btn-danger">Kembali</a>
		</div>
	</div>
</form>
<?php 
	if (isset($_POST['tambah'])) {
		$nama_pelanggan = $_POST['nama_pelanggan'];
		$telepon = $_POST['telepon'];
		$paket = $_POST['paket'];
		$berat = $_POST['berat'];
		$jadwal_selesai = $_POST['jadwal_selesai'];
		$status = "Belum";
		$gram = $_POST['gram'];
		$id_petugas = $_SESSION['data']['id_petugas'];
		$tanggal_masuk = date("d F, Y (l)");

		$ambil_query = mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket='$paket' ");
		$ambil = mysqli_fetch_array($ambil_query);

		if ($jadwal_selesai == "Sehari") {
			$tambah = "3000";
		}elseif ($jadwal_selesai == "Dua Hari") {
			$tambah = "2000";
		}elseif ($jadwal_selesai == "Tiga Hari") {
			$tambah = "1000";
		}elseif ($jadwal_selesai == "Belakangan") {
			$tambah = "0";
		}

		$satuan = "1000";
		@$total_gram = $gram / $satuan;
		@$bayar = $ambil['harga_paket'] * $total_gram;
		
		$total_harga = $berat * $ambil['harga_paket'] + $bayar + $tambah;

		$query = mysqli_query($koneksi, "INSERT INTO laundry SET id_laundry='$kode_laundry', nama_pelanggan='$nama_pelanggan', telepon='$telepon', id_paket='$paket', berat='$berat', gram='$gram', total_harga='$total_harga', tanggal_masuk='$tanggal_masuk', jadwal_selesai='$jadwal_selesai', status='$status', id_petugas='$id_petugas' ");
			if ($query) {
			?>
			<div class="col-md-6 offset-md-3">
				<div class="card">
				  <div class="card-body">
				  	<div class="alert alert-success">Berhasil ditambahkan!</div>
				    <h4 class="card-title">Total Harga adalah : <?php echo rupiah($total_harga); ?></h4>
				    <a target="_blank" href="struk.php?id_laundry=<?php echo $kode_laundry; ?>" class="btn btn-info">Struk</a>
				    <a href="index.php?p=laundry" class="btn btn-primary">Selesai</a>
				  </div>
				</div>
			</div>
			<br>
			<?php
		}
	}
 ?>