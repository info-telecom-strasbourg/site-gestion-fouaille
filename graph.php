<?php
    require 'connect.php';

    $value = 'value="';
    $boutton = '';
    $graph = '';
    $donnees_json = '';
    $tab_produit = array();
    $tab = array();

    if(!empty($_GET["date"]) ){
        $date_debut = $_GET["date"] . ' 17:30:00';
        $date_fin = $_GET["date"] . ' 23:00:00';
        $value = $value . $_GET["date"] . '"';

        $boutton = '<button type="submit" class="btn btn-primary">Envoyer</button>';

        $graph = '<div id="chart_div" style="width: 100%; height: 600px;"></div>';

        $sql_tab_produit = 'SELECT DISTINCT produit FROM Commande WHERE date_histo >= "'. $date_debut . '" AND date_histo <= "' . $date_fin . '" AND delta < 0';

        if ($pdo->query($sql_tab_produit) === false) {
            var_dump($pdo->errorInfo());
        } else {
            foreach ($pdo->query($sql_tab_produit) as $row) {
                $tab_produit[$row['produit']] = 0;
            }
            // Conversion des chaînes de date en objets DateTime
            $date_debut_obj = new DateTime($date_debut);
            $date_fin_obj = new DateTime($date_fin);

            // Pas de 15 minutes
            $pas = new DateInterval('PT15M');

            // Boucle qui incrémente la date de départ jusqu'à la date de fin en pas de 15 minutes
            $date = $date_debut_obj;
            while ($date <= $date_fin_obj) {

                $current_tab = array();

                foreach ($tab_produit as $produit) {
                    $tab[$date->format('H:i')] = $tab_produit;
                }

                $sql = 'SELECT produit, SUM(amount) AS total FROM Commande WHERE date_histo >= "'. $date_debut . '" AND date_histo <= "' . $date->format('Y-m-d H:i:s') . '" AND delta < 0 GROUP BY produit';

                if ($pdo->query($sql) === false) {
                    var_dump($pdo->errorInfo());
                } else {
                    foreach ($pdo->query($sql) as $row) {
                        $tab[$date->format('H:i')][$row['produit']] = $row['total'];
                    }
                }

                // Incrémente la date de 15 minutes
                $date = $date->add($pas);
            }


        }


        $donnees_json = json_encode($tab); // Convertit le tableau PHP en JSON pour le passer à JavaScript

    }else{
        $value = '';

        $graph = '<div id="chart_div" style="width: 100%; height: 600px;"></div>';

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
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Temps');

            var donnees_json = JSON.parse('<?php echo $donnees_json; ?>');

            for (var produit in donnees_json[Object.keys(donnees_json)[0]]) {
                data.addColumn('number', produit);
            }

            for (var temps in donnees_json) {
                var row = [temps];
                for (var produit in donnees_json[temps]) {
                    row.push(parseInt(donnees_json[temps][produit]));
                }
                data.addRow(row);
            }

            var options = {
                title: 'Commandes',
                curveType: 'function',
                legend: { position: 'bottom' }
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
        </div>
    </div>
</body>
</html>