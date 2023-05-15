<?php

use Alvo\Categoria;
use Alvo\Utilitarios;
use Alvo\CtrAcesso;

$pagina = "Categoria (Atualiza)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJcategoria = new Categoria;
$OBJcategoria->setId($_GET['id']);
$dados = $OBJcategoria->listarUmaCategoria();

// Utilitarios::dump($dados);
if( isset ($_POST['atualizar'])) {
	$OBJcategoria->setDescCategoria($_POST['descCategoria']);
	$OBJcategoria->atualizarCategoria();
	header("location:categoria.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Atualizar dados da Categoria
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Descrição:</label>
				<input class="form-control" type="text" id="descCategoria" name="descCategoria" value="<?=$dados['descCategoria']?>"required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<a class="btn btn-secondary ms-5" href="categoria.php"><i class="bi bi-pencil"> Voltar</i></a>

            <br class="mb-5">
			<br class="mb-5">
            <br class="mb-5">
		</form>
		
	</article>
</div>


</body>
</html>