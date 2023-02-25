<?php
    require 'connect.php';

    $value_debut = 'value="';
    $value_fin = 'value="';
    $boutton = '';
    $display_note = '';
    $tab = '';

    if(!empty($_GET["date_start"]) ){
        $debut = str_replace("T", " ", $_GET["date_start"]);
        $value_debut = $value_debut . $_GET["date_start"] . '"';
    }else{
        $value_debut = '';
    }

    if(!empty($_GET["date_end"])){
        $fin = str_replace("T", " ", $_GET["date_end"]);
        $value_fin = $value_fin . $_GET["date_end"] . '"';
    }else{
        $value_fin = '';
    }

    if(!empty($_GET["date_start"]) && !empty($_GET["date_end"])){
        $boutton = '<button type="submit" class="btn btn-primary">Envoyer</button>';

        $sql_tab = 'SELECT nom, prenom, delta, type_produit, produit, date_histo, amount FROM Commande WHERE date_histo > "'. $debut . '" AND date_histo < "' . $fin . '" ORDER BY date_histo DESC';

        if ($pdo->query($sql_tab) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $tab = '<table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Type de produit</th>
                                <th scope="col">Produit</th>
                                <th scope="col">Date</th>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>';

            foreach ($pdo->query($sql_tab) as $row) {
                $tab = $tab . '<tr>
                                <td>' . $row['nom'] . '</td>
                                <td>' . $row['prenom'] . '</td>
                                <td>' . $row['delta'] . '</td>
                                <td>' . $row['type_produit'] . '</td>
                                <td>' . $row['produit'] . '</td>
                                <td>' . $row['date_histo'] . '</td>
                                <td>' . $row['amount'] . '</td>
                            </tr>';
            }
            $tab = $tab . '</tbody>
                    </table>';
        }

        $sql_total = 'SELECT -SUM(delta) AS total FROM Commande WHERE date_histo > "'. $debut . '" AND date_histo < "' . $fin . '" AND delta < 0';

        if ($pdo->query($sql_total) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $total = $pdo->query($sql_total)->fetch()['total'];
        }

        $sql_boisson = 'SELECT -SUM(delta) AS total FROM Commande WHERE date_histo > "'. $debut . '" AND date_histo < "' . $fin . '" AND type_produit = "menu-soirees"';

        if ($pdo->query($sql_boisson) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $total_boisson = $pdo->query($sql_boisson)->fetch()['total'];
        }

        $sql_repas = 'SELECT -SUM(delta) AS total FROM Commande WHERE date_histo > "'. $debut . '" AND date_histo < "' . $fin . '" AND type_produit = "menu-midi"';

        if ($pdo->query($sql_repas) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $total_repas = $pdo->query($sql_repas)->fetch()['total'];
        }

        $sql_rechargement = 'SELECT SUM(delta) AS total FROM Commande WHERE date_histo > "'. $debut . '" AND date_histo < "' . $fin . '" AND delta > 0';

        if ($pdo->query($sql_rechargement) === false) {
            var_dump($pdo->errorInfo());
        } else {
            $total_rechargement = $pdo->query($sql_rechargement)->fetch()['total'];
        }

        $display_note = '<div class="col-md-12">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Recette</h5>
                            <div class="alert alert-success" role="alert">Totale : ' . $total . '€</div>
                            <div class="alert alert-secondary" role="alert">Repas : ' . $total_repas . '€</div>
                            <div class="alert alert-secondary" role="alert">Boisson : ' . $total_boisson . '€</div>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Rechargement</h5>
                            <div class="alert alert-warning" role="alert">Totale : ' . $total_rechargement . '€</div>
                        </div>
                    </div>
              </div>';

    }else{
        $boutton = '<button type="submit" class="btn btn-secondary">Envoyer</button>';
    }


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compte fouaille</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<header>
    <?php include 'navbar.php'; ?>
</header>
<body>
    <div class="container-fluid">
        <div class="row g-20">
            <div class="col-4">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Dates</h5>
                        <form class="row g-2" action="./index.php" method="GET">
                            <div class="col-md-6 form-floating">
                                <input type="datetime-local" class="form-control" name="date_start" <?php echo $value_debut; ?> id="floatingSelect" aria-label="Floating label select example">
                                <label for="floatingSelect">Date de début</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="datetime-local" class="form-control" name="date_end" <?php echo $value_fin; ?> id="floatingSelect" aria-label="Floating label select example">
                                <label for="floatingSelect">Date de fin</label>
                            </div>
                            <div class="col-md-6">
                                <?php echo $boutton; ?>
                            </div>
                        </form>
                    </div>
                </div>
                <?php echo $display_note; ?>
            </div>
            <div class="col">
                <?php echo $tab; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>