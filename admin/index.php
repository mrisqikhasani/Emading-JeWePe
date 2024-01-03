  <?php 
  include('template/header.php');
  include('config_query.php');

  $db = new database();

  $query = $db->get_all_data_artikel();

  $rows = mysqli_num_rows($query);
  ?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Manajemen Artikel</h4>
      <?php 
        if(isset($_GET['pesan'])) {
          if($_GET['pesan'] == 'successfully created'){
            echo '<div class="alert alert-success" role="alert"> <h4 class="alert-heading">Artikel berhasil dibuat!</h4></div>';
          } else if($_GET['pesan'] == 'Successfully Update'){
            echo '<div class="alert alert-success" role="alert"> <h4 class="alert-heading">Artikel berhasil diupdate</h4></div>';
          } else if($_GET['pesan'] == 'Successfully Deleted') {
            echo '<div class="alert alert-success" role="alert"> <h4 class="alert-heading">Artikel berhasil dihapus</h4></div>';
          } else {
          echo '<div class="alert alert-danger" role="alert"> <h4 class="alert-heading">Gagal melakukan Operasi</h4></div>';
        }
      }
      ?>
      <hr class="my-5" />

      <!-- Responsive Table -->
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-6">
              <h4>Daftar Artikel</h4>
            </div>
            <div class="col-lg-6">
              <a href="tambahartikel.php" class="btn btn-primary float-end">Tambah Data</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
          <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Gambar - header</th>
                  <th>Judul Artikel</th>
                  <th>Status Publish</th>
                  <th>Tanggal Update</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              
              <tbody class="table-border-bottom-0">
              <?php
              if ($rows != 0) {              
                $data_artikel = $query->fetch_all(MYSQLI_ASSOC);
                foreach ($data_artikel as $key=>$artikel){
              ?>
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $key + 1?></strong></td>
                <td><img src="../upload/artikel/<?=$artikel['header'] ?>"  alt="cover" class="rounded" width="150px"></td>
                <td><?=$artikel['judul']?></td>
                <td>
                  <?php if ($artikel['status_publish'] == 'draft') {?>
                    <span href="" class="badge bg-label-dark me-1 disabled">
                      Draft
                    </span>
                    <?php } else if($artikel['status_publish'] == 'publish') { ?>
                    <span href="" class="badge bg-label-primary me-1 ">
                      Publish
                    </span>
                    <?php }?>
                </td>
                <td>
                  <?=
                    $formatDateTime = date("F j, Y", strtotime($artikel["published_at"]));
                  ?>
                </td>
                <td>
                <div class="dropdown">
                  <button type="button" class="btn btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <?php if ($artikel['status_publish'] == 'draft') {?>
                      <li class="dropdown-item">
                        <a class="button" href="../detail.php?id=<?=$artikel['id_artikel']?>" >
                          <i class='bx bxs-send'></i> Publish 
                        </a>
                      </li>
                      <?php } else if($artikel['status_publish'] == 'publish') { ?>
                        <li class="dropdown-item">
                          <a class="button" href="../detail.php?id=<?=$artikel['id_artikel']?>" >
                          <i class='bx bx-arrow-back' ></i> Revert To Draft 
                          </a>
                        </li>
                    <?php }?>
                    <li class="dropdown-item">
                    <a class="button" href="request/updatestatusartikel.php?id=<?=$artikel['id_artikel']?>" target="_blank">
                      <i class='bx bx-detail'></i> View 
                    </a>
                    </li>
                    <li class="dropdown-item">
                        <a class="button" href="editartikel.php?id=<?=$artikel['id_artikel']?>">
                      <i class="bx bx-edit-alt me-1"></i> Edit</a>
                    </li>
                    <li class="dropdown-item">
                      <a class="button" href="deleteartikel.php?id=<?=$artikel['id_artikel']?>">
                        <i class="bx bx-trash me-1"></i> Delete</a>
                    </li>
                  </ul>
                  </div>
                </td>
              </tr>
              <?php 
              }
            } else { 
                echo "<h3>Tidak ada data</h3>";
              }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
    <!-- / Content -->
  <?php 
    include('template/footer.php')
  ?>


