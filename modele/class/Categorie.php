<?php
class Categorie{
	private $nom;
	private $description =0;
	private $cat;
	
	const NOM_INVALIDE = 1;
    const DESCRIPTION_INVALIDE = 2;
	
	public function __construct($newCat){
            if(isset($newCat['nom']))
            $this->setNom($newCat['nom']);
        if(isset($newCat['description']))
            $this->setDescription($newCat['description']);
	}
	
	    //Setters

    public function setNom($n)
    {
        $n = trim($n);
        if(!empty($n))
            $this->nom = $n;
        else
            $this->erreurs[] = self::NOM_INVALIDE;
        return $this;
    }

    public function setDescription($d)
    {
        $n = trim($d);
        if(!empty($d))
            $this->description = $d;
        else
            $this->erreurs[] = self::DESCRIPTION_INVALIDE;
        return $this;
    }
	
	//Getters
	
	public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }
	
    public function isValid()
    {
        return !empty($this->nom) && !empty($this->description);
    }	
	
	//Fonction
	public static function idCat($nom) //retourne l'id à partir du nom
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->query('SELECT id_cat FROM categorie WHERE nom="'.$nom.'"');
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		
		return $data['id_cat'];
		
	}
	
	public static function choiceCat($cat){ //Choix d'une categorie
	
			$bdd = Database::getInstance();			
			$req= $bdd->prepare("SELECT id_cat FROM categorie WHERE id_cat = ". $cat. "");
			$req->execute();
			$categorie = $req->fetch();	
			return $categorie;
	
	}

	
	public static function viewCat() // permet d'afficher toutes les catégories
	{
		
		$bdd = Database::getInstance();
		$stmt = $bdd->query('SELECT * FROM categorie ORDER BY id_cat');
		
		
		while($data = $stmt->fetch())
		{
			echo "<td>".$data['nom']. "</td></br>";
	
		}
				$stmt->closeCursor();
		
	}
	
	public static function deleteCat($nom) //Supprimer une catégorie
	{
		$id = SELF::idCat($nom);
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare('DELETE FROM categorie WHERE id_cat ='.$id);
		$stmt->execute();
		$stmt->closeCursor();
	}
	
}