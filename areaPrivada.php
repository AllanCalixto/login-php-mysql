<?php 

session_start();
if(!isset($_SESSION['id_usuario']))
{
	echo "Voce entrou !";
}
else 
{
		header("location: index.php");
		exit();
}


?>


SEJAA BEEM VINDOOO !!!!
<a href="sair.php">Sair</a>