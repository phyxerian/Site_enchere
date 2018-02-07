<?php
			if (!isset($choix))
			{
				$choix = "livre";
				
			}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">
    <title> Création d'annonce </title>
	
	<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">Opeth</a>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter-template" style="padding-top: 100px;">


    </div>


</div><!-- /.container -->

<h1> Créer une annonce</h1>

    <form action="connexion.php" method="post">
        <table> <!--- On utilise le tableau et non le br pour que tous les input soient bien alignés. -->
           <tr>
			<tr>
                <td>
                    <label for="nom">Nom : </label>
                </td>
                <td>
                    <input placeholder="Le nom de l'article" type="text" id="nom" name="nom" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="desc">Description : </label>
                </td>
                <td>
                    <input placeholder="Description" type="text" id="desc" name="desc" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prix">Prix : </label>
                </td>
                <td>
                    <input placeholder="Prix de départ" type="text" id="prix" name="prix" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="etat">Etat : </label>
                </td>
                <td>
                    Parfait : <input type="radio" id="etat" name="etat" value ="parfait" />
                    Très bon :	<input type="radio" name="etat" value ="tb" />
					Bon :	<input type="radio" name="etat" value ="bon" />
					Moyen :	<input type="radio" name="etat" value ="moyen" />
					Mauvais :	<input type="radio" name="etat" value ="mauvais" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="cat">Categorie : </label>
                </td>
                <td>
				<select name="choix">
					<option value="1"  <?php if($choix === "1"){ echo "selected"; }?> >Livres, BD</option>
					<option value="2" <?php if($choix === "2"){ echo "selected"; }?> >Musique, CD</option>
					<option value="3" <?php if($choix === "3"){ echo "selected"; }?> >DVD, Blu-Ray</option>
					<option value="4" <?php if($choix === "4"){ echo "selected"; }?> >Jeux vidéo, console</option>
					<option value="5"  <?php if($choix === "5"){ echo "selected"; }?> >Téléphonie, Tablettes</option>
					<option value="6" <?php if($choix === "6"){ echo "selected"; }?> >Informatique, Logiciels</option>
					<option value="7" <?php if($choix === "7"){ echo "selected"; }?> >Image, Son</option>
					<option value="8" <?php if($choix === "8"){ echo "selected"; }?> >Maison, Electro, Deco</option>		
					<option value="9" <?php if($choix === "9"){ echo "selected"; }?> >Brico, Jardin, Animalerie </option>
					<option value="10" <?php if($choix === "10"){ echo "selected"; }?> >Sports, Loisirs</option>
					<option value="11"  <?php if($choix === "11"){ echo "selected"; }?> >Mode, Beauté</option>
					<option value="12" <?php if($choix === "12"){ echo "selected"; }?> >Jouets, Enfant</option>
					<option value="13" <?php if($choix === "13"){ echo "selected"; }?> >Auto, Moto</option>
					<option value="14" <?php if($choix === "14"){ echo "selected"; }?> >Art et collection</option>						
				</select> 
                </td>
            </tr>				
                <td>
                    </br></br>
                    <button type="submit" name="annonce" >Créer une annonce</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>


