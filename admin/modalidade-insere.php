<?php

use Alvo\Modalidade;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Modalidade (Insere)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

if ( isset ($_POST['inserir'])) {
	$OBJmodalidade = new Modalidade;
	$OBJmodalidade->setCodModalidade($_POST['codModalidade']);
	$OBJmodalidade->setDescModalidade($_POST['descModalidade']);
	$OBJmodalidade->inserirModalidade();
	header("location:modalidade.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Inserir nova Modalidade
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">
				<label class="form-label" for="codModalidade">Código:</label>
				<input class="form-control" type="text" id="codModalidade" name="codModalidade" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="descModalidade">Descrição:</label>
				<input class="form-control" type="text" id="descModalidade" name="descModalidade" required>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
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

