<?php

use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "meu-perfil";
require_once "../inc/cabecalho-user.php";
$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAluno();



if(isset($_POST['atualizar'])){
	$OBJctrAcesso ->setId($_SESSION['id']);
	if(empty($_POST['senha'])){
		
	}else{
	$OBJctrAcesso->setSenha( $OBJctrAcesso->codificaSenha($_POST['senha']));
	$OBJctrAcesso ->trocaSenha();
	}
    header('location:index.php');

}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar meus dados
		</h2>
				
		<form class="mx-auto w-75 pb-5" action="" method="post" id="form-atualizar" name="form-atualizar">
 
			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$_SESSION['nome']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$_SESSION['email']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<a class="btn btn-secondary ms-5" href="index.php"><i class="bi bi-pencil"> Voltar</i></a>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

