<?php

use Alvo\Modalidade;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Modalidade (Atualiza)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJmodalidade = new Modalidade;
$OBJmodalidade->setId($_GET['id']);
$dados = $OBJmodalidade->listarUmaModalidade();

// Utilitarios::dump($dados);
if( isset ($_POST['atualizar'])) {
	$OBJmodalidade->setCodModalidade($_POST['codModalidade']);
	$OBJmodalidade->setDescModalidade($_POST['descModalidade']);
	$OBJmodalidade->atualizarModalidade();
	header("location:modalidade.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Atualizar dados Modalidade
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="codModalidade">Código:</label>
				<input class="form-control" type="text" id="codModalidade" name="codModalidade" value="<?=$dados['codModalidade']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="text">Descrição:</label>
				<input class="form-control" type="text" id="descModalidade" name="descModalidade" value="<?=$dados['descModalidade']?>" required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<a class="btn btn-secondary ms-5" href="modalidade.php"><i class="bi bi-pencil"> Voltar</i></a>

			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">
		</form>
		
	</article>
</div>
<?php 
require_once "../inc/rodape-admin.php";
?>

</body>
</html>
