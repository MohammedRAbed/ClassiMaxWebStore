<?php
include "../../admin-conn/db-conn.php";

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

  <style>
	.ec {
		font-size: 40px;
	}
  </style>
  <!-- 
  Essential stylesheets
  =====================================-->
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
  
  <link href="css/style.css" rel="stylesheet">

</head>

<body class="body-wrapper" style="background-color:#f3f3f3">

<header style="background-color:white;">
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
							<li class="nav-item">
								<a class="nav-link" href="home.php">Home</a>
							</li>
							
							<li class="nav-item dropdown dropdown-slide @@listing">
								<a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Categories <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<ul class="dropdown-menu">
									<li><a class="dropdown-item " href="home.php">Categories Grid</a></li>
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

<?php
if(isset($_GET['store'])) {
	$store_name = $_GET['store'];
	$sql_get_store = "SELECT * FROM `stores` WHERE `name` = '$store_name'";
	$result = mysqli_query($conn,$sql_get_store); 
	$store = mysqli_fetch_assoc($result);

	if(isset($_POST['rat_btn'])) {
		$rat = $_POST['rat_value']+1;
		
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$get_ip = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user_ids` WHERE `ip` = '" . $_SERVER['REMOTE_ADDR'] . "'"));
			$get_store_rat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `stores_ratings` WHERE `ip` = '" . $_SERVER['REMOTE_ADDR'] . "' AND `sid` = " . $store['id']));
			if($get_ip==null) {
				$add_new_ip = "INSERT INTO `user_ids`(`ip`) VALUES ('". $_SERVER['REMOTE_ADDR'] ."')";
				mysqli_query($conn,$add_new_ip);
			}
			if($get_store_rat== null) {
				$add_new_rat = "INSERT INTO `stores_ratings`(`ip`, `sid`, `rating`) VALUES ('". $_SERVER['REMOTE_ADDR'] ."',". $store['id'] .",$rat)";
			} else {
				$add_new_rat = "UPDATE `stores_ratings` SET `rating`= $rat WHERE `ip` = '" . $_SERVER['REMOTE_ADDR'] . "' AND `sid` = " . $store['id'];
			}
			mysqli_query($conn,$add_new_rat);

			$avg_query = mysqli_query($conn,"SELECT AVG(`rating`) AS rat_avg FROM `stores_ratings` WHERE `sid` = " . $store['id']);
			$avg = mysqli_fetch_assoc($avg_query)??0;
			
			if(intval($avg['rat_avg'])>2) {
				$r = mysqli_query($conn,"UPDATE `stores` SET `changes` = 'i' WHERE `id` = " . $store['id']);
			} else {
				$r = mysqli_query($conn,"UPDATE `stores` SET `changes` = 'd' WHERE `id` = " . $store['id']);
			}
		}
	}
?>

<section class="section-sm">
	<div class="container" >
	<div class="row" style="display:flex; justify-content: center;">
			<div class="col-lg-11 col-md-6">
                    <div class="container" >
							<!-- product card -->
							<div class="product-item" >
								<div class="row shadow" style="background-color: white;">
									<div class="thumb-content">
										<!-- <div class="price">$200</div> -->
										<a>
											<img src="../../admin-bootstrap/uploads/<?=$store['img']?>" width="250px" height="220px" alt="Card image cap">
										</a>
									</div>
									<div class="col ml-2" style="display:flex; flex-direction: column; justify-content: center;">
									    <h4 class="card-title"><a><?=$store['name']?></a></h4>
									    <ul class="list product-meta">
									    	<li class="list-item mb-2 mt-2">
									    		<a><i class="fa fa-folder-open-o"></i>
												<?php
												$sql_get_cat = "SELECT * FROM `categories` WHERE id = " . $store['category'];
												$category = mysqli_fetch_assoc(mysqli_query($conn,$sql_get_cat)); 
												echo $category['name'];
												?>
												</a>
									    	</li>
									    	<li class="list-item mb-2 mt-2">
									    		<a>Phone: <?=$store['phone']?></a>
									    	</li>
											<li class="list-item mt-2 mb-2">
									    		<a>Address: <?=$store['address']?></a>
									    	</li>
									    </ul>
									    <div class="product-ratings" style="display:inline;">
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
									    		<li class="list-inline-item"><i class="fa fa-star" style="<?php echo $i<$rat?"color:#f0db00;":""?>"></i></li>
												<?php }?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!---->
						
			</div>
			<div class="col-lg-11 col-md-6">
                    <div class="container" >
							<!-- product card -->
							<div class="product-item" >
								<div class="row shadow" style="background-color: white;">
									
									<div class="col ml-2" style="display:flex; flex-direction: column; justify-content: center; align-items: center;">
									    <h4 class="card-title mt-4" style="width: 20%; text-align: center;"><a>What would you rate this store?</a></h4>
										<?php
										$sql_check_uid_rate = "SELECT * FROM `stores_ratings` WHERE `sid` = " . $store['id'] . " AND `ip` = '" . $_SERVER['REMOTE_ADDR'] . "'";
										$uid_rat = mysqli_fetch_assoc(mysqli_query($conn,$sql_check_uid_rate));
										if($uid_rat!=null) {
										?>
									    <p class="mt-2" style="color: #a4a4a4;">YOU'RE CURRENT RATE = <?=$uid_rat['rating']?></p>
										<?php }?>
									    <div class="product-ratings mt-4 mb-4">
									    	<ul class="list-inline" id="stars_container">
												<?php
												for($i=0;$i<5;$i++) {
												?>
									    		<li class="list-inline-item"><i onclick="rate(<?=$i?>)" class="store-rating-star fa fa-star mt-4" style="font-size: 50px;"></i></li>
												<?php }?>
									    	</ul>

											
									    </div>
										<div>
											<form method="post" style="display:flex; flex-direction: column; justify-content: center; align-items: center;">
												<input type="hidden" name="rat_value" id="number" value="4">
												<button id="rat_btn" name="rat_btn" type="submit" class="btn-primary rounded py-2 mt-2 mb-4"><?=$uid_rat==null?"Rate Now":"Update rating"?></button>
											</form>
										</div>
										
									</div>
								</div>
							</div>
						</div>
			</div>
	</div>
	</div>
<!--
<h1 style="text-align: center; padding:50px;">Store isn't specified</h1>
	-->
</section>
<?php
}else{?>
<h1 style="text-align: center; padding:50px;">Store isn't specified</h1>

<?php
}?>



<!-- 
Essential Scripts
=====================================-->
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

<!-- Sweet Alert -->
<script src="../js/sweetalert2.all.min.js"></script>

<script>
	
	var rating_number = document.getElementById('number');
	var rat_btn = document.getElementById('rat_btn');

	rate(0);

	function rate(rate_input) {
		rating_number.value = rate_input;
		let stars_container = document.getElementById('stars_container');
		for(var i =0; i<=rate_input; i++) {
			stars_container.children[i].children[0].style.color = "orange";
		}
		for(var i =rate_input+1; i<=5; i++) {
			stars_container.children[i].children[0].style.color = "gray";
		}
	}

	
                            
</script>

</body>

</html>



