<?php
    $value_debut = 'value="';
    $value_fin = 'value="';
    $boutton = '';
    $display_note = '';

    $selected = '<option value="boissons">Boissons</option>
                <option value="repas">Repas</option>
                <option value="rechargement">Rechargement</option>';

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

    if(!empty($_GET["date_start"]) && !empty($_GET["date_end"]) && !empty($_GET["detail"])){
        $boutton = '<button type="submit" class="btn btn-primary">Envoyer</button>';

        $display_note = '<div class="col-md-12">
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Recette</h5>
                            <div class="alert alert-success" role="alert">
                                Totale : 0€
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                Repas : 0€
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                Boisson : 0€
                            </div>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body">
                            <h5 class="card-title">Rechargement</h5>
                            <div class="alert alert-warning" role="alert">
                                Totale : 0€
                            </div>
                        </div>
                    </div>
              </div>';

        if($_GET["detail"] == "boissons"){
            $selected = '<option value="boissons" selected>Boissons</option>
                        <option value="repas">Repas</option>
                        <option value="rechargement">Rechargement</option>';
            $tab = '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>';

        }elseif($_GET["detail"] == "repas"){
            $selected = '<option value="boissons">Boissons</option>
                        <option value="repas" selected>Repas</option>
                        <option value="rechargement">Rechargement</option>';

            $tab = '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>';

        } elseif($_GET["detail"] == "rechargement"){
            $selected = '<option value="boissons">Boissons</option>
                        <option value="repas">Repas</option>
                        <option value="rechargement" selected>Rechargement</option>';

            $tab = '<table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Prenom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mark</td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                    </tr>
                    <tr>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>';

        }

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
                            <div class="col-md-12 form-floating">
                                <select class="form-select" aria-label="Default select example" name="detail" id="floatingSelect" aria-label="Floating label select example">
                                    <?php echo $selected; ?>
                                </select>
                                <label for="floatingSelect">Détails des transactions</label>
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
                <pre>
                    <?php
                        var_dump($_GET);
                    ?>
                </pre>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>