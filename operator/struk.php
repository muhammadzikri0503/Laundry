<?php 
	include'../koneksi.php';
	include'../function.php';

	$bagi = "1000";
	$id_laundry = $_GET['id_laundry'];
	if (empty($id_laundry)) {
		echo "<script>location='index.php?p=laundry'</script>";
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM laundry INNER JOIN paket ON laundry.id_paket=paket.id_paket INNER JOIN petugas ON laundry.id_petugas=petugas.id_petugas WHERE id_laundry='$id_laundry' ");
		$cek = mysqli_num_rows($query);
		if ($cek > 0) {
			$data = mysqli_fetch_array($query);

			$total_berat = $data['gram'] / $bagi + $data['berat'];
		}else{
			echo "<script>location='index.php?p=laundry'</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data['id_laundry'] ?></title>
	<style type="text/css">
		.cetak{
			width: 50%;
			height: auto;
			border: 1px solid #000;
			padding: 20px;
		}
	</style>
</head>
<body style="margin: 0 auto; font-family: monospace;">
	<center>
		<div class="cetak">
			<h2 style="margin: 0;">E-Laundry</h2>
			<br>
			<span><?php echo $data['tanggal_masuk']; ?></span>
			<br>
			<table style="float: none;" width="100%" border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td colspan="3">Nama : <?php echo $data['nama_pelanggan'] ?></td>
					<td colspan="3">No.Hp : <?php echo $data['telepon'] ?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><?php echo $data['nama_paket'] ?></td>
					<?php 
						if ($data['gram'] == "0") {
							?>
							<td style="border-bottom: 1px solid #999;"><?php echo $data['berat'] ?>(Kg)</td>
							<?php
						}else{
							?>
							<td style="border-bottom: 1px solid #999;"><?php echo $total_berat ?>(Kg)</td>
							<?php
						}
					 ?>
					<td style="border-bottom: 1px solid #999;"><?php echo rupiah($data['total_harga']); ?></td>
					<td style="border-bottom: 1px solid #999;">Status <i>(<?php echo $data['status'] ?>)</i></td>
				</tr>
				<tr>
					<td colspan="2">Jadwal Selesai:</td>
					<td><?php echo $data['jadwal_selesai'] ?></td>
				</tr>
				<tr>
					<td colspan="2">Nama Petugas:</td>
					<td><?php echo $data['nama_petugas'] ?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center;">Terima Kasih atas kunjungan anda!</td>
				</tr>
			</table>
		</div>
	</center>
	<br>
	<center>
		<div class="cetak">
			<h2 style="margin: 0;">E-Laundry</h2>
			<br>
			<span><?php echo $data['tanggal_masuk']; ?></span>
			<br>
			<table style="float: none;" width="100%" border="0" cellpadding="10" cellspacing="0">
				<tr>
					<td colspan="3">Nama : <?php echo $data['nama_pelanggan'] ?></td>
					<td colspan="3">No.Hp : <?php echo $data['telepon'] ?></td>
				</tr>
				<tr>
					<td style="border-bottom: 1px solid #999;"><?php echo $data['nama_paket'] ?></td>
					<?php 
						if ($data['gram'] == "0") {
							?>
							<td style="border-bottom: 1px solid #999;"><?php echo $data['berat'] ?>(Kg)</td>
							<?php
						}else{
							?>
							<td style="border-bottom: 1px solid #999;"><?php echo $total_berat ?>(Kg)</td>
							<?php
						}
					 ?>
					<td style="border-bottom: 1px solid #999;"><?php echo rupiah($data['total_harga']); ?></td>
					<td style="border-bottom: 1px solid #999;">Status <i>(<?php echo $data['status'] ?>)</i></td>
				</tr>
				<tr>
					<td colspan="2">Jadwal Selesai:</td>
					<td><?php echo $data['jadwal_selesai'] ?></td>
				</tr>
				<tr>
					<td colspan="2">Nama Petugas:</td>
					<td><?php echo $data['nama_petugas'] ?></td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center;">Terima Kasih atas kunjungan anda!</td>
				</tr>
			</table>
		</div>
	</center>
	<script>
		window.print();
	</script>
</body>
</html>