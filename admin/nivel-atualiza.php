<?php

use Alvo\Nivel;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Nível (Atualiza)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJnivel = new Nivel;
$OBJnivel->setId($_GET['id']);
$dados = $OBJnivel->listarUmNivel();

// Utilitarios::dump($dados);
if( isset ($_POST['atualizar'])) {
	$OBJnivel->setCodNivel($_POST['codNivel']);
	$OBJnivel->setDescNivel($_POST['descNivel']);
	$OBJnivel->atualizarNivel();
	header("location:nivel.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Atualizar dados Nível
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="codNivel">Código:</label>
				<input class="form-control" type="text" id="codNivel" name="codNivel" value="<?=$dados['codNivel']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="text">Descrição:</label>
				<input class="form-control" type="text" id="descNivel" name="descNivel" value="<?=$dados['descNivel']?>" required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<a class="btn btn-secondary ms-5" href="nivel.php"><i class="bi bi-pencil"> Voltar</i></a>

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