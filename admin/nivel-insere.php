<?php

use Alvo\Nivel;
use Alvo\CtrAcesso;
use Alvo\Utilitarios;

$pagina = "Nível (Insere)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

if ( isset ($_POST['inserir'])) {
	$OBJnivel = new Nivel;
	$OBJnivel->setCodNivel($_POST['codNivel']);
	$OBJnivel->setDescNivel($_POST['descNivel']);
	$OBJnivel->inserirNivel();
	header("location:nivel.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Inserir novo Nível
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">
				<label class="form-label" for="codNivel">Código:</label>
				<input class="form-control" type="text" id="codNivel" name="codNivel" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="descNivel">Descrição:</label>
				<input class="form-control" type="text" id="descNivel" name="descNivel" required>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
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