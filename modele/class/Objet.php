<?php

class Objet{
    private $nom = null;
    private $description = null;
	private $prix = null;
    private $etat = null;
	private $cat = null;   //cle etrangère de la table categorie
	private $idMembre;
   // private $prixDepart = null;
  //  private $dateDebut = null;
    private $dateFin = null;
	private $idArt = null;
  //  private $erreurs = array();

    const NOM_INVALIDE = 1;
    const DESCRIPTION_INVALIDE = 2;
    const ETAT_INVALIDE = 3;
    const PRIX_DE_DEPART_INVALIDE = 4;
    const DATE_DEBUT_INVALIDE = 5;
    const DATE_FIN_INVALIDE = 6;
	const CAT_INVALIDE = 7;

    public function __construct(Array $newObjet)
    {
        if(isset($newObjet['nom']))
            $this->setNom($newObjet['nom']);
        if(isset($newObjet['description']))
            $this->setDescription($newObjet['description']);
		if(isset($newObjet['prix']))
            $this->setPrix($newObjet['prix']);
        if(isset($newObjet['etat']))
            $this->setEtat($newObjet['etat']);
        if(isset($newObjet['cat']))
            $this->setCat($newObjet['cat']);		
       /* if(isset($newObjet['prixDepart']))
            $this->setPrixdepart($newObjet['prixDepart']);
        if(isset($newObjet['dateDebut']))
            $this->setDatedebut($newObjet['dateDebut']);*/
        if(isset($newObjet['dateFin']))
            $this->setDatefin($newObjet['dateFin']);
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

    public function setEtat($e)
    {
        $e = trim($e);
        if(!empty($e))
            $this->etat = $e;
        else
            $this->erreurs[] = self::ETAT_INVALIDE;
        return $this;
    }

    public function setCat($cat)
    {
        $n = trim($cat);
        if(!empty($cat))
            $this->cat = $cat;
        else
            $this->erreurs[] = self::CAT_INVALIDE;
        return $this;
    }	
	
  /*  public function setPrixdepart($pxd)
    {
        $pxd = trim($pxd);
        if(!empty($pxd))
            $this->prixDepart = $pxd;
        else
            $this->erreurs[] = self::PRIX_DE_DEPART_INVALIDE;
        return $this;
    }

    public function setDatedebut($dd)
    {
        $dd = trim($dd);
        if(!empty($dd))
            $this->dateDebut = $dd;
        else
            $this->erreurs[] = self::DATE_DEBUT_INVALIDE;
        return $this;
    }*/

    public function setDatefin($df)
    {
        $df = trim($df);
        if(!empty($df))
            $this->dateFin = $df;
        else
            $this->erreurs[] = self::DATE_FIN_INVALIDE;
        return $this;
    }
	
	public function setPrix($prix)
	{
		$rpix = trim($prix);
        if(!empty($prix))
            $this->prix = $prix;
		return $prix;
	}

    // Getters

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function getCat()
    {
        return $this->cat;
    }	
	
   /* public function getPrixdepart()
    {
        return $this->prixDepart;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }
*/
    public function getDateFin()
    {
        return $this->dateFin;
    }

	    public function getPrix()
    {
        return $this->prix;
    }
	
    public function isValid()
    {
        return !empty($this->nom) && !empty($this->description) && !empty($this->etat) && !empty($this->prix) && !empty($this->cat) && !empty($this->dateFin) /*&& !empty($this->prixDepart) && !empty($this->dateDebut)*/ ;
    }
	
	public static function recupNom($idMembre)
	{
		$bdd= Database::getInstance();
		$pseudoM = $bdd->prepare('SELECT pseudo FROM membres WHERE membres_id = "' .$idMembre.'" ');
		$pseudoM->execute();
		$data = $pseudoM->fetch();
		$pseudoM->closeCursor();
		return $data;
	}

	public static function myArticle() //permet de récupérer les noms des articles vendu par un membre
	{
		$bdd = Database::getInstance();
		$article = $bdd->query("SELECT nom FROM articles WHERE id_membre =" . $_SESSION['sessionUserId']);
		while($data = $article->fetch())
		{
		echo $data['nom'];?></br><?php
		}
		$article->closeCursor();
	}
	
	public static function idArt($idMembre) 
	{
		$bdd = Database::getInstance();
		$idArticle = $bdd->query("SELECT id_articles FROM articles WHERE id_membre =" . $idMembre ." ORDER BY id_articles DESC LIMIT 1");		
		$id = $idArticle->fetch();
		$idArticle->closeCursor();
		return $id['id_articles'];

	}
	
	public static function priceArt($idArt) //permet de récupérer le prix actuel d'un article
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare("SELECT prix_en_cours FROM articles WHERE id_articles =".$idArt);
		$data = $stmt->fetch();
		$stmt->closeCursor();
		return $data;
		
	}
	
	public static function vendeurArt($idArt) //retourne le vendeur par rapport à l'id de l'article
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare("SELECT id_membre FROM articles WHERE id_articles =".$idArt);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		return $data;
		var_dump($data);
	}
	
	public static function validPrice($newPrice, $idArt) //Met à jour le prix
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare("UPDATE articles SET prix_en_cours = :newPrice WHERE id_articles =" .$idArt);
		$stmt->bindValue(':newPrice', $newPrice,PDO::PARAM_INT);
		$stmt->execute();
		$stmt->closeCursor();
	}
	
	public static function deleteArt($idArt)
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare("DELETE FROM articles WHERE id_articles =" .$idArt);
		$stmt->execute();
		$stmt->closeCursor();
	}
}
?>
