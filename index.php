<?php 

	require_once 'usuarios.php';
	$u = new Usuario;

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Projeto Login</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div id="corpo-form">
		<h1>Entrar</h1>
		<form method="POST">
			<input type="email" placeholder="Usuário" name="email">
			<input type="password" placeholder="Senha" name="senha">
			<input type="submit" value="ACESSAR">
			<a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se!</strong>
		</form>
	</div>

	<?php 

if(isset($_POST['nome']))
	{
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
	
		//verificar se os campos foram preenchidos
		if(!empty($email) && !empty($senha))
		{
			$u->conectar("projeto_login", "localhost", "allan", "allanpsg10");
			if($u->msgErro == "")
			{
				if($u->logar($email, $senha))
				{
					header("areaPrivada.php");
				}

			else
			{
				echo "Email e/ou senha estão incorretos!";
			}	
		}
		else
		{
			echo "Erro: " .$u->msgErro;
		}	
		else
		{
			echo "Preencha todos os campos!";
		}	
	 ?>

	</body>
	</html>