<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Dailymotion Jobs</title>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
    
    <?php
        //On récupère la méthode POST dans un tableau associatif clé = la valeur dans name de l'input // Valeur : valeur de l'input
        if(!empty($_POST)){
            //var_dump($_POST); //Permet d'afficher le contenu du tableau
            if(!empty($_POST['inputNom']) && !empty($_POST['inputPrenom']) && !empty($_POST['inputSexe'])){
                $nameError = false; $firstnameError = false; $sexeError = false;
                echo "Le formulaire est valide";
                // Je crée une connexion a la base de donnée
                $mysqli = new mysqli("localhost", "root", "root", "confhetic",3306);

                //modification de l'encodage pour la gestion des accents
                $mysqli->set_charset("utf8");

                // on affiche une erreur si la connexion ne fonctionne pas
                if ($mysqli->connect_errno) {
                    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                $requeteSQL = "INSERT INTO participant (participant_prenom, participant_nom, participant_sexe) VALUES ('".$_POST['inputNom']."','".$_POST['inputPrenom']."','".$_POST['inputSexe']."')";

                $result = $mysqli->query($requeteSQL);

                if (!$result) {
                    printf("%s\n", $mysqli->error);
                    exit();
                }

            }else{
                if(empty($_POST['inputNom'])) $nameError = true;
                if(empty($_POST['inputPrenom'])) $firstnameError = true;
                if(empty($_POST['inputSexe'])) $sexeError = true;
                echo "Le formulaire n'est pas valide";
            }
        }


    ?>
    <div class="container">
        
        <header>
            <div class="page-header">
              <h1>Formulaire d'ajout d'un participant :</h1></div>
        </header>
        
        <div class="row">
            <div class="span4">
                   <form method="POST" action="" name="participant" class="form-horizontal">

                  <div class="control-group <?php if($nameError) echo 'error'; ?>">
                    <label class="control-label" for="inputNom">Nom</label>
                    <div class="controls">
                      <input type="text" id="inputNom" name="inputNom" placeholder="Veuilliez saisir votre Nom" value="<?php if($_POST['inputNom']) echo $_POST['inputNom']; ?>" >
                    </div>
                  </div>

                 <div class="control-group <?php if($firstnameError) echo 'error'; ?>">
                    <label class="control-label" for="inputPrenom">Prenom</label>
                    <div class="controls">
                      <input type="text" id="inputPrenom" name="inputPrenom" placeholder="Veuilliez saisir votre Prenom" value="<?php if($_POST['inputPrenom']) echo $_POST['inputPrenom']; ?>"  >
                    </div>
                  </div>

                 <div class="control-group  <?php if($sexeError) echo 'error'; ?>">
                    <label class="control-label" for="inputSexe">Sexe</label>
                    <div class="controls">
                        <select name="inputSexe">
                            <option value="F" <?php if($_POST['inputSexe'] && $_POST['inputSexe']=='F') echo 'selected'; ?>>Femme</option>
                            <option value="M" <?php if($_POST['inputSexe'] && $_POST['inputSexe']=='M') echo 'selected'; ?>>Homme</option>
                        </select>
                    </div>
                  </div>

                  <div class="control-group">
                    <div class="controls">
                      <button type="submit" class="btn">Envoyer</button>
                    </div>
                  </div>

                </form>  
            </div>
        </div>

        <header>
            <div class="page-header">
              <h1>Liste des participant :</h1></div>
        </header>

        <?php
            //Récupère les enregistrement des participants dans la base de donnée

            //connexion à la base de donnée
            $mysqli = new mysqli("localhost", "root", "root", "confhetic",3306);
           
            // définit l'encodage de rendu
            $mysqli->set_charset("utf8");

            // je crée ma requete sql
            $requeteSql = "SELECT * FROM participant";
            
            // j'exécute ma requete sql
            $result = $mysqli->query($requeteSql);
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Sexe</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['participant_id'] ?></td>
                    <td><?= $row['participant_nom'] ?></td>
                    <td><?= $row['participant_prenom'] ?></td>
                    <td><?= $row['participant_sexe'] ?></td>
                </tr>
                <?php endwhile?>
            </tbody>
        </tr>
        </table>
    </div>
    </body>
</html>