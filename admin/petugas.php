<ol class="breadcrumb">
  <li class="breadcrumb-item">Petugas</li>
  <li class="breadcrumb-item active">Data Petugas</li>
</ol>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-users"></i>
    Data Petugas</div>
  <div class="card-body">
  	<div class="col-md-6"><a title="Tambah" href="index.php?p=petugas_tambah" class="btn btn-primary btn-sm">Tambah</a></div><hr>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Petugas</th>
            <th>Jenis Kelamin</th>
            <th>Username</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $query = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_level='2' ");
            $cek = mysqli_num_rows($query);
            if ($cek > 0) {
              $no = 1;
              while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nama_petugas'] ?></td>
                  <td><?php echo $data['jenis_kelamin'] ?></td>
                  <td><?php echo $data['username'] ?></td>
                  <td>
                    <a href="index.php?p=petugas_edit&id_petugas=<?php echo $data['id_petugas'] ?>" title="Edit" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus petugas ini !!')" title="Hapus" class="btn btn-warning btn-sm" href="index.php?p=petugas_hapus&id_petugas=<?php echo $data['id_petugas'] ?>"><i class="fa fa-trash-alt"></i></a>
                  </td>
                </tr>
                <?php
              }
            }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>