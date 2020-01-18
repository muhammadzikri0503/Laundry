<ol class="breadcrumb">
  <li class="breadcrumb-item">Paket</li>
  <li class="breadcrumb-item active">Data Paket</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-thumbtack"></i>
    Data Paket</div>
  <div class="card-body">
  	<div class="col-md-6"><a title="Tambah" href="index.php?p=paket_tambah" class="btn btn-primary btn-sm">Tambah</a></div><hr>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $query = mysqli_query($koneksi,"SELECT * FROM paket");
            $no = 1;
            while ($data = mysqli_fetch_array($query)) {
              ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama_paket'] ?></td>
                <td><?php echo rupiah($data['harga_paket'],2 ,',','.'); ?></td>
                <td>
                  <a class="btn btn-info btn-sm" title="Edit" href="index.php?p=paket_edit&id_paket=<?php echo $data['id_paket'] ?>"><i class="fa fa-edit"></i></a>
                  <a href="index.php?p=paket_hapus&id_paket=<?php echo $data['id_paket'] ?>" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus paket ini !!')" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php
              }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>