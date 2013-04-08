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
        //On récupère la méthode
        echo 'lol';
        if(!empty($_POST)){
            var_dump($_POST);
        }

        //


    ?>
    <div class="container">
        
        <header>
            <div class="page-header">
              <h1>Formulaire d'ajout d'un participant :</h1></div>
        </header>
        
        <div class="row">
            <div class="span4">
                   <form method="POST" action="" name="participant" class="form-horizontal">

                  <div class="control-group">
                    <label class="control-label" for="inputNom">Nom</label>
                    <div class="controls">
                      <input type="text" id="inputNom" placeholder="Veuilliez saisir votre Nom">
                    </div>
                  </div>

                 <div class="control-group">
                    <label class="control-label" for="inputPrenom">Prenom</label>
                    <div class="controls">
                      <input type="text" id="inputPrenom" placeholder="Veuilliez saisir votre Prenom">
                    </div>
                  </div>

                 <div class="control-group">
                    <label class="control-label" for="inputSexe">Sexe</label>
                    <div class="controls">
                        <select name="inputSexe">
                            <option value="F">Femme</option>
                            <option value="M">Homme</option>
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
                <tr>
                    <td>1</td>
                    <td>La rosa</td>
                    <td>Kévin</td>
                    <td>M</td>
                </tr>
            </tbody>
        </tr>
        </table>
    </div>
    </body>
</html>