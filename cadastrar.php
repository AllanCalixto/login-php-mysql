<?php 

require_once 'CLASSES/usuarios.php';

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
	<div id="corpo-form-cad">
		<h1>Cadastrar</h1>
		<form method="POST">
			<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
			<input type="text" name="telefone" placeholder="Telefone" maxlength="30">
			<input type="email" name="email" placeholder="Usuário" maxlength="40">
			<input type="password" name="senha" placeholder="Senha" maxlength="15">
			<input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
			<input type="submit" value="CADASTRAR">
		</form>
	</div>

	<?php 
	//verificar se clicou no botao
	if(isset($_POST['nome']))
	{
		$nome = addslashes($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		$senha = addslashes($_POST['senha']);
		$confSenha = addslashes($_POST['confSenha']);
		//verificar se os campos foram preenchidos
		if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
		{
			$u->conectar("projeto_login", "localhost", "allan", "allanpsg10");
			if($u->msgErro == "")
			{
				if($senha == $confSenha)
				{
					if($u->cadastrar($nome, $telefone, $email, $senha))
					{
						?>
						<div id="msg-sucesso">
							Cadastrado com sucesso ! Acesse para entrar !
						</div>
							
						<?php
					}
					else
					{
						?>
						<div class="msg-erro">
							Email ja cadastrado
						</div>	
						<?php
					}	
				}
				else {
					echo "Senha e Confirmar senha nao conferem";
				}
				
			}
			else 
			{
				echo "Erro:".$u->msgErro;
			}
		}
		else 
		{
			echo "Preencha todos os campos !";
		}
	}

	?>


</body>
</html>