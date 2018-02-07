<?php

class Objet{
    private $nom = null;
    private $description = null;
	private $prix = null;
    private $etat = null;
	private $cat = null;   //cle etrangère de la table categorie
   // private $prixDepart = null;
  //  private $dateDebut = null;
  //  private $dateFin = null;
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
            $this->setDatedebut($newObjet['dateDebut']);
        if(isset($newObjet['dateFin']))
            $this->setDatefin($newObjet['dateFin']);*/
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
    }

    public function setDatefin($df)
    {
        $df = trim($df);
        if(!empty($df))
            $this->dateFin = $ddf;
        else
            $this->erreurs[] = self::DATE_FIN_INVALIDE;
        return $this;
    }*/
	
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

    public function getDateFin()
    {
        return $this->dateFin;
    }
*/
	    public function getPrix()
    {
        return $this->prix;
    }
	
    public function isValid()
    {
        return !empty($this->nom) && !empty($this->description) && !empty($this->etat) && !empty($this->prix) && !empty($this->cat) /*&& !empty($this->prixDepart) && !empty($this->dateDebut) && !empty($this->dateFin)*/;
    }

}
?>
