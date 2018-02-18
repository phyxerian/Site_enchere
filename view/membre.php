<?php
session_start();
require '../modele/class/Autoloader.php';
Autoloader::register();

$bdd = Database::getInstance();
$membre= $bdd->query('SELECT membres_id, pseudo, nom, prenom FROM membres WHERE membres_id = '. $_GET['var1'] .' ORDER BY nom');

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
<style type="text/css">
	<?php include('../public/css/css.css'); ?>
</style>	
    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="home.php">Opeth</a>
			<a class="navbar-brand" href="acceuil.php">Accueil</a>				
        </div>
    </div>
</nav>

<div class="container">
    <div class="starter-template" style="padding-top: 100px;">


    </div>
	<div align="center">

<?php

	$resultat = $membre->fetch() ; //On récupère le tableau de la table article
?>
	<form action="../controller/connexion.php" method="post">
		<h2><?= $resultat['nom']?> </h2>
		<p>Pseudo : <?= $resultat['pseudo']  ?></p>
		<p>Nom : <?= $resultat['nom'] ?><p> 
		<p>Prenom : <?= $resultat['prenom'] ?> <p>

		<?php $idAdmin = Admin::coAdmin($_SESSION['sessionUserId']);
		FormAdmin::buttonSuppMembre($idAdmin, $resultat['membres_id']);
		?>
	</form>	

</div>

	<a href="acceuil.php"> retour <a>
</div><!-- /.container -->

</body>
</html>
