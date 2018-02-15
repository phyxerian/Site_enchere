<?php require '../modele/class/Autoloader.php';
Autoloader::register();
session_start(); // à évoluer
Membre::saleFinish($_SESSION['sessionUserId']);
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
			<a class="navbar-brand" href="acceuil.php">Accueil</a>			
        </div>
    </div>
</nav>
<div class="container">
    <div class="starter-template" style="padding-top: 100px;">
    </div>

	<h1>Mes infos </h1>
	<div id="div_mesInfos" align="right">
	<form action="../controller/connexion.php" method="post">
		<table>
			<tr>
				<td>
					<button type="submit" name="suppcompte" > Supprimer votre compte </button>
				</td>
			</tr>
		</table>
	</form>	
	</div>
	<div>


	<form action="mon_compte.php" method="post">
		<p>Pseudo : <?= Membre::userIdPseudo();?> <button type="submit" name="pseudo">modifier</button><p> <!-- affichage du pseudo et bouton modifier -->
	</form>
<?php 
if(isset($_POST['pseudo']))
{
?>
<form action="../controller/connexion.php" method="post">
	<label for="prenom">Pseudo : </label>
	<input placeholder=<?=Membre::userIdPseudo()?> type="text" id="newpseudo" name="newpseudo" />
	<button type="submit" name="modpseudo">Enregistrer les modifications</button><button type="submit" name="annuler">Annuler</button>
</form>

<?php
}
?>
	<form action="mon_compte.php" method="post">
			<p>Nom : <?= Membre::userIdNom();?><p> <!-- affichage du nom pas de modif -->					
			<p>Prenom : <?= Membre::userIdPrenom();?><p> <!-- affichage du prenom pas de modif -->	
			<p>Email : <?= Membre::userIdEmail();?><p> <!-- affichage du email pas de modif -->
			<p>Changer le mot de passe : <button type="submit" name="mdp">modifier</button>
	</form>			
<?php 
if(isset($_POST['mdp']))
{
?>
<form action="../controller/connexion.php" method="post">
</br>
<label for="prenom">Entrer votre mot de passe : </label>
<input placeholder="Ancien mot de passe" type="password" id="mdpactuel" name="mdpactuel" /></br>
<label for="prenom">Votre nouveau mot de passe : </label>
<input placeholder="Nouveau mot de passe" type="password" id="newmdp" name="newmdp" /></br>
<label for="prenom">Veuillez confirmer votre mot de passe : </label>
<input placeholder="Nouveau mot de passe" type="password" id="newmdp1" name="newmdp1" /></br>
<button type="submit" name="modmdp">Enregistrer les modifications</button><button type="submit" name="annuler">Annuler</button>
</form>
<?php
}

?>
			
	</div>
	<div>
	<h1> Mon compte</h1>
	</br>
	<form action="../controller/connexion.php" method="post">
	<p>Mes crédits : <?= Membre::userIdCredit();?><p>
	<label for="credit">Créditer votre compte : </label>	
	<input placeholder="Ajouter des crédits" type="text" id="credit" name="credit" /></br>
	<button type="submit" name="ajout">Ajouter</button>

	
	</form>
	
	</div>
	<div> <!-- Mes annonces en cours -->
	<h1> Mes annonces </h1>
<?php	echo Objet::myArticle();?>	
	</div>
	<div>
	<h1>Mes acquisitions</h1>
	<?php Objet::acquisition($_SESSION['sessionUserId']);?>
	</div>
	<div>
	<h1>Mes ventes</h1>
	
	</div>
	
</div>
</body>
</html>