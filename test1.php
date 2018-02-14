<?php


	if(isset($_POST['suppcompte']))
	{

		if(Membre::article() === false)
		{
		//Membre::deleteMembre();
		header('Location: home.php'); 
		echo 'votre compte a été supprimé.';

		}
		else
		{
			echo"Vous ne pouvez pas supprimer votre compte tant qu'il reste des articles en vente.";
		}
	}
	if(isset($_POST['non']))
	{
		echo 'votre compte a été supprimé.';

	}
	

	$tz = new DateTimeZone('Europe/Paris');
	$today = new DateTime($time = "now", $tz); //aujourd'hui
	$date_18 = $today->sub(new DateInterval('P18Y')); //date - 18 ans
	$ddn = DateTime::createFromFormat('Y-m-d', $_POST['ddn']);

	var_dump($today);	
	var_dump($date_18);	
	var_dump($ddn);
if($ddn === !false)
{

if( $ddn <= $date_18)
{
	echo 'réussi';
}
else{
	echo 'perduuuuuu';
}
}
else{
	echo 'perdu';
}
	//var_dump($ageMajeur);
	//var_dump($age);
//if($_POST['ddn'] <= $age)

	
?>