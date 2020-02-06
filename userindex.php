<?php

require "dbBroker.php";
require "model/predstava.php";

session_start();

if (!isset($_SESSION['korisnik_korisnikId'])) { 
    header('Location: index.php');
    exit();
} elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}


$result = Predstava::getAll($conn);

if (!$result) {
	echo "Nastala je greska pri izvodenju upita<br>";
	die();
}
if (count($result) == 0) {
	echo "Nema predstava";
	die();
}
// else {

?>

<!DOCTYPE html>
<html lang="en" id="<?php echo $_SESSION['korisnik_korisnikId']?>">

<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
	<?php include 'components/header.php'; ?>

	<title>Dobrodošli u pozorište</title>
</head>

<body>
	<?php include 'components/navbar.php'; ?>

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
				<!-- <div class="fill" style="background-image:url('img/post-strange.jpg');"></div> -->
				<div class="carousel-caption">
					<h2>Rezervacija karata</h2>
				</div>
			</div>
			<div class="item">
				<!-- <div class="fill" style="background-image:url('img/post-parmanu.jpg');"></div> -->
				<div class="carousel-caption">
					<h2>Najnovije predstave</h2>
				</div>
			</div>
			<div class="item">
				<!-- <div class="fill" style="background-image:url('img/post-dunkirk.png');"></div> -->
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
		</div>
		<div class="row">

			<?php foreach ($result as $row) {
			?>
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail">
						<center>
							<img src="<?php echo 'img/' . $row->id . '.jpg' ?>" alt="<?php echo $row->naziv ?>" style="width:40%; height:auto; margin-bottom:5px">
							<div class="caption">
								<h4><?php echo $row->naziv; ?></h4>
								<h5><?php echo $row->zanr; ?></h5>
								<div class="form-group">
									<label for="utisakIzmeni">O predstavi:</label>
									<textarea id="utisakIzmeni" name="opis" class="form-control" placeholder="Ocena/Utisak o filmu" style="width: 100%; height: 150px;"><?php echo $row->opis ?></textarea>
								</div>
								<p>
									<button class="btnReserve" type="button" value="<?php echo $row->id ?>" class="btn btn-default dropdown-toggle" style="color:#D11111; font-size:18px">Rezervišite sedište</button>
								</p>
							</div>
						</center>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<br><br><br>
	</div>

	<div class="modal fade" id="reservation" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!-- <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> -->
				<div class="modal-body">
					<div class="container-form">
						<!--ovo je pozadina-->
						<div class="film-image">
							<!-- <img src="img/fav.jpg" alt="rocket_contact"/> -->
						</div>
						<form action="#" method="post" id="rezervacijaForm">
							<h3 style="color: #FE3649">Rezervisanje sedišta</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<p value="" name="idPredstave">Naziv predstave:</p>
										<input id="filmIzmeni" type="text" name="naziv" required class="form-control" placeholder="Naziv filma" value="" readonly />
									</div>

									<div class="form-group">
										<p>Trajanje predstave (u minutima):</p>
										<input id="trajanjeIzmeni" type="number" name="trajanje" required min=0 class="form-control" placeholder="Trajanje filma" value="" readonly />

									</div>


									<div class="form-group">
										<button id="btnRezervisi" type="submit" class="btn btn-success btn-block" style="background-color: #FE3649; border: #FE3649;"><i class="	fas fa-couch"></i> Rezervišite sedište
										</button>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group">
										<p>Izaberite datum izvodjenja:</p>
										<select id="datumiIzvodjenja">
											<option value="0">- Select -</option>
										</select>
									</div>

									<div class="form-group">
										<p>Izaberite sedište:</p>
										<select id="sediste">
											<option value="0">- Select -</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer" style="border:none;">
					<!-- <button type="button" class="btn btn-default" style="background-color: #FE3649; border: #FE3649; color:white;" data-dismiss="modal">Close</button>-->
				</div>
			</div>

		</div>
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
	<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
	<script src="jquery-ui/external/jquery/jquery.js"></script>
	<script src="jquery-ui/jquery-ui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/userpage.js"></script>
	<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		});
	</script>
</body>

</html>