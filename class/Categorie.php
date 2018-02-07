<?php
class Categorie{
	private $nom;
	private $description =0;
	
	const NOM_INVALIDE = 1;
    const DESCRIPTION_INVALIDE = 2;
	
	public function __construct($newcat){
            if(isset($newMembre['nom']))
            $this->setPseudo($newMembre['nom']);
        if(isset($newMembre['description']))
            $this->setNom($newMembre['description']);
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
}