<?php
session_start();
require '../class/Autoloader.php';
Autoloader::register();

$bdd = Database::getInstance();
$articles= $bdd->query('SELECT prix_en_cours, id_articles, etat, nom, id_membre, datefin, photo FROM articles WHERE id_articles = '. $_GET['var1'] .' ORDER BY id_articles DESC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="#">opeth</a>
			<a class="navbar-brand" href="acceuil.php">Acceuil</a>				
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template" style="padding-top: 100px;">


    </div>
	<div align="center">

<?php

	$resultat = $articles->fetch() ; //On récupère le tableau de la table article
	$nom = Objet::recupNom($resultat['id_membre']); //On récupère le pseudo du vendeur	
	$idArticle = ($resultat['id_articles']);
?>
	<form action="controller/connexion.php" method="post">
		<h2><?= $resultat['nom']?> </h2>
		<p>vendeur : <?= $nom['pseudo']  ?></p>
		<p>Etat : <?= $resultat['etat'] ?><p> 
		<p>prix : <?= $resultat['prix_en_cours'] ?> Euros <p>
		<input type="text" name="price" placeholder="Votre nouveau prix" /> <button type="submit" name="newprice" >Enchérir</button>
		<input type="hidden" name="id" value="<?php echo "".$idArticle.""?>">
		<p>Date fin : <?= $resultat['datefin'] ?><p> 
		<img src="public/article/photo/<?php echo $resultat['photo']?>" width="150">
	</form>	

</div>

	<a href="acceuil.php"> retour <a>
</div><!-- /.container -->

</body>
</html>
