<ol class="breadcrumb">
	<li class="breadcrumb-item">Laundry</li>
	<li class="breadcrumb-item active">Data Laundry</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-tshirt"></i>
    Data Laundry</div>
  <div class="card-body">
  	<div class="col-md-6"><a title="Tambah" href="index.php?p=laundry_tambah" class="btn btn-primary btn-sm">Tambah</a></div><hr>
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
            <th>Tanggal Masuk</th>
            <th>Jadwal Selesai</th>
            <th>Status</th>
            <th>Nama Petugas</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $query = mysqli_query($koneksi, "SELECT * FROM laundry INNER JOIN paket ON laundry.id_paket=paket.id_paket INNER JOIN petugas ON laundry.id_petugas=petugas.id_petugas ORDER BY id_laundry DESC ");
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
                <td><?php echo $data['tanggal_masuk'] ?></td>
                <td><?php echo $data['jadwal_selesai'] ?></td>
                <?php 
                  if ($data['status'] == "Belum") {
                    ?>
                    <td><span class="badge badge-warning">Belum</span></td>
                    <?php
                  }elseif ($data['status'] == "Selesai") {
                    ?>
                    <td><span class="badge badge-info">Selesai</span></td>
                    <?php
                  }elseif ($data['status'] == "Lunas") {
                    ?>
                    <td><span class="badge badge-success">Lunas</span></td>
                    <?php
                  }
                 ?>
                 <td><?php echo $data['nama_petugas'] ?></td>

                 <?php 
                  if ($data['status'] == "Belum") {
                    ?>
                    <td class="text-center">
                     <a href="index.php?p=tandai&id_laundry=<?php echo $data['id_laundry'] ?>" class="btn btn-primary btn-sm" title="Tandai" onclick="return confirm('Apakah anda yakin telah laundry?')"><i class="fa fa-clipboard-check"></i></a>
                     <a title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini!')" class="btn btn-danger btn-sm" href="index.php?p=laundry_hapus&id_laundry=<?php echo $data['id_laundry'] ?>"><i class="fa fa-trash-alt"></i></a></td>
                   </td>
                    <?php
                    }else{
                      ?>
                      <td class="text-center"><p>-</p>
                      <a title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini!')" class="btn btn-danger btn-sm" href="index.php?p=laundry_hapus&id_laundry=<?php echo $data['id_laundry'] ?>"><i class="fa fa-trash-alt"></i></a></td>
                      <?php
                    }
                  ?>
              </tr>
              <?php
            }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>