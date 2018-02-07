
<?php
require 'class/Autoloader.php';
Autoloader::register();
		session_start();


if (!isset($_SESSION['sessionUserId']))
{
    header('Location: home.php');
}
else
{
    header('Location: acceuil.php');
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