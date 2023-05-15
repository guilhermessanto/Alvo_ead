<?php

use Alvo\Instrutor;
use Alvo\Utilitarios;
use Alvo\Categoria;
use Alvo\CtrAcesso;

$pagina = "Instrutor (Atualiza)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$instrutor = new Instrutor;
$instrutor->setId($_GET['id']);
$dados = $instrutor->listarUmInstrutor();

$OBJcategoria = new Categoria;
$listaDeCategoria = $OBJcategoria->listarCategorias();
// Utilitarios::dump($listaDeCategoria);

if( isset ($_POST['atualizar'])) {
	$instrutor->setlimiteCurso($_POST['limiteCurso']);
	$instrutor->setCategoriaId($_POST['categoria_id']);
	$instrutor->setIndicador($_POST['indicador']);
	$instrutor->atualizarInstrutor();
	header("location:instrutor.php");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
		Atualizar dados do instrutor
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="text">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>" readonly>
			</div>

			<div class="mb-3">
				<label class="form-label" for="nome">Limite de cursos:</label>
				<input class="form-control" type="text" id="limiteCurso" name="limiteCurso" value="<?=$dados['limiteCurso']?>"required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="nome">Categoria:</label>
				<select class="form-select" name="categoria_id" id="categoria_id" value="<?=$dados['categoria_id']?>">
				<option value="<?=$dados['categoria_id']?>"><?=$dados['descCategoria']?></option>
					<?php foreach($listaDeCategoria as $categoria ) { 
						if ( $categoria['indicador'] == 1 ) { continue; }
						?>
						<option id="categoria" name="categoria" value="<?=$categoria['id']?>" required><?=$categoria['descCategoria']?></option>
					<?php } ?>
				</select>
			</div>

			<div class="mb-3">
				<label class="form-label" for="indicador">Status de Controle:</label>
                <select class="form-select" name="indicador" id="indicador" required>
                    <option value="<?=$dados['indicador']?>"></option>
                    <option 
					<?php if ($dados['indicador'] == "0") echo " selected "?>
					value="0">Ativo</option>
                    <option 
					<?php if ($dados['indicador'] == "1") echo " selected "?>
					value="1">Desativado</option>
                </select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
			<a class="btn btn-secondary ms-5" href="instrutor.php"><i class="bi bi-pencil"> Voltar</i></a>

			<br class="mb-5">
			<br class="mb-5">
			<br class="mb-5">
		</form>
		
	</article>
</div>

<?php 
require_once "../inc/rodape-admin.php";
?>