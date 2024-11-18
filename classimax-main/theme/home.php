<?php
include "../../admin-conn/db-conn.php";
$sql_get_categories = "SELECT * FROM `categories`";
$categories = mysqli_query($conn,$sql_get_categories);
?>


<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>

  <!-- ** Basic Page Needs ** -->
  <meta charset="utf-8">
  <title>Classimax | Classified Marketplace Template</title>

  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Agency HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="classimax" />

  <!-- favicon -->
  <link href="images/favicon.png" rel="shortcut icon">

  <!-- 
  Essential stylesheets
  =====================================-->
  <link href="../../admin-bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
	    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
	    rel="stylesheet">	
	<!-- Custom styles for this template-->
	<link href="../../admin-bootstrap/css/sb-admin-2.min.css" rel="stylesheet">


  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  
  <link href="css/style.css" rel="stylesheet">

</head>

<body class="body-wrapper">

<?php ob_start()?>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light navigation">
					<a class="navbar-brand" href="home.php">
						<img src="images/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="home.php">Home</a>
							</li>
							
							<li class="nav-item dropdown dropdown-slide @@listing">
								<a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Categories <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<ul class="dropdown-menu">
									<li><a class="dropdown-item " href="categories.php">Categories Grid</a></li>
								</ul>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto mt-10">
							<li class="nav-item">
								<a class="nav-link login-button" href="../../admin-bootstrap/php/index.php">Login</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>

<div class="section-xsm mt-4" style="display: flex; align-items:center; justify-content:center">
    <form method="post"
        class="d-none d-sm-block form-block ml-md-3 my-2 my-md-0 navbar-search" style="width: 80%; ">
		<div class="input-group" style="display:flex; align-items: center">
		    <input type="text" name="search_name" class="form-control bg-light border-0" placeholder="Search for..."
		        aria-label="Search" list="stores" aria-describedby="basic-addon2">
		    <div class="input-group-append">
		        <button id="sb" name="go_to_single_store" class="btn btn-primary" >
		                <i class="fas fa-search fa-sm"></i>
		        </button>
		    </div>
		    <datalist id="stores">
		    <?php
		    $sql_get_search_stores = "SELECT * FROM `stores`";
			if(isset($_GET['category'])) {
				$sql_get_search_stores .= " WHERE `category` = '". $_GET['category']."'";
			}
		    $sr = mysqli_query($conn,$sql_get_search_stores);
		    while($st = mysqli_fetch_assoc($sr)) {?>

		    <option><?=$st['name']?></option>
		    <?php
		    }
		    ?>

		    </datalist>
		</div>
	</form>
</div>

<section class="section-xsm mt-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<div class="category-sidebar">
					<div class="widget category-list">
						<h4 class="widget-header">All Categories</h4>
						<ul>
							<?php
							$all_stores_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS tsc FROM `stores`"));
							?>
							<li><a href="home.php" style="color: primary;">All <span><?=$all_stores_count['tsc']?></span></a></li>
							<?php
							while($cat = mysqli_fetch_assoc($categories)) {
								$sql_get_stores_in_cat = "SELECT COUNT(*) AS stores_count FROM `stores` WHERE `category` = " . $cat['id'];
								$cat_stores_no = mysqli_fetch_assoc(mysqli_query($conn,$sql_get_stores_in_cat));
							?>
							
							<li><a href="home.php?category=<?=$cat['id']?>"><?=$cat['name']?> <span><?=$cat_stores_no['stores_count']?></span></a></li>
							<?php 
							}
							?>

						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-8">
				<div class="product-grid-list">
					<div class="row mt-30">
						<?php
						$stores_per_page = 3;
						$sql_get_stores = "SELECT * FROM `stores`";

						$keepPag = true;
						if(isset($_GET['category'])) {
							$get_c = $_GET['category'];
							$sql_get_stores.=" WHERE `category` = $get_c";
							if (mysqli_fetch_assoc(mysqli_query($conn,$sql_get_stores))==null) {?>
							<div class="col mt-30">
								<p style="text-align: center; color:black;">No Results Found</p>
							</div>
							<?php
							$keepPag = false;
							}
						}

						if($_SERVER['REQUEST_METHOD']=='POST') {
							if(!empty($_POST['search_name'])) {
								$sql_go_to_store_searched = "SELECT * FROM `stores` WHERE `name` = '" . $_POST['search_name'] . "'";
								if(isset($_GET['category'])) {
									$sql_go_to_store_searched .= " AND `category` = " . $_GET['category'];
								}
								$st_search = mysqli_fetch_assoc(mysqli_query($conn,$sql_go_to_store_searched));
								if($_POST['search_name']==$st_search['name']) {
									$found = true;
									ob_end_clean();
									header("location: single_store.php?store=" . $_POST['search_name']);
								}else{
									ob_end_clean();
									header("Location: error_page.php");
								}
							}
						}
						$stores_num = mysqli_num_rows(mysqli_query($conn,$sql_get_stores));
						if($stores_num!=0) {
							$total_pages = ceil($stores_num/$stores_per_page);
							if(isset($_GET['page'])) {
								$page = $_GET['page'];
							} else{
								$page = 1;
							}

							$start_from = ($page-1) * $stores_per_page;
							$sql_get_stores.= " LIMIT $start_from , $stores_per_page";
						}
						$stores_selected = mysqli_query($conn,$sql_get_stores);
						while($store=mysqli_fetch_assoc($stores_selected)) {
						?>
						<div class="col-lg-4 col-md-6">
							<!-- product card -->
							<div class="product-item bg-light shadow">
								<div class="card">
									<div class="thumb-content">
										<!-- <div class="price">$200</div> -->
										<a class="align-middle" href="single_store.php?store=<?=$store['name']?>">
											<img 
											src="../../admin-bootstrap/uploads/<?=$store['img']?>" 
											alt="Card image cap" width="255px" height="155px">
										</a>
									</div>
									<div class="card-body">
									    <h4 class="card-title"><a href="single_store.php?store=<?=$store['name']?>"><?=$store['name']?></a></h4>
									    <ul class="col product-meta">
									    	<li class="list-inline-item">
									    		<a href="single_store.php?store=<?=$store['name']?>"><i class="fa fa-folder-open-o"></i>
												<?php
												$get_categ = mysqli_query($conn,"SELECT * FROM `categories` WHERE `id` = " . $store['category']);
												while($categ = mysqli_fetch_assoc($get_categ)) {
													echo $categ['name'];
												}
												?>
											</a>
									    	</li>
											<br>
											<li class="list-inline-item">
									    		<a href="single_store.php?store=<?=$store['name']?>">Phone: <?=$store['phone']?></a>
									    	</li>
									    	<li class="list-inline-item">
									    		<a href="single_store.php?store=<?=$store['name']?>">Address:  <?=$store['address']?></a>
									    	</li>
									    </ul>
									    <div class="product-ratings">
									    	<ul class="list-inline">
												<?php
												$sid = $store['id'];
												$sql_sum_rating = "SELECT SUM(`rating`) AS total_sum FROM `stores_ratings` WHERE `sid` = $sid";
												$sql_count_rating = "SELECT COUNT(`rating`) AS total_count FROM `stores_ratings` WHERE `sid` = $sid";
				
												$sum = mysqli_fetch_assoc(mysqli_query($conn,$sql_sum_rating));
												$count = mysqli_fetch_assoc(mysqli_query($conn,$sql_count_rating));
												$rat = $count['total_count']==0?0:intval(intval($sum['total_sum'])/intval($count['total_count']));
												for($i=0;$i<5;$i++) {
												?>
									    		<li class="list-inline-item <?php echo $i<$rat?"selected":""?>"><i class="fa fa-star" style="<?php echo $i<$rat?"color:#e8e200;":""?>"></i></li>
												<?php }?>
									    		
									    	</ul>
									    </div>
									</div>
								</div>
							</div>
						</div>
						
						<?php }?>
					</div>
				</div>
				<?php
				if($keepPag) {
				?>
				<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item <?= $page==1?"disabled":""?>">
								<a class="page-link"  aria-label="Previous" href=
								<?php
								if($page>1) {
									if(isset($_GET['category'])) {
										$cat_selected = $_GET['category'];
										$href="home.php?category=".$cat_selected."&&page=".($page-1);
									} else {
										$href="home.php?page=".($page-1);
									}
								echo $href; 
								} else{
									echo "";
								}
								?>
								>
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>

							<?php
							for($i=1;$i<=$total_pages;$i++) {
							?>
							<li class="page-item <?= $i==$page?"active":""?>"><a class="page-link" href=
							<?php
							if(isset($_GET['category'])) {
								$cat_selected = $_GET['category'];
								echo "home.php?category=".$cat_selected."&&page=".$i;
							} else{
								echo "home.php?page=$i";
							}
							?>
							><?=$i?></a></li>
							<?php }?>


							<li class="page-item <?= $page==$total_pages?"disabled":""?>">
								<a class="page-link" aria-label="Next" href= 
								<?php
								if($page<$total_pages) {
									if(isset($_GET['category'])) {
										$cat_selected = $_GET['category'];
										$href="home.php?category=".$cat_selected."&&page=".($page+1);
									} else {
										$href="home.php?page=".($page+1);
									}
								echo $href; 
								} else{
									echo "";
								}
								?>
								>
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
<!--============================
=            Footer            =
=============================-->


<!-- 
Essential Scripts
=====================================-->

<script src="../../admin-bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../../admin-bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../../admin-bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../../admin-bootstrap/js/sb-admin-2.min.js"></script>


<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/popper.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootstrap/bootstrap-slider.js"></script>
<script src="plugins/tether/js/tether.min.js"></script>
<script src="plugins/raty/jquery.raty-fa.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
<script src="plugins/google-map/map.js" defer></script>

<script src="js/script.js"></script>

</body>

</html>



