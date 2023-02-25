<?php
    require 'connect.php';

    $value = 'value="';
    $boutton = '';
    $graph = '';
    $tab_produit = '';
    $tab_graph = '';
    $donnees_json = '';
    $tab = '';

    if(!empty($_GET["date"]) ){
        $date_debut = $_GET["date"] . ' 17:00:00';
        $date_fin = $_GET["date"] . ' 23:00:00';
        $value = $value . $_GET["date"] . '"';

        $boutton = '<button type="submit" class="btn btn-primary">Envoyer</button>';

        $graph = '<div id="chart_div" style="width: 100%; height: 600px;"></div>';

        $start_date = DateTime::createFromFormat('Y-m-d H:i:s', $_GET["date"]. ' 22:00:00');
        $end_date = DateTime::createFromFormat('Y-m-d H:i:s', $date_fin);

        $current_date = $start_date;

        $tab = array();

        while ($current_date <= $end_date) { // Création du tableau des dates pour le graphique
            $sql_graph = 'SELECT produit, -SUM(delta) AS recette FROM Commande WHERE date_histo > "'. $date_debut . '" AND date_histo < "' . $current_date->format('Y-m-d H:i:s') . '" AND delta < 0 GROUP BY produit';

            if ($pdo->query($sql_graph) === false){
                var_dump($pdo->errorInfo());
            } else {
                $tab_graph = $pdo->query($sql_graph)->fetchAll(PDO::FETCH_ASSOC);
            }

            $tab['' . $current_date->format('Y-m-d H:i:s') . ''] = $tab_graph;
            $current_date->add(new DateInterval('PT15M'));
        }

        $donnees_json = json_encode($tab);

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
            // Création d'une table de données
            var data = new google.visualization.DataTable();

            data.addColumn('string', 'Temps');
            data.addColumn('string', 'Produit');
            data.addColumn('number', 'Recette');

            var donnees_js = JSON.parse('<?php echo $donnees_json; ?>');

            console.log(donnees_js);

            for (var key in donnees_js){

                var heure = key.split(" ")[1];


                for (var i = 0; i < donnees_js[key].length; i++) {
                    var produit = donnees_js[key][i].produit;
                    var recette = parseFloat(donnees_js[key][i].recette);

                    data.addRow([heure, produit, recette]);

                    console.log(data);
                }
            }


            var options = {
                title: 'Recette en fonction du temps',
                hAxis: {title: 'Temps',  titleTextStyle: {color: '#333'}},
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
                    var_dump($tab);
                    var_dump($donnees_json);
                ?>
            </pre>
        </div>
    </div>
</body>
</html>