<?php 
	include'../koneksi.php';
	include'../function.php';
	$tanggal_awal = $_GET['tgl_awal'];
	$tanggal_akhir = $_GET['tgl_akhir'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak</title>
	<link rel="icon" type="image/png" href="../laundry.png">
	  <!-- Custom fonts for this template-->
	  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	  <!-- Page level plugin CSS-->
	  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	  <!-- Custom styles for this template-->
	  <link href="../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col-lg-6" style="margin: 0 auto; float: none;">
			<center>
				<h3>E-Laundry</h3>
				<h2>Laporan Pendapatan Laundry</h2>
				Periode : <?php echo date("d-m-Y", strtotime($tanggal_awal)); ?> s/d <?php echo date("d-m-Y", strtotime($tanggal_akhir)); ?>			
			</center>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Paket</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$cari = "";
						if (!empty($tanggal_awal)) {
							$cari .= " and date(transaksi.tanggal_transaksi) >= '".$tanggal_awal."' ";
						}
						if (!empty($tanggal_akhir)) {
							$cari .= " and date(transaksi.tanggal_transaksi) <= '".$tanggal_akhir."' ";
						}

						$query = mysqli_query($koneksi,"SELECT *, sum(transaksi.uang) as jumlahnya, sum(transaksi.kembalian) as kembalian FROM transaksi LEFT JOIN laundry ON transaksi.id_laundry=laundry.id_laundry LEFT JOIN paket ON laundry.id_paket = paket.id_paket WHERE 1=1 $cari GROUP BY laundry.id_paket");
						$cek = mysqli_num_rows($query);
						if ($cek > 0) {
							$no = 1;
							while ($data = mysqli_fetch_array($query)) {
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data['nama_paket'] ?></td>
									<td><?php echo rupiah($data['jumlahnya'] - $data['kembalian']); ?></td>
								</tr>
								<?php
							}
							?>
								<tr>
									<td colspan="2" class="text-right">Total Semua :</td>
									<td>
										<?php
											$query_total = mysqli_query($koneksi, "SELECT sum(uang) as total_uang, sum(kembalian) as kembalian FROM transaksi WHERE 1=1 $cari");
											$data_total = mysqli_fetch_array($query_total);
											$total = $data_total['total_uang'] - $data_total['kembalian'];
											echo rupiah($total);
										 ?>
									</td>
								</tr>
							<?php
						}else{
							?>
							<tr>
								<td class="text-center" colspan="3">Data tidak tersedia!</td>
							</tr>
							<?php
						}
					 ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
<script>window.print();</script>