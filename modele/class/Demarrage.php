<?php
Class Demarrage{

private $session;

    public static function SS()
    {
        session_start();
    }
	
	public static function sessionExist($session){ //Si la session existe déjà.
		
		if(isset($session))
		{
			header ('Location: ../view/acceuil.php');
		}
	}
}