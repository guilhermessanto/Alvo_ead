<?php

use Alvo\Instrutor;
use Alvo\Utilitarios;
use Alvo\Categoria;
use Alvo\CtrAcesso;

$pagina = "Instrutor (Insere)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJcategoria = new Categoria;
$listaDeCategoria = $OBJcategoria->listarCategorias();

// $instrutor = new Instrutor;
// $listarUmInstrutor = $instrutor->listarUmInstrutor();
// Utilitarios::dump($listarUmInstrutor);

if ( isset ($_POST['inserir'])) {
	
	$instrutor->setlimiteCurso($_POST['limiteCurso']);
	$instrutor->inserirInstrutor();
	header("location:instrutor.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Inserir um novo Instrutor
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-inserir" name="form-inserir">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome do instrutor:</label>
				<input class="form-control" type="text" id="instrutor" name="instrutor">
			</div>

			<div class="mb-3">
				<label class="form-label" for="nome">Limite de Curso:</label>
				<input class="form-control" type="number" id="limiteCurso" name="limiteCurso" min=0 max=99 step="1" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="nome">Categoria:</label>
				<select class="form-select" name="categoria" id="categoria">
					<option value=""></option>
					<?php foreach($listaDeCategoria as $categoria ) { ?>
						<option id="categoria" name="categoria" value="<?=$categoria['id']?>" required><?=$categoria['descCategoria']?></option>
					<?php } ?>
				</select>
			</div>
			
			<button class="btn btn-primary" id="inserir" name="inserir"><i class="bi bi-save"></i> Inserir</button>
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