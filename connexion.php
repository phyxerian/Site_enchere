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

//partie inscription d'un membre

if(isset($_POST['forminscription']))
{	
	
    if(!empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdp']) && !empty($_POST['mdp1']) && !empty($_POST['email']) && !empty($_POST['email1']) && !empty($_POST['sexe']) && !empty($_POST['ddn'])) //permet de vérifier que tous les champs sont remplis
    {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$nom =  htmlspecialchars($_POST['nom']);
		$prenom =  htmlspecialchars($_POST['prenom']);
		
		$pseudolenght = strlen($pseudo);
			if($pseudolenght <=255)
			{
				$nomlenght = strlen($nom);
				if($nomlenght <=255)
				{	
					$prenomlenght = strlen($prenom);
					if($prenomlenght <=255)
					{	
						if(Membre::verifEmail($_POST['email']) === false) //unicité de l'email
						{	
							$emaillenght = strlen($_POST['email']);
							if($emaillenght <=255)
							{
								$mdplenght = strlen($_POST['mdp']);
								if($mdplenght <=255)
								{	
									if(Membre::verifPseudo($pseudo) === false) //unicité du pseudo
									{	
										if($_POST['email'] === $_POST['email1'])
										{
											if($_POST['mdp'] === $_POST['mdp1'])
											{
													$membre = new Membre(array ('pseudo'=>$_POST['pseudo'], 'nom'=>$_POST['nom'], 'prenom'=>$_POST['prenom'], 'mdp'=>$_POST['mdp'], 'email'=>$_POST['email'], 'sexe'=>$_POST['sexe'], 'ddn'=>$_POST['ddn']));
													if($membre->isValid()) // normalement, cette condition ne sera jamais fausse  grace au 2eme if qui vérifie si les cases ne sont pas vides.
													{
														$manager = new MembreManager();
														$manager->add($membre);
			
														$_SESSION['sessionUserId'] = $membre->getId();

														header('Location: acceuil.php'); //Redirection vers la page acceuil si un nouveau compte à été créé.
													}
													else
													{
														echo "Tous les champs n'ont pas été remplis.";
													}
											}
											else
											{
												echo'Les mots de passes ne sont pas identiques.';
											}
										}
										else
										{
											echo 'Les emails ne sont pas identiques.';
										}
									}
									else
									{
										echo 'Ce pseudonyme existe déjà.';
									}
								}
								else
								{
									echo'Mot de passe supérieur à 255 caractères.';
								}
							}
							else
							{
								echo'Email supérieur à 255 caractères.';
							}
						}					
						else
						{
							echo'Email déjà pris.';
						}
					}
					else
					{
						echo'prenom supérieur à 255 caractères.';
					}
				}
				else
				{
					echo'nom supérieur à 255 caractères.';
				}
			}
			else
			{
					echo'pseudo supérieur à 255 caractères.';
			}
    }
}


//var_dump($_POST['nom']);var_dump($_POST['desc']);var_dump($_POST['prix']);var_dump($_POST['etat']);var_dump($_POST['choix']);var_dump($_POST['df']); //df = datefin


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
					var_dump($objet);
					$idM = Membre::userId();
					var_dump($idM);					
					$idA = Objet::idArt($idM); //id de l'article
					
					var_dump($idA);
					
					$tailleMax = 2097152; // 2 mégaoctets, on le passe par variable pour éviter d'avoir un chiffre dans le if dont on oublirait la signification
					$extensionsValides = array('jpg','jpeg','gif','png');
					var_dump($tailleMax);
					var_dump($extensionsValides);
					var_dump($_FILES['photo']['name']);
					
					if($_FILES['photo']['size'] <= $tailleMax)
					{
						echo'test';
						$extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
						if(in_array($extensionUpload, $extensionsValides))
						{
							echo 'coucou';
							$path = "article/photo/".$idA.".".$extensionUpload;
							$resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
							if($resultat) //si le déplacement c'est bien effectuer
							{
													var_dump($idA);
								echo'lol';
								$photo = $bdd->prepare("UPDATE articles SET photo = :photo WHERE id_articles = :id" );
								$photo->execute(array(
								'photo' => $idA.".".$extensionUpload,
								'id' => $idA
								));
					
							}
							else
							{
								echo"erreur pendant le déplacement du fichier.";
							}
						}
						else
						{
							echo"Votre photo de profil doit être au format jpg, jpeg, gif ou png.";
						}
					}
					else
					{
					echo"Votre photo d'article ne doit pas dépasser 2 Mégaoctets.";
					}
					
					header('Location: succes.php'); //Redirection vers la page de succès d'enregistrement d'annonce.
				}			
		}		
}

// Encherir

if(isset($_POST['newprice'])) //Si on a cliquer sur le bouton
{
	if(isset($_POST['price'])) //et que l'on a rentré un prix
	{
		$idM = Objet::vendeurArt($_POST['id']); //On identifie le vendeur de l'article
		
		if($_SESSION['sessionUserId'] != $idM) //si le vendeur n'est pas l'enchérisseur alors
		{
			$price = Objet::priceArt($_POST['id']); //On récupère le prix en cours de l'article
			if($_POST['price'] > $price) // Si le prix est supérieur au prix enregistré en bdd alors
			{
				Objet::validPrice($_POST['price'], $_POST['id']); //On met à jour le nouveau prix
						var_dump($_POST['price']);
						var_dump($_POST['id']);
				header('Location: succes.php');//On retourne sur la page succès
			}
			else
			{
				echo 'Le prix doit être supérieur à celui actuel.';
			}
		}
		else
		{
			echo"Vous ne pouvez pas enchérir sur votre annonce."; 
		}
	}
}


?>
</body>
</html>


