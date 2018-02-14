<?php

class CategorieManager{
    private $_db; // Instance de PDO
	
	public function __construct()
    {

    }

    public function add(Objet $objet)
    {	
	$bdd = Database::getInstance();

       $req1 =$bdd->prepare("INSERT INTO categorie SET nom = :nom, description = :description");
	   $req1->bindValue(':nom', $objet->getNom(),PDO::PARAM_STR); //bindvalue, permet d'associer une valeur à un paramètre
        $req1->bindValue(':description', $objet->getDescription(),PDO::PARAM_STR);
        $req1->execute();
		$req1->closeCursor();

    }

    public function setDb($db)
    {
        $this->_db = $db;

    }	
}