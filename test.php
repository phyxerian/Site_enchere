<?php require 'modele/class/Autoloader.php';
Autoloader::register();
session_start(); // à évoluer

$bdd = Database::getInstance();
$membres= $bdd->query('SELECT * FROM membres WHERE membres_id ="'.$_SESSION['sessionUserId'].'" ');
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
	
	
	
		<script type="text/javascript"> 

//Retourne l'objet XMLHttpRequest Instancié

function getXMLHttpRequest() { 
var xhr = null; 
if (window.XMLHttpRequest || window.ActiveXObject) { 
if (window.ActiveXObject) { 
try { 
xhr = new ActiveXObject("Msxml2.XMLHTTP"); 
} catch(e) { 
xhr = new ActiveXObject("Microsoft.XMLHTTP"); 
} 
} else { 
xhr = new XMLHttpRequest(); 
} 
} else { 
alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest..."); 
return null; 
} 
return xhr; 
} 

function suppCompte() { 
  var xmlHttp = getXMLHttpRequest(); 
  
  if (xmlHttp == null){ 
      alert("Votre navigateur ne supporte pas les requêtes HTTP."); 
      return false; }
	  
  // fonction à exécuter dès réception de la réponse 
  
  xmlHttp.onreadystatechange = function(){ 
			if (xmlHttp.readyState==4 && xmlHttp.status==200) 
			document.getElementById('div_suppValid').innerHTML = xmlHttp.responseText; 
		}
  
	xmlHttp.open("POST","test1.php",true); 
	xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
	xmlHttp.send("champRecherche="+document.getElementById("champRecherche").value); 
}
</script>	
<SCRIPT LANGUAGE="JavaScript">
function confirmation() {
var msg = "Êtes-vous sur de vouloir supprimer ce truc ?";
if (confirm(msg))
location.replace(tonscript.php);
}
</SCRIPT> 	

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

	<h1>Mes infos </h1>
	<div align="right">
		<table>
			<tr>
				<td>
					<button type="submit" name="suppcompte" onClick="confirmaton();"> Supprimer votre compte </button>
				</td>
			</tr>
		</table>
		<form action= "test1.php" method="post">
		<tr>
                <td>
                    <label for="ddn">Date de naissance : </label> <!--- vente en ligne interdit aux mineurs -->
                </td>
                <td>
                    <input type="date" id="ddn" name="ddn"> <!--- pas de placeholder pour un type date -->
                </td>
            </tr>
			<button type="submit" name="envoi" > OK </button>
		</form>	
	</div>
	<div id="div_suppCompte"></div>
	<div>
<div align="right">	

</div>	

	<form action="mon_compte.php" method="post">
<?php 	
$resultat = $membres->fetch();
?>	
<p>Pseudo : <?= $resultat['pseudo']?> <button type="submit" name="pseudo">modifier</button><p> <!-- affichage du pseudo et bouton modifier -->
<?php 
if(isset($_POST['pseudo']))
{
?>

<label for="prenom">Pseudo : </label>
<input placeholder=<?=$resultat['pseudo']?> type="text" id="newpseudo" name="newpseudo" />
<button type="submit" name="modpseudo">Enregistrer les modifications</button><button type="submit" name="annuler">Annuler</button>


<?php
}
?>
			<p>Nom : <?= $resultat['nom']?><p> <!-- affichage du nom pas de modif -->					
			<p>Prenom : <?= $resultat['prenom']?><p> <!-- affichage du prenom pas de modif -->	
			<p>Email : <?= $resultat['email']?><p> <!-- affichage du email pas de modif -->
			<p>Changer le mot de passe : <button type="submit" name="mdp">modifier</button>
			
<?php 
if(isset($_POST['mdp']))
{
?>
</br>
<label for="prenom">Entrer votre mot de passe : </label>
<input placeholder="Ancien mot de passe" type="password" id="mdpactuel" name="mdpactuel" /></br>
<label for="prenom">Votre nouveau mot de passe : </label>
<input placeholder="Nouveau mot de passe" type="password" id="newmdp" name="newmdp" /></br>
<label for="prenom">Veuillez confirmer votre mot de passe : </label>
<input placeholder="Nouveau mot de passe" type="password" id="newmdp1" name="newmdp1" /></br>
<button type="submit" name="modmdp">Enregistrer les modifications</button><button type="submit" name="annuler">Annuler</button>
<?php
}

	if(isset($_POST['modmdp'])) //Vérification qu'on a cliqué sur le boutton
	{

		if(!empty($_POST['mdpactuel']) && !empty($_POST['newmdp']) && !empty($_POST['newmdp1'])) //Si les champs ne sont pas vides
		{
			$rep=Membre::userPass($_POST['mdpactuel']); //appel de la fonction qui permet de vérifier que le mot de passe écrit correspond à celui en bdd

			if($rep === true) //Si c'est vraie
			{
			
					if($_POST['newmdp'] === $_POST['newmdp1']) //et que les deux mdp sont identiques
					{

					$newmdp = Membre::changePass($_POST['newmdp']); //function pour changer le mdp en bdd
					echo "Le mot de passe à été changé.";
					}
					else											//Sinon erreur
					{
					echo "Les mots de passes ne sont pas identiques.";
					}
			}	
			else
			{
			echo"Tous les champs ne sont pas remplies";
			}
			
		}
	}	

?>
			
	</form>
	</div>
	<div>
	<h1> Mon compte</h1>
	</br>
	<form action="../controller/connexion.php" method="post">
	<p>Mes crédits : <?= $resultat['credit']?><p>
	<label for="credit">Créditer votre compte : </label>	
	<input placeholder="Ajouter des crédits" type="text" id="credit" name="credit" /></br>
	<button type="submit" name="ajout">Ajouter</button>

	
	</form>
	
	</div>
	<div> <!-- Mes annonces en cours -->
	<h1> Mes annonces </h1>
<?php 
	echo Objet::myArticle();

?>	
	</div>
	
</div>
</body>
</html>