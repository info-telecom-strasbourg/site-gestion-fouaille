<?php
    require 'connect.php';

    $value = 'value="';
    $boutton = '';
    $graph = '';

    if(!empty($_GET["date"]) ){
        $date_debut = $_GET["date"] . ' 17:00:00';
        $date_fin = $_GET["date"] . ' 23:30:00';
        $value = $value . $_GET["date"] . '"';

        $boutton = '<button type="submit" class="btn btn-primary">Envoyer</button>';

        $graph = '<div id="chart_div" style="width: 100%; height: 600px;"></div>';

        $sql_produit = 'SELECT DISTINCT produit FROM Commande WHERE date_histo > "'. $date_debut . '" AND date_histo < "' . $date_fin . '" AND delta < 0';

        if ($pdo->query($sql_produit) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $tab_produit = $pdo->query($sql_produit)->fetchAll(PDO::FETCH_COLUMN, 0);
        }

    }else{
        $value = '';

        $boutton = '<button type="submit" class="btn btn-secondary">Envoyer</button>';
    }
?>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graphique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<header>
    <?php include 'navbar.php'; ?>
</header>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Temps', 'biere12','biere16'],
                ['10',  3, 10],
                ['20',  6, 15],
                ['30',  9, 20],
                ['40',  12, 25],
                ['50',  15, 30],
                ['60',  18, 35],
                ['70',  21, 40],
                ['80',  24, 45],
                ['90',  27, 50]
            ]);

            var options = {
                title: 'Recette par minute',
                hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Dates</h5>
                    <form class="row g-2" action="./graph.php" method="GET">
                        <div class="col-md-12 form-floating">
                            <input type="date" class="form-control" name="date" <?php echo $value; ?> id="floatingSelect" aria-label="Floating label select example">
                            <label for="floatingSelect">Date</label>
                        </div>
                        <div class="col-md-6">
                            <?php echo $boutton; ?>
                        </div>
                    </form>
                </div>
            </div>
            <?php echo $graph; ?>
            <pre>
                <?php
                    var_dump($tab_produit);
                ?>
            </pre>
        </div>
    </div>
</body>
</html>