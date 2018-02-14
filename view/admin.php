<?php require '../modele/class/Autoloader.php';
Autoloader::register();
session_start(); // à évoluer

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

    <title> Mon compte</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="home.php">Opeth</a>
			<a class="navbar-brand" href="acceuil.php">Acceuil</a>			
        </div>
    </div>
</nav>
<div class="container">
    <div class="starter-template" style="padding-top: 100px;">


    </div>

	<h1>Page d'administration</h1>
	<div align="right">
		<form action="../controller/connexion.php" method="post"> <!-- bouton déconnexion -->
		<button	type="submit" name="supprimer_sess">Déconnexion</button> <!-- //déconnexion de la session membre -->
		</form>
	</div>

		<div align="left">	
		
		<h2> Categories </h2>
		
		<!--<form action="../controller/connexion.php" method ="post">-->
		<input type="button" value="voirCat" onClick="Admin::viewCat();"></br> 
		<!--<button type="submit" name="voirCat"> Voir </button></br>-->
		<button type="submit" name="addCat"> Ajouter </button></br>
		<button type="submit" name="suppCat"> Supprimer </button></br>
		<!--</form>-->
		
		<h2> Membres </h2>
		
		<form action="connexion.php" method ="post">
		
		</form>		
		
		<h2> Annonces </h2>		
		
		<form action="connexion.php" method ="post">
		
		</form>		
		
		</div>	


	
</div>
</body>
</html>