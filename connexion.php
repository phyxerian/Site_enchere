<!DOCTYPE html>
<?php
session_start();
require 'class/Autoloader.php';
Autoloader::register();

?>
<html>
<head>
    <meta charset = "utf-8"/>
    <title>requête base de données </title>
</head>
<body>
<?php

//partie inscription d'un membre

if(isset($_POST['forminscription']))
{
    if(!empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdp']) && !empty($_POST['email']) && !empty($_POST['sexe']) && !empty($_POST['ddn'])) //permet de vérifier que tous les champs sont remplis
    {
        $membre = new Membre(array ('pseudo'=>$_POST['pseudo'], 'nom'=>$_POST['nom'], 'prenom'=>$_POST['prenom'], 'mdp'=>$_POST['mdp'], 'email'=>$_POST['email'], 'sexe'=>$_POST['sexe'], 'ddn'=>$_POST['ddn']));
		if($membre->isValid()) // normalement, cette condition ne sera jamais fausse  grace au 2eme if qui vérifie si les cases ne sont pas vides.
		{
			$manager = new MembreManager();
            $manager->add($membre);
			
			var_dump($membre);
			

			var_dump($membre->getId());
            $_SESSION['sessionUserId'] = $membre->getId();

            header('Location: acceuil.php'); //Redirection vers la page acceuil si un nouveau compte à été créé.
        }
        else
        {
            echo "Tous les champs n'ont pas été remplis.";
        }

    }
}


var_dump($_POST['nom']);var_dump($_POST['desc']);var_dump($_POST['prix']);var_dump($_POST['etat']);var_dump($_POST['choix']);var_dump($_POST['df']);


//création d'une annonce

if(isset($_POST['annonce']))
{

		if(!empty($_POST['nom']) && !empty($_POST['desc']) && !empty($_POST['prix']) && !empty($_POST['etat']) && !empty($_POST['choix']))
		{
			echo 'toto';
			$bdd = Database::getInstance();			
			$req= $bdd->prepare("SELECT id_cat FROM categorie WHERE id_cat = ". $_POST['choix']. "");
			$req->execute();
			$categorie = $req->fetch();

			
			$objet=new Objet(array ('nom'=>$_POST['nom'], 'description'=>$_POST['desc'], 'etat'=>$_POST['etat'], 'prix'=>$_POST['prix'], 'cat'=>$_POST['choix'], 'dateFin'=>$_POST['df']));

				if($objet->isValid())
				{
					echo'lala';
					$manager = new ObjetManager();
					$manager->add($objet);

					$id = Membre::userId();

			
					header('Location: succes.php'); //Redirection vers la page de succès d'enregistrement d'annonce.
				}
			
		}	
	
}
?>
</body>
</html>


