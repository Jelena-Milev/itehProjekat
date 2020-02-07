<?php


require "dbBroker.php";
require "model/predstava.php";

session_start();

if (!isset($_SESSION['korisnik_korisnikId'])) { 
    // echo "nije setovan korisnik";
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
if (count($result) == 0)
{
    echo "Nema predstava";
    die();

}
else {

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/drama.jpg"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>To watch list</title>

</head>

<body>

<div class="jumbotron"><h1>TO WATCH LIST</h1>
    <a href="home.php?logout=true" style="float: right; padding: 10px">
        <button id="logout" type="button" class="btn btn-danger" style="background-color: #352621; border: #352621;">Log out</button>
    </a>
</div>

<div class="row" >
    <div class="col-md-3">
        <button id="btn" class="btn btn-info btn-block"
                style="background-color: #352621; border: #352621;"><i
                    class="glyphicon glyphicon-th-list"></i> Pregled
        </button>
    </div>

    <div class="col-md-5">
</div>

    <div class="col-md-1">
        <button id="btn-dodaj" type="button" class="btn btn-success btn-block"
                style="background-color: #352621;border: #352621; " data-toggle="modal" data-target="#myModal"><i
                    class="glyphicon glyphicon-plus"></i> Dodaj
        </button>

    </div>

    <div class="col-md-1">
        <button id="btn-pretraga" class="btn btn-warning btn-block"
                style="background-color:  #352621;border: #352621; "><i
                    class="glyphicon glyphicon-search"></i> Pretraži
        </button>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraži film po žanru" hidden>
    </div>

    <div class="col-md-1">
        <button id="btn-izmeni" type="button" class="btn btn-warning "
                style="background-color:  #352621;border: #352621;" data-toggle="modal" data-target="#izmeniModal"><i
                    class="glyphicon glyphicon-pencil"></i> Izmeni
        </button>
       <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretrazi krofne" hidden>-->
    </div>

    <div class="col-md-1">
        <button id="btn-obrisi" type="button" class="btn btn-warning btn-danger"
                style="background-color:  #352621;border: #352621; "><i
                    class="glyphicon glyphicon-trash"></i> Obrisi 
        </button>
       <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretrazi krofne" hidden>-->
    </div>

  
            </div>-->
</div>

<div id="pregled" class="panel panel-info" style="margin-top: 1%; border:none;">
    <div class="panel-heading" style="background-color:#352621; color:white; border-bottom:white;">Pregled filmova</div> 
    <div class="panel-body">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <!--<th scope="col">Id filma</th>-->
                <th scope="col">Naziv filma</th>
                <th scope="col">Žanr filma</th>
                <th scope="col">Trajanje filma (min)</th>
                <th scope="col">Ocena/Utisak o filmu</th>
                <th scope="col">Izaberi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // foreach ($toppings as $topping) {
            //     echo $topping, "\n";
            // }
            foreach ($result as $row) {
                ?>
                <tr>
                    <!--<th scope="row">{{ counter }}</th>-->
                   <!-- <td><?php echo $row->id ?></td>-->
                    <td><?php echo $row->naziv ?></td>
                    <td><?php echo $row->zanr ?></td>
                    <td><?php echo $row->trajanje ?></td>
                    <td><?php echo $row->opis ?></td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-film" value=<?php echo $row->id ?>>
                            <span class="checkmark"></span>
                        </label>
                    </td>

                </tr>
                <?php
            }
            } ?>
            </tbody>
        </table>

      
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="container-form" > <!--ovo je pozadina-->
                    <div class="film-image"> 
                        <img src="img/fav.jpg" alt="rocket_contact"/>
                    </div>
                    <form action="#" method="post" id="dodajForm">  
                        <h3 style="color: #FE3649">Dodavanje filma</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="naziv" required class="form-control"
                                           placeholder="Naziv filma" value=""/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="zanr" required class="form-control" placeholder="Žanr filma"
                                           value=""/>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="trajanje" required min=0 class="form-control"
                                           placeholder="Trajanje filma" value=""/>
                                           
                                </div>
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block"
                                            style="background-color: #FE3649; border: #FE3649;"><i
                                                class="glyphicon glyphicon-plus"></i> Dodaj
                                    </button>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="opis" class="form-control" placeholder="Ocena/Utisak o filmu"
                                              style="width: 100%; height: 150px;"></textarea>
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

<!-- Modal -->
<div class="modal fade" id="izmeniModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="container-form"> <!--ovde je bilo container krofna-form-->
                    <div class="film-image">
                        <img src="img/fav.jpg" alt="rocket_contact"/>
                    </div>
                    <form action="#" method="post" id="izmeniForm">
                        <h3 style="color: #FE3649">Izmena filma</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="id" type="text" name="id" required class="form-control"
                                           placeholder="Id filma" value="" readonly/>
                                </div>
                                <div class="form-group">
                                    <input id="filmIzmeni" type="text" name="naziv" required class="form-control"
                                           placeholder="Naziv filma" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="zanrIzmeni" type="text" name="zanr" required class="form-control"
                                           placeholder="Žanr filma" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="trajanjeIzmeni" type="number" name="trajanje" required min=0 class="form-control"
                                           placeholder="Trajanje filma" value=""/>
                                </div>
                                <div class="form-group">
                                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block"
                                            style="background-color: #FE3649; border: #FE3649;"><i
                                                class="glyphicon glyphicon-plus"></i> Izmeni
                                    </button>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea id="utisakIzmeni" name="opis" class="form-control"
                                              placeholder="Ocena/Utisak o filmu"
                                              style="width: 100%; height: 150px;"></textarea>
                                              <!-- -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="border:none;">
               <!-- <button type="button" style="margin-bottom:100px; background-color: #FE3649; border: #FE3649; color:white;" class="btn btn-default"  data-dismiss="modal">Close</button>-->
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>
    function myFunction() {

        
        var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[1];
            td2 = tr[i].getElementsByTagName("td")[2];
            td3 = tr[i].getElementsByTagName("td")[3];
            td4 = tr[i].getElementsByTagName("td")[4];

            if (td1 || td2 || td3 || td4) {
                txtValue1 = td1.textContent || td1.innerText; 
                txtValue2 = td2.textContent || td2.innerText;
                txtValue3 = td3.textContent || td3.innerText;
                txtValue4 = td4.textContent || td4.innerText;

              

                
                if (txtValue1.toUpperCase().indexOf(filter) > -1 ) { //ovo je po zanru
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }

            }
        }
    }
</script>


</body>
</html>
