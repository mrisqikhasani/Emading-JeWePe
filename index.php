<?php
// load header.php
include('template/header.php');
// memanggil config_query yang berisi method menghubungkan ke database
include('admin/config_query.php');

$db = new database();
$query = $db->get_data_artikel('status_publish', 'publish');
$rows = mysqli_num_rows($query);
?>
	<section class="section">
		<div class="container">

			<div class="row mb-4">
				<div class="col-sm-6">
					<h2 class="posts-entry-title">Mading Jewepe by Risqi Khasani</h2>
				</div>
				<!-- <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a></div> -->
			</div>

			<div class="row" id="maincontent">
				<?php 
				if($rows != 0) {
					$artikel = $query->fetch_all(MYSQLI_ASSOC);
					foreach( $artikel as $key => $value ){ ?>
				<div class="col-lg-4 mb-4">
					<div class="post-entry-alt">
						<a href="detail.php?id=<?=$value['id_artikel']?>" class="img-link">
							<img src="upload/artikel/<?=$value['header']?>" alt="Image" class="img-fluid">
						</a>
						<div class="excerpt">
							<h2><a href="detail.php?id=<?=$value['id_artikel']?>"><?=$value['judul']?></a></h2>
							<div class="post-meta align-items-center text-left clearfix">
								<figure class="author-figure mb-0 me-3 float-start"><img src="assets/landing/images/person_1.jpg" alt="Image" class="img-fluid"></figure>
								<span class="d-inline-block mt-1">By <a href="#">Admin</a></span>
								<span>&nbsp;-&nbsp; 
								<?= 
									$formatDateTime = date("F j,Y", strtotime($value["published_at"]));
				                 ?>
								</span>
							</div>
							<p>
							<?php 
							// mengambil deskripsi artikel 
								$txt_artikel = $value['body'];
								$potongan_artikel = substr($txt_artikel, 0, 300);
								echo $potongan_artikel;
							?>
							</p>
							<br>
							<p><a href="detail.php?id=<?=$value['id_artikel']?>" class="read-more">Continue Reading</a></p>
						</div>
					</div>
				</div>
				<?php 
					}
				} else {
					echo "<h3>Tidak Ada Artikel</h3>";
				}
				?>
			</div>
		</div>
	</section>

<?php
	include('template/footer.php')
?>



