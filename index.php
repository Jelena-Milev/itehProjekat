<?php
require "dbBroker.php";
require "model/korisnik.php";

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $rs = Korisnik::logInUser($uname, $password, $conn);

    if ($rs->num_rows == 1) {
        $row = $rs->fetch_assoc();
        // echo "Uspešno ste se ulogovali!";
        $_SESSION['korisnik_korisnikId'] = $row['korisnikId'];
        $status = $row['status'];
        echo "status: ".$status;

        if ($status == "admin") {
            $location = 'home.php';
            // echo "ovde admin, lokacija: " . $location;
        } else {
            $location = 'userindex.php';
            // echo "ovde user, lokacija: " . $location;
        }
        header("Location: " . $location);
        exit();
    } else {
        header('Location: index.php');
        echo '<script type="text/javascript">alert("Uneli ste pogrešnu šifru!"); 
                                                window.location.href = "http://localhost/domaci_iteh/";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/drama.jpg" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>To watch list</title>
    <script>
        request = $.ajax({
            url: 'http://worldclockapi.com/api/jsonp/cet/now?callback=mycallback=?',
            type: 'GET',
            dataType: 'jsonp'
        });
        request.done(function(res) {
            console.log(res);
            // var data = JSON.parse(res);
            var day = res.dayOfTheWeek
            var date = res.currentDateTime
            var dateSplited = date.split("T");
            var time = dateSplited[1].split("+")
            $('#day').text(day);
            $('#time').text(time[0]);
            $('#date').text(dateSplited[0]);
        });
    </script>

</head>
<script></script>

<body>
    <div class="login-form">
        <div class="day-time">
            <!-- <input type="text" id="date" class="form-control"  readonly>
        <input type="text" id="day" class="form-control"  readonly>
        <input type="text" id="time" class="form-control"  readonly> -->
            <p id="date"> </p>
            <p id="day"> </p>
            <p id="time"> </p>
        </div>
        <div class="main-div">
            <form method="POST" action="#">
                <div class="imgcontainer">
                    <img src="img/kokice.jpg" alt="To watch list" class="watch">
                </div>

                <div class="container">
                    <input type="text" placeholder="korisničko ime" name="username" class="form-control" required>
                    <input type="password" placeholder="lozinka" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Log in</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>