<?php

/**
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */


class FormAdmin{
 
    private $data;
	private $idAdmin;
	private $idArticle;
	private $idMembre;

    public function __construct(){
		
    }

    public static function buttonSuppArt($idAdmin, $idArticle){ //Boutton suppression article pour l'admin
	
	if($idAdmin === true)
	{
	echo "<form action='../controller/connexion.php' method='post'> <input type='submit' class='button-input' name='suppartadmin' value='Supprimer'/> <input type='hidden' value='".$idArticle."' name='idArticle'/> </form>"; 
	}
	}
	
	public static function buttonSuppMembre($idAdmin, $idMembre){ //Boutton suppression membre pour l'admin
	
		if($idAdmin === true)
		{
			echo "<form action='../controller/connexion.php' method='post'> <input type='submit' name='suppmembreadmin' class='button-input' value='Supprimer'/> <input type='hidden' value='".$idMembre."' name='idMembre'/> </form>"; 
		}
	}
	
	
	public static function pageAdmin($idAdmin){ //Permet d'arriver sur la page admin si l'on est admin
	
		if($idAdmin === true)
		{
			echo "<a class='navbar-brand' href='admin.php'>Administrer</a>";
		}
	}
}