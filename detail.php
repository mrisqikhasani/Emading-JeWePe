<?php 
include('template/header.php');
include('admin/config_query.php');

$db = new database();

// memastikan session nya 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// mengecek apakah ada session id 
if (isset($_GET['id'])) {
  $id_artikel = $_GET['id'];
  $query = $db->get_data_artikel('id_artikel', $id_artikel);
  $artikel = $query->fetch_assoc();
} else {
  // mencegah user mengakses endpoint detail.php tanpa parameter get
  header('location:index.php');
}

?>

  <div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('upload/artikel/<?=$artikel['header']?>');">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-6">
          <div class="post-entry text-center">
            <h1 class="mb-4"><?= $artikel['judul']?></h1>
            <div class="post-meta align-items-center text-center">
              <figure class="author-figure mb-0 me-3 d-inline-block"><img src="assets/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
              <span class="d-inline-block mt-1">By Admin</span>
              <span>&nbsp;-&nbsp; 
                <!-- February 10, 2019 -->
                <?= 
                  $formatDateTime = date("F j,Y", strtotime($artikel["published_at"]));
                 ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">

      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-12 main-content">

          <div class="post-content-body">
            <div class="col-md-8 mb-4 mx-auto">
              <img src="upload/artikel/<?=$artikel['header']?>" alt="Image placeholder" class="img-fluid rounded mb-5">
            </div>
            <?= $artikel['body'] ?>
          </div>


        </div>

        <!-- END main-content -->

      </div>
    </div>
  </section>
<?php 
    include('template/footer.php')
?>
