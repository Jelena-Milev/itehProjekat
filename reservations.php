<?php

require "dbBroker.php";
require "model/rezervacija.php";

session_start();

if (!isset($_SESSION['korisnik_korisnikId'])) { 
    header('Location: index.php');
    exit();
} elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$id = $_SESSION['korisnik_korisnikId'];
$result = Rezervacija::getAll($id);

if (!$result) {
    echo "Nastala je greska pri izvodenju upita<br>";
    die();
}
if (count($result) == 0)
{
    echo "Nema rezervacija";
    die();

}
// else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/drama.jpg"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<?php include 'components/header.php';?>

	<title>Dobrodošli u pozorište</title>
</head>
<body>
	<?php include_once("./components/navbar.php"); ?>

	<!-- <header id="myCarousel" class="carousel slide">
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>

			<div class="carousel-inner">
				<div class="item active">
					<div class="fill" style="background-image:url('');"></div>
					<div class="carousel-caption">
						<h2>Rezervacija karata</h2>
					</div>
				</div>
				<div class="item">
					<div class="fill" style="background-image:url('');"></div>
					<div class="carousel-caption">
						<h2>Najnovije predstave</h2>
					</div>
				</div>
				<div class="item">
					<div class="fill" style="background-image:url('');"></div>
					<div class="carousel-caption">
						<h2>Rekli su o nama</h2>
					</div>
				</div>
			</div>

			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="icon-next"></span>
			</a>
	</header> -->

	<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Rezervišite svoje karte</h2>
				</div>
				<div class="col-xs-12">
					<h5 class="center-align text-uppercase lead">Rezervacije</h5>
				</div>				
			</div>
			<table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Datum</th>
                <th scope="col">Naziv predstave</th>
                <th scope="col">Sala</th>
				<th scope="col">Sedište</th>
				<th scope="col">Trajanje predstave (min)</th>
				<th scope="col">Žanr</th>
                <th scope="col">Izaberi</th>
            </tr>
            </thead>
            <tbody>
            <?php
             foreach ($result as $row) {
                ?>
                <tr>
                    <!--<th scope="row">{{ counter }}</th>-->
                   <!-- <td><?php echo $row->id ?></td>-->
                    <td><?php echo $row->datum ?></td>
                    <td><?php echo $row->naziv ?></td>
                    <td><?php echo $row->sala ?></td>
					<td><?php echo $row->sediste ?></td>
					<td><?php echo $row->trajanje ?></td>
					<td><?php echo $row->zanr ?></td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-rezervacija" value=<?php echo $row->id ?>>
                            <span class="checkmark"></span>
                        </label>
                    </td>

                </tr>
                <?php
            }
             ?>
            </tbody>
        </table>


			<br><br><br>
	</div>

	<!-- <div class="bottom">
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
	</div> -->

	<?php include_once("./components/footer.php"); ?>
	<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		});
	</script>
</body>
</html>
