<?php

include_once 'Objet.php'; 
include_once 'Database.php';

class ObjetManager{

    public function __construct()
    {

    }

    public function add(Objet $objet)
    {	
	$bdd = Database::getInstance();

        $req1 =$bdd->prepare("INSERT INTO articles SET id_membre = :membre , id_cat_art = :choix, nom = :nom, description = :description, etat = :etat, prix = :prix");	   
	   $req1->bindValue(':membre', $_SESSION['sessionUserId'],PDO::PARAM_INT);	   
	   $req1->bindValue(':choix', $objet->getCat(),PDO::PARAM_INT);
		$req1->bindValue(':nom', $objet->getNom(),PDO::PARAM_STR); //bindvalue, permet d'associer une valeur à un paramètre
        $req1->bindValue(':description', $objet->getDescription(),PDO::PARAM_STR);
        $req1->bindValue(':prix', $objet->getPrix(),PDO::PARAM_INT);
		$req1->bindValue(':etat', $objet->getEtat(),PDO::PARAM_STR);
        $req1->execute();
		$req1->closeCursor();

		
    }

}


?>