<?php
session_start();
require '../modele/class/Autoloader.php';
Autoloader::register();
Database::getInstance();
//Demarrage::sessionExist($_SESSION['sessionUserId']);
?>
<!DOCTYPE html>
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

    <form action="../controller/connexion.php" method="post">
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

    <form action="../controller/connexion.php" method="post">
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
            <tr>
                <td>
                    <label for="email1">Confirmation de votre Email : </label>
                </td>
                <td>
                    <input placeholder=" Confirmer votre Email" type="email" id="email" name="email1" />  <!--- permet de vérifier que le texte rentré est bien sous forme ___@___.__ -->
                </td>
            </tr>			
            <tr>
                <td>
                    <label for="mdp">Mot de passe : </label>
                </td>
                <td>
                    <input placeholder=" Votre mot de passe" type="password" id= "mdp" name="mdp" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mdp1">Confirmation du mot de passe : </label>
                </td>
                <td>
                    <input placeholder=" Confirmez votre mot de passe" type="password" id= "mdp" name="mdp1" />
                </td>
            </tr>			
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