<?php 
	$hari_ini = date('Y-m-d');
 ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item">Laporan</li>
  <li class="breadcrumb-item active">Data Laporan</li>
</ol>

<div class="row">
	<div class="col-lg-8">
		<div class="card card-primary">
			<div class="card-header">Data Laporan</div>
			<div class="card-body">
				<form method="GET" class="form-inline" action="">
					<input type="hidden" name="p" value="laporan">
					<div class="form-group">
						<label for="tgl_awal">Tanggal Awal :</label>
						<input type="date" name="tanggal_awal" id="tgl_awal" class="form-control" value="<?php echo !empty($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : $hari_ini ?>">	
					</div>
					<div class="form-group">
						<label for="tgl_akhir">Tanggal Akhir :</label>
						<input type="date" name="tanggal_akhir" id="tgl_akhir" class="form-control" value="<?php echo !empty($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : $hari_ini ?>">
					</div>
					<div class="form-group">
						<input type="submit" title="Filter" name="cari" value="Filter" class="btn btn-primary btn-sm">
						<button class="btn btn-success btn-sm" id="cetak"><i class="fa fa-print"></i></button>
					</div>
				</form>

				<table class="table table-boldered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Pelanggan</th>
							<th>Paket</th>
							<th>Tanggal Transaksi</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<hr>
						<?php
							$cari = "";
							@$tanggal_awal = $_GET['tanggal_awal'];
							@$tanggal_akhir = $_GET['tanggal_akhir'];
							if (!empty($tanggal_awal)) {
								$cari .= " and date(transaksi.tanggal_transaksi) >= '".$tanggal_awal."' ";
							}
							if (!empty($tanggal_akhir)) {
								$cari .= " and date(transaksi.tanggal_transaksi) <= '".$tanggal_akhir."' ";
							}
							if (empty($tanggal_awal) && empty($tanggal_akhir)) {
								$cari .= "and date(transaksi.tanggal_transaksi) >= '".$hari_ini."' and date(transaksi.tanggal_transaksi) >= '".$hari_ini."' ";
							}

							$pembagian = 5;
							$page = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
							$mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;
							$query_jumlah = mysqli_query($koneksi,"SELECT *, transaksi.tanggal_transaksi as tgl FROM transaksi WHERE 1=1 $cari");
							$jumlah = mysqli_num_rows($query_jumlah);
							$jumlah_halaman = ceil($jumlah / $pembagian);


							$query = mysqli_query($koneksi,"SELECT *, transaksi.tanggal_transaksi as tgl FROM transaksi LEFT JOIN laundry ON transaksi.id_laundry=laundry.id_laundry LEFT JOIN paket ON laundry.id_paket = paket.id_paket WHERE 1=1 $cari LIMIT $mulai,$pembagian ");
							$cek = mysqli_num_rows($query);
							if ($cek > 0) {
								$no = $mulai + 1;
								while ($data = mysqli_fetch_array($query)) {
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $data['nama_pelanggan'] ?></td>
										<td><?php echo $data['nama_paket'] ?></td>
										<td><?php echo $data['tgl'] ?></td>
										<td><?php echo rupiah($data['uang'] - $data['kembalian']) ?></td>
									</tr>
									<?php
								}
							}else{
								?>
								<tr>
									<td class="text-center" colspan="6">Data tidak Ada!</td>
								</tr>
								<?php
							}
						 ?>
					</tbody>
				</table>

				<nav>
				  <ul class="pagination justify-content-center">
				    <li class="page-item">
				      <a class="page-link" href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $page - 1; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php 
				    	for ($i=1; $i <= $jumlah_halaman; $i++) { 
				    		?>
				    		<li class="page-item <?php echo ($i == $_GET['halaman'] ? 'active' : '') ?>"><a class="page-link" href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				    		<?php
				    	}
				     ?>
				    <li class="page-item">
				      <a class="page-link" href="?p=laporan&tanggal_awal=<?php echo $tanggal_awal?>&tanggal_akhir=<?php echo $tanggal_akhir ?>&halaman=<?php echo $page + 1; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
	</div>
	</div>
</div>