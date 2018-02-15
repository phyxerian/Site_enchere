<?php
session_start();
require '../modele/class/Autoloader.php';
Autoloader::register();


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

			if($_POST['login'] == $mail['email'] && $pass_hache == $mdpco['mot_de_passe'] ) //Si le mail (qui est forcément unique) et le mdp correspondent on se co et on créer une session
			{
				
				$stet = $bdd->prepare('SELECT membres_id FROM membres WHERE email = "' . $_POST['login'] . '" '); //On récupère l'id
				$stet->execute();
				$id = $stet->fetch();
				
				session_start();
				$_SESSION['sessionUserId'] = $id['membres_id']; //La session Id à pour valeur l'id du membre
				
				$idAdmin= Admin::coAdmin($_SESSION['sessionUserId']);
				
				var_dump($idAdmin);
				var_dump($_SESSION['sessionUserId']);
				
				if($idAdmin === true)
				{
				header ('Location: ../view/admin.php');
		
				}
				else{
				header ('Location: ../view/acceuil.php');
				}
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
									$fuseau = new DateTimeZone('Europe/Paris'); //fuseau
									$today = new DateTime($time = "now", $fuseau); //aujourd'hui
									$date_18 = $today->sub(new DateInterval('P18Y')); //date - 18 ans
									$ddn = DateTime::createFromFormat('Y-m-d', $_POST['ddn']);
									
										if($ddn  <= $date_18)
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

																	header('Location: ../view/acceuil.php'); //Redirection vers la page acceuil si un nouveau compte à été créé.
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
											echo "Il faut avoir plus de 18 ans pour s'inscrire sur un site de vente aux enchères.";	
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

			$bdd = Database::getInstance();			
			$req= $bdd->prepare("SELECT id_cat FROM categorie WHERE id_cat = ". $_POST['choix']. "");
			$req->execute();
			$categorie = $req->fetch();


			$objet=new Objet(array ('nom'=>$_POST['nom'], 'description'=>$_POST['desc'], 'etat'=>$_POST['etat'], 'prix'=>$_POST['prix'], 'cat'=>$_POST['choix'], 'dateFin'=>$_POST['df']));

				if($objet->isValid())
				{

					$manager = new ObjetManager();
					$manager->add($objet);
					$idM = Membre::userId();				
					$idA = Objet::idArt($idM); //id de l'article
					
					
					$tailleMax = 2097152; // 2 mégaoctets, on le passe par variable pour éviter d'avoir un chiffre dans le if dont on oublirait la signification
					$extensionsValides = array('jpg','jpeg','gif','png');
					
					if($_FILES['photo']['size'] <= $tailleMax)
					{

						$extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
						if(in_array($extensionUpload, $extensionsValides))
						{

							$path = "../public/article/photo/".$idA.".".$extensionUpload;
							$resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
							if($resultat) //si le déplacement c'est bien effectuer
							{

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
					
					header('Location: ../view/succes.php'); //Redirection vers la page de succès d'enregistrement d'annonce.
				}			
		}		
}


//Déconnexion d'une session

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
    header ('Location: ../index.php');
	
}



// Encherir

if(isset($_POST['newprice'])) //Si on a cliqué sur le bouton
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
				Membre::subMoney($_POST['price']);
				header('Location: ../view/succes.php');//On retourne sur la page succès
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

//Créditer compte

if(isset($_POST['ajout'])) // Si on a cliqué sur créditer
{
	Membre::addMoney($_POST['credit']); // ajoute des crédits
	header('Location: ../view/mon_compte.php');
}


//Barre de recherche article

$urlPhoto = "../public/article/photo/";
$urlArticle = "article.php?var1=";
 
header("Content-Type: text/plain"); 
  
  if (isset($_POST['champRecherche'])) { 

    if (is_string($_POST["champRecherche"])){ 
      $LibelleRecherche = stripslashes(htmlentities($_POST["champRecherche"])); 

	  if (empty($LibelleRecherche) == false) 
	    { 
			
			$bdd = Database::getInstance();
			$reqres = $bdd->query("SELECT id_articles, nom, photo FROM articles WHERE nom LIKE '".$LibelleRecherche."%' ORDER BY nom");
			
			while ($row = $reqres->fetch()){ 
			
				$value = $row['id_articles'];
				echo "<h2><a href='". $urlArticle. "" . $value . "'>". $row["nom"]."</h2></a><br/>";
				echo "<img src=". $urlPhoto .$row['photo']." width='150'></br>";		

					} 
			$reqres->closeCursor();		
		} 
		else 
		{ 
			echo "";
		} 
	} 
	else { 
      echo ""; 
		} 
} 
else
{ 
	echo "";
}


// Barre de recherche membre pour Admin

$urlPhoto = "../public/article/photo/";
$urlArticle = "membre.php?var1=";
 
header("Content-Type: text/plain"); 
  
  if (isset($_POST['champRechercheMembre'])) { 

    if (is_string($_POST["champRechercheMembre"])){ 
      $LibelleRecherche = stripslashes(htmlentities($_POST["champRechercheMembre"])); 

	  if (empty($LibelleRecherche) == false) 
	    { 
			
			$bdd = Database::getInstance();
			$reqres = $bdd->query("SELECT membres_id, nom FROM membres WHERE nom LIKE '".$LibelleRecherche."%' ORDER BY nom");
			
			while ($row = $reqres->fetch()){ 
			
				$value = $row['membres_id']; //////
				echo "<h2><a href='". $urlArticle. "" . $value . "'>". $row["nom"]."</h2></a><br/>";

					} 
			$reqres->closeCursor();		
		} 
		else 
		{ 
			echo "";
		} 
	} 
	else { 
      echo ""; 
		} 
} 
else
{ 
	echo "";
}


//Suppression compte

	if(isset($_POST['suppcompte']))
	{
		echo 'coucou';
		if(Membre::article() === false)
		{
			echo 'test';
		Membre::deleteMembre();
		header('Location: ../view/home.php'); 
		}
		else
		{
			echo"Vous ne pouvez pas supprimer votre compte tant qu'il reste des articles en vente.";
		}
	}

	//Modification du Pseudo
	
	if(isset($_POST['modpseudo']))
	{
		if(!empty($_POST['newpseudo']))
		{
			Membre::changePseudo($_POST['newpseudo']);
			header('Location: ../view/mon_compte.php');
		}
		else
		{
			echo "Le champ pseudo est vide.";
		}
	}
	
	
	//Modification mot de passe Membre
	
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
					//echo "Le mot de passe à été changé.";
					header('Location: ../view/succes.php');
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

	
	// Ajouter catégorie

	if(isset($_POST['addCat']))
	{
		if(isset($_POST['nomcat']) && !empty($_POST['nomcat']))
		{
			if(isset($_POST['descat']) && !empty($_POST['descat']))
			{
				$cat = new Categorie(array ('nom'=>$_POST['nomcat'], 'description'=>$_POST['descat']));
					if($cat->isValid()) // normalement, cette condition ne sera jamais fausse  grace au 2eme if qui vérifie si les cases ne sont pas vides.
					{
						$manager = new CategorieManager();
						$manager->add($cat);
						header('Location: ../view/admin.php'); //Redirection vers la page acceuil si un nouveau compte à été créé.
					}
			}
			else
			{
				echo "indiquer une description";
			}
		}
		else
		{
			echo "Indiquer un nom";
		}
	}
	
	// Supprimer catégorie (Admin)

	if(isset($_POST['suppcat']))
	{

		if(isset($_POST['nomcatsupp']) && !empty($_POST['nomcatsupp']))
		{
			echo'coucou';
			Categorie::deleteCat($_POST['nomcatsupp']);
			var_dump($_POST['nomcatsupp']);
			header('Location: ../view/admin.php');
		}
		else
		{
			echo "Mauvais nom ou nom inexistant.";
		}
	}
	
	//Supprimer un article côté Admin
	

if(isset($_POST['suppartadmin']))
{
		var_dump($_POST['idArticle']);
		Objet::deleteArt($_POST['idArticle']);
		header('Location: ../view/admin.php');		
}	
	
	//Supprimer membre côté Admin
	
if(isset($_POST['suppmembreadmin']))
{
		Membre::deleteMembreAdmin($_POST['idMembre']);
		header('Location: ../view/admin.php');		
}		
?>



