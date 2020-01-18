<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">Dashboard</li>
  <li class="breadcrumb-item active">Overview</li>
</ol>

<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-users"></i>
        </div>
        <?php 
          $query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='2' ");
          $cek = mysqli_num_rows($query);
          if ($cek > 0) {
            ?>
            <div class="mr-5">Jumlah Petugas <b>(<?php echo $cek ?>)</b> Orang</div>
            <?php
          }else{
            ?>
            <div class="mr-5">Tidak ada data!</div>
            <?php
          }
         ?>   
      </div>
      <a class="card-footer text-white clearfix small z-1" href="index.php?p=petugas">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-times-circle"></i>
        </div>
        <?php 
          $query2 = mysqli_query($koneksi, "SELECT * FROM laundry WHERE status='Belum' ");
          $cek2 = mysqli_num_rows($query2);
          if ($cek > 0) {
            ?>
            <div class="mr-5">Laundry yang belum Selesai <b>(<?php echo $cek2 ?>)</b> Buah</div>
            <?php
          }else{
            ?>
            <div class="mr-5">Tidak ada data!</div>
            <?php
          }
         ?>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="index.php?p=laundry">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-tshirt"></i>
        </div>
        <?php 
          $query3 = mysqli_query($koneksi, "SELECT * FROM laundry WHERE status='Lunas' ");
          $cek3 = mysqli_num_rows($query3);
          if ($cek > 0) {
            ?>
            <div class="mr-5">Laundry yang telah Lunas <b>(<?php echo $cek3 ?>)</b> Buah</div>
            <?php
          }else{
            ?>
            <div class="mr-5">Tidak ada data!</div>
            <?php
          }
         ?>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="index.php?p=laundry">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fas fa-fw fa-dollar-sign"></i>
        </div>
        <?php 
          $query4 = mysqli_query($koneksi, "SELECT * FROM laundry WHERE status='Selesai' ");
          $cek4 = mysqli_num_rows($query4);
          if ($cek > 0) {
            ?>
            <div class="mr-5">Laundry yang belum Dibayar <b>(<?php echo $cek4 ?>)</b> Buah</div>
            <?php
          }else{
            ?>
            <div class="mr-5">Tidak ada data!</div>
            <?php
          }
         ?>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="index.php?p=transaksi">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-tshirt"></i>
    Data Laundry</div><hr>
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