<?php
require 'modele/class/Autoloader.php';
Autoloader::register();
		session_start();


if (!isset($_SESSION['sessionUserId']))
{
    header('Location: view/home.php');
}
else
{
    header('Location: view/acceuil.php');
}


?>



<html>
<head>
    <meta charset = "utf-8"/>
    <title> Page Index Redirection </title>
</head>
<body>

</body>
</html>