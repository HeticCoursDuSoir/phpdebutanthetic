<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>php débutant hetic</title>
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
    
    <?php
        $nameError = false; $firstnameError = false; $sexeError = false;
        // On récupère la méthode POST dans un tableau associatif de type [Clé] <=> [Valeur]. 
        // La clé est le name="" de l'input et sa valeur est value="".
        // Si mon tableau associatif est diférent de vide alors je rentre dans mon test.
        if(!empty($_POST)){

            //var_dump($_POST); // Rappel : var_dump Permet d'afficher le contenu du tableau.
            // exit() ou die () // Rappel : permet de stoper le programme à cet instant.

            // si les clés dans mon tableau sont diférentes de vide alors je rentre dans mon test
            if(!empty($_POST['inputNom']) && !empty($_POST['inputPrenom']) && !empty($_POST['inputSexe'])){

                // Je crée une connexion à la base de donnée
                $mysqli = new mysqli("localhost", "root", "root", "confhetic",3306);

                //modification de l'encodage pour la gestion des accents au cas où la base de données est mal encodée 
                $mysqli->set_charset("utf8");

                // on affiche une erreur si la connexion ne fonctionne pas
                if ($mysqli->connect_errno) {
                    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }

                // Je déclare une chaîne de caractères qui est ma requête SQL
                // cette requête réalise l'insertion d'un nouveau participant
                // INSERT INTO [Ma table] ([les champs que je souhaite remplir avec des virgules])
                // VALUES (leur corespondance avec des virgules. Ne pas oublier les "" pour les champs de type caractères).
                $requeteSQL = "INSERT INTO participant (participant_prenom, participant_nom, participant_sexe) VALUES ('".$_POST['inputNom']."','".$_POST['inputPrenom']."','".$_POST['inputSexe']."')";
                /* Ressource pour faire du SQL */
                //http://www.grafikart.fr/formation/mysql/insert-into
                //http://www.w3schools.com/sql/sql_insert.asp

                // Je donne l'ordre à ma base de données de récupèrer mes données définies dans $requeteSQL.
                $result = $mysqli->query($requeteSQL);

                // Si dans $result, j'ai quelque chose de différent qu'un tableau associatif qui corespond à TRUE (vrai) alors je rentre dans mon test.
                if (!$result) {
                    // j'affiche l'erreur de retour 
                    printf("%s\n", $mysqli->error); // printf fonctionne comme var_dump, il affiche juste moins de détail !!
                    exit(); // je stop mon programme
                }else{
                    // J'affiche une chaine de caractères avec du HTML qui affiche que j'ai réussi l'insertion
                    echo "<div class='alert alert-success pagination-centered'>Le formulaire est valide</div>";
                } 
            } // sinon (si les clés du tableau sont vides)
            else{
                // j'affiche un message : le formulaire n'est pas valide
                echo "<div class='alert alert-error pagination-centered'>Le formulaire n'est pas valide</div>";
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

                  <div class="control-group <?php if(isset($nameError) && $nameError) echo 'error'; ?>">
                    <label class="control-label" for="inputNom">Nom</label>
                    <div class="controls">
                      <input type="text" id="inputNom" name="inputNom" placeholder="Veuillez saisir votre Nom" value="<?php if(isset($_POST['inputNom'])) echo $_POST['inputNom']; ?>" >
                    </div>
                  </div>

                 <div class="control-group <?php if(isset($firstnameError) && $firstnameError) echo 'error'; ?>">
                    <label class="control-label" for="inputPrenom">Prenom</label>
                    <div class="controls">
                      <input type="text" id="inputPrenom" name="inputPrenom" placeholder="Veuillez saisir votre Prenom" value="<?php if(isset($_POST['inputPrenom'])) echo $_POST['inputPrenom']; ?>"  >
                    </div>
                  </div>

                 <div class="control-group  <?php if(isset($sexeError) && $sexeError) echo 'error'; ?>">
                    <label class="control-label" for="inputSexe">Sexe</label>
                    <div class="controls">
                        <select name="inputSexe">
                            <option value="F" <?php if(isset($_POST['inputSexe']) && $_POST['inputSexe']=='F') echo 'selected'; ?>>Femme</option>
                            <option value="M" <?php if(isset($_POST['inputSexe']) && $_POST['inputSexe']=='M') echo 'selected'; ?>>Homme</option>
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
            //Récupère les enregistrement des participants dans la base de données

            //connexion à la base de données
            $mysqli = new mysqli("localhost", "root", "root", "confhetic",3306);
           
            // définit l'encodage de rendu
            $mysqli->set_charset("utf8");

            // je crée ma requête SQL
            $requeteSql = "SELECT * FROM participant";
            
            // j'exécute ma requête SQL
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
                <?php foreach($result as $participant): ?>
                 <tr>
                            <td><?php echo $participant['participant_id'] ?></td>
                            <td><?php echo $participant['participant_nom'] ?></td>
                            <td><?php echo $participant['participant_prenom'] ?></td>
                            <td><?php echo $participant['participant_sexe'] ?></td>
                        </tr>  
                <?php endforeach;?>
            </tbody>
        </tr>
        </table>
    </div>
    </body>
</html>