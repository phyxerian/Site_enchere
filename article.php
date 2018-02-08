<?php
session_start();
require 'class/Autoloader.php';
Autoloader::register();

$bdd = Database::getInstance();
$articles= $bdd->query('SELECT prix, etat, nom, id_membre, datefin FROM articles ORDER BY id_articles DESC');

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
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template" style="padding-top: 100px;">


    </div>
	<div align="center">

<?php
	$resultat = $articles->fetch() ;
	$nom = Objet::recupNom($resultat['id_membre']);
?>
	<h2><?= $resultat['nom']?> </h2>
	<p>vendeur : <?= $nom['pseudo']  ?></p>
	<p>Etat : <?= $resultat['etat'] //------------?><p> 
	<p>prix : <?= $resultat['prix'] //------------?> Euros <button type="submit" name="annonce" >Enchérir</button> <p> 
	<p>Date fin : <?= $resultat['datefin'] //------------?><p> 
	
</div>

	<a href="acceuil.php"> retour <a>
</div><!-- /.container -->

</body>
</html>
