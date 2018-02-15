<?php
Class Admin{
	
	private $id;
	
	public function __construct(){
		
	}
	
	public static function coAdmin($id){ //vérifie que l'id correspond à celui de l'admin, soit 1
		
		$bdd = Database::getInstance();
		$stmt = $bdd->prepare('SELECT id_membre FROM admin WHERE id_admin =' .$id);
		$stmt->execute();
		$data = $stmt->fetch();
		$stmt->closeCursor();
		
		if($data['id_membre'] === '1')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}


?>