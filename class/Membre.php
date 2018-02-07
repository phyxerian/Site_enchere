<?php

class Membre //création de la classe membre
{

    private $id = 0;
    private $pseudo;
    private $nom;
    private $prenom;
    private $mdp;
    private $email;
    private $sexe;
    private $ddn;
    private $erreurs = array();

    const NOM_INVALIDE = 1;
    const PRENOM_INVALIDE = 2;
    const MOT_DE_PASSE_INVALIDE = 3;
    const EMAIL_INVALIDE = 4;
    const SEXE_INVALIDE = 5;
    const DATE_DE_NAISSANCE_INVALIDE = 6;
    const PSEUDO_INVALIDE = 7;

    public function __construct(array $newMembre)
    {
        if(isset($newMembre['pseudo']))
            $this->setPseudo($newMembre['pseudo']);
        if(isset($newMembre['nom']))
            $this->setNom($newMembre['nom']);
        if(isset($newMembre['prenom']))
            $this->setPrenom($newMembre['prenom']);
        if(isset($newMembre['mdp']))
            $this->setMdp($newMembre['mdp']);
        if(isset($newMembre['email']))
            $this->setEmail($newMembre['email']);
        if(isset($newMembre['sexe']))
            $this->setSexe($newMembre['sexe']);
        if(isset($newMembre['ddn']))
            $this->setDdn($newMembre['ddn']);

    }
	


    //Setters

    public function setId($id)
    {
        $id = (int) $id; //est forcément un entier
        if ($id > 0) //ne peux pas être négatif
        {
            $this->_id = $id;
        }
    }

    public function setPseudo($ps)
    {
        $n = trim($ps);
        if(!empty($ps))
            $this->pseudo = $ps;
        else
            $this->erreurs[] = self::PSEUDO_INVALIDE;
        return $this;
    }

    public function setNom($n)
    {
        $n = trim($n);
        if(!empty($n))
            $this->nom = $n;
        else
            $this->erreurs[] = self::NOM_INVALIDE;
        return $this;
    }

    public function setPrenom($pr)
    {
        $n = trim($pr);
        if(!empty($pr))
            $this->prenom = $pr;
        else
            $this->erreurs[] = self::PRENOM_INVALIDE;
        return $this;
    }

    public function setMdp($mot_de_passe)
    {
        $mot_de_passe = trim($mot_de_passe);
        if(!empty($mot_de_passe))
            $this->mdp = sha1($mot_de_passe); //hachage du mdp en password_hash qui choisit le meilleur algo de cryptage
        else
            $this->erreurs[] = self::MOT_DE_PASSE_INVALIDE;
        return $this;
    }

    public function setEmail($m)
    {
        if(filter_var($m, FILTER_VALIDATE_EMAIL))
            $this->email = $m;
        else
            $this->erreurs[] = self::EMAIL_INVALIDE;
        return $this;
    }

    public function setSexe($s)
    {
        $s = trim($s);
        if(!empty($s))
            $this->sexe = $s;
        else
            $this->erreurs[] = self::SEXE_INVALIDE;
        return $this;
    }

    public function setDdn($daten)
    {
        $daten = trim($daten);
        if(!empty($daten))
            $this->ddn = $daten;
        else
            $this->erreurs[] = self::DATE_DE_NAISSANCE_INVALIDE;
        return $this;
    }

    // Getters

    public function getId()
    {
        return $this->_id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getDdn()
    {
        return $this->ddn;
    }

	//function
	
    public function isValid()
    {
        return !empty($this->nom) && !empty($this->prenom) && !empty($this->mdp) && !empty($this->email) && !empty($this->sexe) && !empty($this->ddn);
    }
	
	public static function userId(){
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare("SELECT * FROM membres WHERE membres_id =" . $_SESSION['sessionUserId']);
		$stmt->execute();
		$data = $stmt->fetch();
		return $data['pseudo'];
	}
}
?>
