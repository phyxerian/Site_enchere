<!DOCTYPE html>
<?php
require 'class/Autoloader.php';
Autoloader::register();
Database::getInstance();

/*
$prenom = htmlspecialchars($_POST['prenom']);
$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['email']);
$mdp = sha1($_POST['nom']);

$prenomlength = strlen($prenom);

if($pseudolength <=255)
{

}
else
{
$erreur = "Votre pseudo ne doit pas dépasser 255 caractères.";
}
$nomlength = strlen($nom);
$prenomlength = strlen($prenom);
*/

//PARTIE CONNEXION

if(isset($_POST['formconnexion']))
{

    if (!empty($_POST['login']) && !empty($_POST['mdpco']))
    {
			$pass_hache = sha1($_POST['mdpco']); //hachage du mdp pour le retrouver dans la bdd
		
			$bdd = Database::getInstance(); // Obtention de l'instance de base de données
			$reponse = $bdd->prepare('SELECT email FROM membres WHERE email = "' . $_POST['login'] . '" '); // On vérifie que le post mail existe dans la bdd
			$reponse->execute();
            $mail = $reponse->fetch();
             
            $reponse1 = $bdd->prepare('SELECT mot_de_passe FROM membres WHERE mot_de_passe = "' . $pass_hache . '" '); //On vérifie que le mdp existe dans la bdd
			$reponse1->execute();
            $mdpco = $reponse1->fetch();
			
			echo 'lol';?></br></br></br></br><?php

			var_dump($_POST['mdpco']);
			var_dump($pass_hache);
			var_dump($mdpco);

			if($_POST['login'] == $mail['email'] && $pass_hache == $mdpco['mot_de_passe'] ) //Si le mail (qui est forcément unique) et le mdp correspondent on se co et on créer une session
			{
				
			$stet = $bdd->prepare('SELECT membres_id FROM membres WHERE email = "' . $_POST['login'] . '" '); //On récupère l'id
			$stet->execute();
            $id = $stet->fetch();
				session_start();
				$_SESSION['sessionUserId'] = $id['membres_id']; //La session Id à pour valeur l'id du membre
				header ('Location: acceuil.php');
			}
			else{
				echo' nooooooooooooooooooooooooooooooooooooooooooooooooooooooooooon'; //redirection page d'erreur
			}

    }
}



?>
<html>
<head>
    <meta charset = "utf-8"/>
    <title> Page d'acceuil </title>
</head>

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


<div align="right">

    <h2>Veuillez-vous identifiez</br> </h2>

    <form action="home.php" method="post">
        <table>
            <tr>
                <td>
                    <label for="mailconnect">Adresse mail : </label>
                </td>
                <td>
                    <input type="text" id="mailconnect" name="login" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mdpconnect">Mot de passe : </label>
                </td>
                <td>
                    <input type="password" id="mdpconnect" name="mdpco" />
                </td>
            </tr>
            <tr>
                <td>
                    </br></br>
                    <button name="formconnexion" type="submit">Connexion</button>
                </td>
            </tr>
        </table>
    </form>

    <h2>Créer un compte </h2>

    <form action="connexion.php" method="post">
        <table> <!--- On utilise le tableau et non le br pour que tous les input soient bien alignés. -->
            <tr>
                <td>
                    <label for="pseudo">Pseudo : </label>
                </td>
                <td>
                    <input placeholder=" Votre Pseudo" type="text" id="pseudo" name="pseudo" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prenom : </label>
                </td>
                <td>
                    <input placeholder=" Votre Prenom" type="text" id="prenom" name="prenom" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nom">Nom : </label>
                </td>
                <td>
                    <input placeholder=" Votre Nom" type="text" id="nom" name="nom" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email : </label>
                </td>
                <td>
                    <input placeholder=" Votre Email" type="email" id="email" name="email" />  <!--- permet de vérifier que le texte rentré est bien sous forme ___@___.__ -->
                </td>
            </tr>
            <!--- Créer un mail2 pour vérifier qu'il n'y a pas d'erreur de saisie. -->
            <tr>
                <td>
                    <label for="mdp">Mot de passe : </label>
                </td>
                <td>
                    <input placeholder=" Votre mot de passe" type="password" id= "mdp" name="mdp" />
                </td>
            </tr>
            <!--- Créer un mdp2 pour vérifier qu'il n'y a pas d'erreur de saisie. -->
            <tr>
                <td>
                    <label for="ddn">Date de naissance : </label> <!--- vente en ligne interdit aux mineurs -->
                </td>
                <td>
                    <input type="date" id="ddn" name="ddn"> <!--- pas de placeholder pour un type date -->
                </td>
            </tr>
            <tr>
                <td>
                    <label for="sexe">Sexe : </label>
                </td>
                <td>
                    Homme : <input type="radio" id="sexe" name="sexe" value ="homme" /></br>
                    Femme :	<input type="radio" name="sexe" value ="femme" />
                </td>
            </tr>
            <tr>
                <td>
                    </br></br>
                    <button type="submit" name="forminscription" >Créer un compte</button> <!--- name pour vérifier que tous à été rempli. -->
                </td>
            </tr>
        </table>
    </form>

</div>


</body>
</html>