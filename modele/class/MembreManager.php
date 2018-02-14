<?php

include_once 'Membre.php';
include_once 'Database.php';

class MembreManager{


    public function __construct()
    {

    }

    public function add(Membre $membre)
    {	
	$bdd = Database::getInstance();

        $req1 =$bdd->prepare("INSERT INTO membres SET pseudo = :pseudo, nom = :nom, prenom = :prenom, mot_de_passe = :mdp, email = :email, sexe = :sexe, date_de_naissance = :ddn, date_inscription = NOW()");
	    $req1->bindValue(':pseudo', $membre->getPseudo(),PDO::PARAM_STR); //bindvalue, permet d'associer une valeur à un paramètre
        $req1->bindValue(':nom', $membre->getNom(),PDO::PARAM_STR);
        $req1->bindValue(':prenom', $membre->getPrenom(),PDO::PARAM_STR);
        $req1->bindValue(':mdp', $membre->getMdp(),PDO::PARAM_STR);
        $req1->bindValue(':email', $membre->getEmail(),PDO::PARAM_STR);
        $req1->bindValue(':sexe', $membre->getSexe(),PDO::PARAM_STR);
        $req1->bindValue(':ddn', $membre->getDdn(),PDO::PARAM_STR);
        $req1->execute();
		$req1->closeCursor();
		
		
		$test = $bdd->prepare("SELECT * FROM membres WHERE email = :email");
		$test->bindValue('email', $membre->getEmail(), PDO::PARAM_STR);
	    $test->execute();
		$data = $test->fetch();
		var_dump ($data['membres_id']);
		$membre->setId($data['membres_id']);
		var_dump($membre);
		$test->closeCursor();
				
    }
	
    public function delete(Membre $membre)
    {
        $this->_db->exec('DELETE FROM membres WHERE membres_id = '.$membres->id());
    }

}

