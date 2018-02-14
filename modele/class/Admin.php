<?php
Class Admin{
	
	private $id;
	
	public static function coAdmin($id){
		
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
	
	public static function viewCat()
	{
		$bdd = Database::getInstance();
		$stmt = $bdd->query('SELECT * FROM categorie');
		
		while($data = $stmt->fetch())
		{
			?><td><?php echo $data['nom']; ?></td><?php
		}
				$stmt->closeCursor();
	}
}


?>