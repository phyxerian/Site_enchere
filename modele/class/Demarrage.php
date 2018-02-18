<?php
Class Demarrage{

private $session;

    public static function SS()
    {
        session_start();
    }
	
	public static function sessionExist(){ //Si la session existe déjà.
		
		if(isset($_SESSION['sessionUserId']))
		{
			header ('Location: ../view/acceuil.php');
		}
	}
}