<?php 

session_start();
if(!isset($_SESSION['id_usuario']))
{

}
else 
{
		header("location: index.php");
		exit();
}


$cep = addslashes($_POST['cep']);
	$url = "https://viacep.com.br/ws/" .$cep. "/json/";

	$enderecos = json_decode(file_get_contents($url));

	foreach ($enderecos as $e) {
	}

	



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Projeto Login</title>
	<link rel="stylesheet" href="estilo.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
		<div id="corpo-form-cad">
		<h1>Buscar CEP</h1>
		<form method="POST">
			<input type="text" name="cep" placeholder="CEP" maxlength="30">
			<input type="text" name="rua" value=" <?php  echo $enderecos->logradouro  ?>" disabled>
			<input type="submit" value="BUSCAR">
		</form>
	</div>
	<a href="sair.php">Sair</a>
</body>
</html>
