<?php

require "dbBroker.php";
require "model/predstava.php";

// session_start();

// if (!isset($_SESSION['korisnik_korisnikId'])) {
//     // echo "nije setovan korisnik";
//     header('Location: index.php');
//     exit();
// } elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
//     session_unset();
//     session_destroy();
//     header("Location: index.php");
// }


$result = Predstava::getCountForChart($conn);

// if (!$result) {
//     echo "Nastala je greska pri izvodenju upita<br>";
//     die();
// }
// if (count($result) == 0) {
//     echo "Nema predstava";
//     die();
// }
// else {
?>

<html>

<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Predstava', 'Broj rezervacija'],
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        echo "['" . $row['naziv'] . "', " . $row['broj'] . "],";
                    }
                }
                ?>
            ]);
            // Set chart options
            var options = {
                'title': 'Pregled broja rezervacija po predstavama',
                'is3D': true,
                'width': 400,
                'height': 300
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
</body>

</html>