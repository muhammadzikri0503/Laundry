<ol class="breadcrumb">
	<li class="breadcrumb-item">Transaksi</li>
	<li class="breadcrumb-item active">Data Transaksi</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-dollar-sign"></i>
    Data Transaksi yang belum lunas</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Telepon / No.Hp</th>
            <th>Paket</th>
            <th>Berat <span>(Kg)</span></th>
            <th>Berat <span>(Gram)</span></th>
            <th>Total Berat (Kg)</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          	$query = mysqli_query($koneksi, "SELECT * FROM laundry INNER JOIN paket ON laundry.id_paket = paket.id_paket WHERE status='Selesai' ");
          	$no = 1;
            $kali = "1000";
          	while ($data = mysqli_fetch_array($query)) {
          		?>
          		<tr>
          			<td><?php echo $no++; ?></td>
          			<td><?php echo $data['nama_pelanggan'] ?></td>
          			<td><?php echo $data['telepon'] ?></td>
          			<td><?php echo $data['nama_paket'] ?></td>
          			<td><?php echo $data['berat'] ?></td>
                <?php 
                  if ($data['gram'] == "0") {
                    ?>
                    <td>Tidak ada</td>
                    <?php
                  }else{
                    ?>
                    <td><?php echo $data['gram'] ?></td>
                    <?php
                  }
                 ?>
                <?php 
                  if ($data['gram'] == "0") {
                    ?>
                    <td><?php echo $data['berat'] ?></td>
                    <?php
                  }else{
                    ?>
                    <td><?php echo $data['gram'] / $kali + $data['berat'] ?></td>
                    <?php
                  }
                 ?>
          			<td><?php echo rupiah($data['total_harga']) ?></td>
          			<td><span class="badge badge-info"><?php echo $data['status'] ?></span></td>
          			<td><a title="Bayar" href="index.php?p=bayar&id_laundry=<?php echo $data['id_laundry'] ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a></td>
          		</tr>
          		<?php
          		}
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>