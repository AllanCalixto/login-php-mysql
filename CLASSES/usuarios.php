<?php 


Class Usuario
{
	private $pdo;
	public $msgErro = '';

	public function conectar ($nome, $host, $usuario, $senha)
	{
		global $pdo;
		global $msgErro;

		try
		{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
		}
		catch (PDOException $e)
		{
			$msgErro = $e->getMessage();
		}
	}

	public function cadastrar ($nome, $telefone, $email, $senha, $cep, $rua)
	{
		global $pdo;

		//verificar se email ja foi cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //ja está cadastrada
		}
		else
		{
			//caso nao, cadastrar
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha, cep, rua) VALUES (:n, :t, :e, :s, :c, :r)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->bindValue(":c", $cep);
			$sql->bindValue(":r", $rua);
			$sql->execute();
			return true;
		}

	}

	public function logar ($email, $senha)
	{
		global $pdo;
		//verificar se o email e senha estao cadastrados, se sim

		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch(FETCH_ASSOC);
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //logado com sucesso!
		}
		else
		{
			return false; //nao foi possivel logar
		}

		
	}   
}