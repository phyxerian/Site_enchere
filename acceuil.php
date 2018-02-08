<?php
require 'class/Autoloader.php';
Autoloader::register();
session_start(); // à évoluer

// Déconnexion d'une Session

if(isset($_POST['supprimer_sess']))
{

    $_SESSION[] = array();

    if (ini_get("session.use_cookies")) // détruit les variables de cookies
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    header ('Location: index.php');
	
}

// Barre de recherche
$bdd = Database::getInstance();
$articles= $bdd->query('SELECT nom FROM articles ORDER BY id_articles DESC');


if(isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
	
	$bdd = Database::getInstance();
	$q = htmlspecialchars($_GET['recherche']);
	$articles = $bdd->query('SELECT nom FROM articles WHERE nom LIKE "%'.$q.'%" ORDER BY id_articles DESC');
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

<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <title> Page acceuil membre </title>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="home.php">Opeth</a>
			<a class="navbar-brand" href="mon_compte.php">Mon compte</a>
			<a class="navbar-brand" href="annonce.php">Mettre une annonce</a>
        </div>
    </div>
</nav>

<div class="container">

    <div class="starter-template" style="padding-top: 100px;">
<?php echo 'test'.$_SESSION['sessionUserId']; ?> <!--test pour connaitre le num de l'id en cours-->

    </div>


</div><!-- /.container -->

<h1> Bonjour <?php 
echo Membre::userId();
 ?> </h1>
<div align="right">
<form action="acceuil.php" method="post"> <!-- bouton déconnexion -->
    <button	type="submit" name="supprimer_sess">Déconnexion</button> <!-- //déconnexion de la session membre -->
</form>
</div>

<form method="GET">					<!--barre de recherche -->
	<input type="search" name="recherche" placeholder="Recherche..."/>
	<input type="submit" value="Valider">
</form>

<div align="center">
	<?php if($articles->rowCount() > 0) { ?>
	<!--<ul>-->
	<?php while($resultat = $articles->fetch()) {
	//$nom = Objet::recupNom($resultat['id_membre']);
	?>
	<a href="article.php"><?= $resultat['nom']?> <a><!--nom de l'article-->
	<?php /*<p>vendeur : <?= $nom['pseudo']  ?></p>
	<p>prix : <?= $resultat['prix'] //------------?> Euros<p>
	<p>Date fin : <?= $resultat['datefin'] //------------?><p>
	<?php*/ } ?>
	<!--</ul>-->
	<?php }else {
	if(empty($_GET['recherche'])) //Si recherche est vide on affiche rien
	{}
	else{	?>
	Aucun résultat pour <?= $q ?>... 
	<?php }} ?>
</div>
</body>
</html>