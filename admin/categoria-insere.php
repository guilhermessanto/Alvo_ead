<?php

use Alvo\Categoria;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Categoria (Insere)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

if ( isset ($_POST['inserir'])) {
	$OBJcategoria = new Categoria;
	$OBJcategoria->setDescCategoria($_POST['descCategoria']);
	$OBJcategoria->inserirCategoria();
	header("location:categoria.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Inserir nova Categoria
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">
				<label class="form-label" for="nome">Descrição:</label>
				<input class="form-control" type="text" id="descCategoria" name="descCategoria" required>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
			<a class="btn btn-secondary ms-5" href="categoria.php"><i class="bi bi-pencil"> Voltar</i></a>

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