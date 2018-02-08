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

        $req =$bdd->prepare("INSERT INTO articles SET id_membre = :membre , id_cat_art = :choix, nom = :nom, description = :description, etat = :etat, prix = :prix, datefin = :datefin");	   
	    $req->bindValue(':membre', $_SESSION['sessionUserId'],PDO::PARAM_INT);	   
	    $req->bindValue(':choix', $objet->getCat(),PDO::PARAM_INT);
		$req->bindValue(':nom', $objet->getNom(),PDO::PARAM_STR); //bindvalue, permet d'associer une valeur à un paramètre
        $req->bindValue(':description', $objet->getDescription(),PDO::PARAM_STR);
        $req->bindValue(':prix', $objet->getPrix(),PDO::PARAM_INT);
		$req->bindValue(':etat', $objet->getEtat(),PDO::PARAM_STR);
        $req->bindValue(':datefin', $objet->getDateFin(),PDO::PARAM_STR);		
        $req->execute();
		$req->closeCursor();

		
    }

}


?>