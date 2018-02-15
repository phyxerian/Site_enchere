<?php require '../modele/class/Autoloader.php';
Autoloader::register();
session_start(); // à évoluer

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title> Mon compte</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

	
		<script type="text/javascript"> 

//Retourne l'objet XMLHttpRequest Instancié

function getXMLHttpRequest() { 
var xhr = null; 
if (window.XMLHttpRequest || window.ActiveXObject) { 
if (window.ActiveXObject) { 
try { 
xhr = new ActiveXObject("Msxml2.XMLHTTP"); 
} catch(e) { 
xhr = new ActiveXObject("Microsoft.XMLHTTP"); 
} 
} else { 
xhr = new XMLHttpRequest(); 
} 
} else { 
alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest..."); 
return null; 
} 
return xhr; 
} 

function recherche() { 
  var xmlHttp = getXMLHttpRequest(); 
  
  if (xmlHttp == null){ 
      alert("Votre navigateur ne supporte pas les requêtes HTTP."); 
      return false; }
	  
  // fonction à exécuter dès réception de la réponse 
  
  xmlHttp.onreadystatechange = function(){ 
			if (xmlHttp.readyState==4 && xmlHttp.status==200) 
			document.getElementById('div_contenuRecherche').innerHTML = xmlHttp.responseText; 
		}
  
	xmlHttp.open("POST","../controller/connexion.php",true); 
	xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
	xmlHttp.send("champRecherche="+document.getElementById("champRecherche").value); 
}

function rechercheMembre() { 
  var xmlHttp = getXMLHttpRequest(); 
  
  if (xmlHttp == null){ 
      alert("Votre navigateur ne supporte pas les requêtes HTTP."); 
      return false; }
	  
  // fonction à exécuter dès réception de la réponse 
  
  xmlHttp.onreadystatechange = function(){ 
			if (xmlHttp.readyState==4 && xmlHttp.status==200) 
			document.getElementById('div_contenuRechercheMembre').innerHTML = xmlHttp.responseText; 
		}
  
	xmlHttp.open("POST","../controller/connexion.php",true); 
	xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 
	xmlHttp.send("champRechercheMembre="+document.getElementById("champRechercheMembre").value); 
}
</script>	
	
	
	
	
<head>	
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="home.php">Opeth</a>
			<a class="navbar-brand" href="acceuil.php">Accueil</a>			
        </div>
    </div>
</nav>
<div class="container">
    <div class="starter-template" style="padding-top: 100px;">


    </div>

	<h1>Page d'administration</h1>
	<div align="right">
		<form action="../controller/connexion.php" method="post"> <!-- bouton déconnexion -->
		<button	type="submit" name="supprimer_sess">Déconnexion</button> <!-- //déconnexion de la session membre -->
		</form>
	</div>

		<div align="left">	
		
		<h2> Categories </h2>
				
				<?php echo Categorie::viewCat();?>
		
		<h3>Ajouter une Categorie</h3>
		
		<form action="../controller/connexion.php" method ="post">
            <tr>
			   <td>
                    </br><label for="nomcategorie">Nom : </label>
                </td>
                <td>
                    <input type="text" id="nomcat" name="nomcat" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="descriptioncat">Description : </label>
                </td>
                <td>
                    <input type="text" id="descat" name="descat" />
                </td>		
			</tr>
		<button type="submit" name="addCat">Ajouter</button> 
		</form>	
		
		<h3>Supprimer une categorie</h3>
		
		<form action="../controller/connexion.php" method ="post">
            <tr>    
				<td>
                    </br><label for="nomcategoriesupp">Nom Catégorie: </label>
                </td>
                <td>
                    <input type="text" id="nomcatsupp" name="nomcatsupp" />
                </td>
            </tr>

		<button type="submit" name="suppcat">Supprimer</button> 
		</form>			


		</br><h2> Membres </h2></br>
		
		<div> 
			<input type="text" placeholder="Recherche..." style="width:400px" name="champRechercheMembre" id="champRechercheMembre"onkeyup="rechercheMembre();"value=""/>&nbsp;&nbsp;<input type="button" value="Rechercher" onClick="rechercheMembre();"> 
			<div id="div_contenuRechercheMembre"></div> 
		</div> 
		
		</br><h2> Annonces </h2></br>		
	
		<div> 
			<input type="text" placeholder="Recherche..." style="width:400px" name="champRecherche" id="champRecherche"onkeyup="recherche();"value=""/>&nbsp;&nbsp;<input type="button" value="Rechercher" onClick="recherche();"> 
			<div id="div_contenuRecherche"></div> 
		</div> 

		</div>	


	
</div>
</body>
</html>