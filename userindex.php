<!doctype html>
<html lang="en">
	<head>
		<?php include 'components/header.php';?>

		<title>Dobrodošli u pozorište</title>
	</head>
	<body>
	<?php include_once("./components/navbar.php"); ?>

		<header id="myCarousel" class="carousel slide">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<div class="fill" style="background-image:url('img/post-strange.jpg');"></div>
					<div class="carousel-caption">
						<h2>Rezervacija karata</h2>
					</div>
				</div>
				<div class="item">
					<div class="fill" style="background-image:url('img/post-parmanu.jpg');"></div>
					<div class="carousel-caption">
						<h2>Najnovije predstave</h2>
					</div>
				</div>
				<div class="item">
					<div class="fill" style="background-image:url('img/post-dunkirk.png');"></div>
					<div class="carousel-caption">
						<h2>Rekli su o nama</h2>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="icon-next"></span>
			</a>
		</header>

		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Rezervišite svoje karte</h2>
				</div>
				<div class="col-xs-12">
					<h5 class="center-align text-uppercase lead">Predstave</h5>
				</div>
				<div class="col-md-3 col-sm-6">
						<img class="img-responsive img-portfolio img-hover" src="img/cs-adhm.jpg" alt="">
				</div>
				<div class="col-md-3 col-sm-6">
						<img class="img-responsive img-portfolio img-hover" src="img/cs-rockon2.jpg" alt="">
				</div>
				<div class="col-md-3 col-sm-6">
						<img class="img-responsive img-portfolio img-hover" src="img/cs-strange.png" alt="">
				</div>
				<div class="col-md-3 col-sm-6">
						<img class="img-responsive img-portfolio img-hover" src="img/cs-fbawtft.jpg" alt="">
				</div>
			</div>
			<br><br><br>
		</div>

		<div class="bottom">
			<!-- Call to Action Section -->
			<div class="pre-footer small">
				<div class="row">
					<div class="col-xs-12">
						<h5 class="center-align bold" style="color:#555;">Lorem ipsum dolor sit amet consectetur </h5>
					</div>
					<div class="row row-content">
						<div class="col-xs-12">
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi nihil quidem pariatur sunt sed nulla eaque officiis praesentium deserunt, modi maiores saepe officia minus, veniam rerum fugiat nobis? Optio, quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. In eveniet fugiat eum minima expedita libero quaerat, beatae sint itaque, ex aspernatur odit deserunt commodi consectetur velit necessitatibus ab amet recusandae.
						</div>
					</div>
					<div class="row row-content">
						<div class="col-sm-4 col-xs-12">
							<h5 class="bold">Lorem ipsum dolor sit</h5>
						<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi nihil quidem pariatur sunt sed nulla eaque officiis praesentium deserunt, modi maiores saepe officia minus, veniam rerum fugiat nobis? Optio, quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. In eveniet fugiat eum minima expedita libero quaerat, beatae sint itaque, ex aspernatur odit deserunt commodi consectetur velit necessitatibus ab amet recusandae.
						</p>
						</div>
						<div class="col-sm-4 col-xs-12">
							<h5 class="bold">Lorem ipsum dolor sit</h5>
						<p>
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi nihil quidem pariatur sunt sed nulla eaque officiis praesentium deserunt, modi maiores saepe officia minus, veniam rerum fugiat nobis? Optio, quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. In eveniet fugiat eum minima expedita libero quaerat, beatae sint itaque, ex aspernatur odit deserunt commodi consectetur velit necessitatibus ab amet recusandae.
						 </p>
						</div>
						<div class="col-sm-4 col-xs-12">
							<h5 class="bold">Lorem ipsum dolor sit</h5>
						<p>
						Lorem ipsum dolor sit amet consectetur, adipisicing elit. Animi nihil quidem pariatur sunt sed nulla eaque officiis praesentium deserunt, modi maiores saepe officia minus, veniam rerum fugiat nobis? Optio, quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. In eveniet fugiat eum minima expedita libero quaerat, beatae sint itaque, ex aspernatur odit deserunt commodi consectetur velit necessitatibus ab amet recusandae.
						</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include_once("./components/footer.php"); ?>
		<script>
			$('.carousel').carousel({
				interval: 5000 //changes the speed
			})
		</script>
	</body>
</html>
