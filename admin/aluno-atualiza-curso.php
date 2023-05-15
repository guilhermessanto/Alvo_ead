<?php

use Alvo\CtrAcesso;
use Alvo\Curso;
use Alvo\Utilitarios;

$pagina = "Alunos (Consulta)";
require_once "../inc/cabecalho-admin.php";

$OBJctrAcesso = new CtrAcesso;
$OBJctrAcesso->verificaAcessoAdmin();

$OBJcurso = new Curso;
$OBJcurso -> setId($_GET['id']);
$dados = $OBJcurso ->listarUmCurso();

// Utilitarios::dump($dados);
if( isset ($_POST['atualizar'])) {
	
	$OBJcurso->setIndicador($_POST['indicador']);
	$OBJcurso->atualizaIndicadorCurso();
	header("location:aluno.php");
}

?>

<div class="row">
	<article class="col-12 bg-white rounded shadow py-4">
		
		<h2 class="text-center">
			Atualizar dados do Curso
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="text">Curso:</label>
				<input class="form-control" type="text" id="nomeCurso" name="nomeCurso" value="<?=$dados['nomeCurso']?>" readonly>
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
			<a class="btn btn-secondary ms-5" href="aluno.php"><i class="bi bi-pencil"> Voltar</i></a>

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